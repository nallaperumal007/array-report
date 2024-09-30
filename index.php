<?php
// Database credentials
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "information"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the table if it doesn't exist
$tableCreationQuery = "
CREATE TABLE IF NOT EXISTS information (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Doorno VARCHAR(50),
    name VARCHAR(100),
    address TEXT,
    details JSON
)";
$conn->query($tableCreationQuery);

// Function to find a record with the same Doorno, name, and address
function findRecord($conn, $Doorno, $name, $address) {
    $sql = "SELECT id, details FROM information WHERE Doorno=? AND name=? AND address=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $Doorno, $name, $address);
    $stmt->execute();
    $result = $stmt->get_result();
    $record = $result->fetch_assoc();
    $stmt->close();
    return $record;
}

// Function to get the next available detail `no` for new records
function getNextDetailNo($details) {
    $maxNo = 0;
    foreach ($details as $detail) {
        if ($detail['no'] > $maxNo) {
            $maxNo = $detail['no'];
        }
    }
    return $maxNo + 1;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Doorno = $_POST['Doorno'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $dates = $_POST['date'];
    $times = $_POST['time'];
    $amounts = $_POST['amount'];
    $types = $_POST['type'];
    $years = $_POST['year'];

    // Prepare details as JSON
    $detailsArray = [];
    for ($i = 0; $i < count($dates); $i++) {
        $detailsArray[] = [
            'no' => $i + 1,  // Temporary `no` for new details
            'date' => $dates[$i],
            'time' => $times[$i],
            'amount' => $amounts[$i],
            'type' => $types[$i],
            'year' => $years[$i]
        ];
    }

    // Check if record with same Doorno, name, and address exists
    $existingRecord = findRecord($conn, $Doorno, $name, $address);

    if ($existingRecord) {
        // Append new details to existing record
        $id = $existingRecord['id'];
        $existingDetails = json_decode($existingRecord['details'], true);

        // Get the next available `no` for new details
        $nextNo = getNextDetailNo($existingDetails);

        // Update `no` for new details
        foreach ($detailsArray as &$detail) {
            $detail['no'] = $nextNo++;
        }
        unset($detail); // Unset reference

        // Merge and update details
        $existingDetails = array_merge($existingDetails, $detailsArray);
        $updatedDetailsJson = json_encode($existingDetails);

        $sql = "UPDATE information SET details=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $updatedDetailsJson, $id);
        $stmt->execute();
        $stmt->close();
    } else {
        // Insert new record
        $detailsJson = json_encode($detailsArray);
        $sql = "INSERT INTO information (Doorno, name, address, details) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $Doorno, $name, $address, $detailsJson);
        $stmt->execute();
        $stmt->close();
    }

    header("Location: index.php");
    exit();
}

// Handle record deletion
if (isset($_GET['delete']) && isset($_GET['no'])) {
    $id = $_GET['delete'];
    $no = $_GET['no'];

    // Fetch the existing record
    $sql = "SELECT details FROM information WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $record = $result->fetch_assoc();
    $details = json_decode($record['details'], true);
    $stmt->close();

    // Remove the specific detail
    $updatedDetails = array_filter($details, function($detail) use ($no) {
        return $detail['no'] != $no;
    });

    // Convert updated details to JSON
    $updatedDetailsJson = json_encode(array_values($updatedDetails));

    // Update the record in the database
    $sql = "UPDATE information SET details=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $updatedDetailsJson, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php");
    exit();
}

// Handle record update
if (isset($_GET['update']) && isset($_GET['no'])) {
    $id = $_GET['update'];
    $no = $_GET['no'];

    // Fetch existing record for editing
    $sql = "SELECT * FROM information WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $record = $result->fetch_assoc();
    $details = json_decode($record['details'], true);
    $stmt->close();

    // Find the specific detail to update
    $detailToUpdate = null;
    foreach ($details as $detail) {
        if ($detail['no'] == $no) {
            $detailToUpdate = $detail;
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information Form</title>
    <script>
        function addDetail() {
            const container = document.getElementById('details-container');
            const newDetail = container.querySelector('.detail').cloneNode(true);
            // Clear the values of the cloned detail
            const inputs = newDetail.querySelectorAll('input, select');
            inputs.forEach(input => input.value = '');
            container.appendChild(newDetail);
        }
    </script>
</head>
<body>
    <h1>Information Form</h1>

    <?php if (isset($_GET['update']) && isset($_GET['no'])): ?>
        <h2>Update Record</h2>
        <form action="index.php?update=<?php echo $_GET['update']; ?>&no=<?php echo $_GET['no']; ?>" method="post">
            <fieldset>
                <legend>Main Information</legend>
                Doorno: <input type="text" name="Doorno" value="<?php echo htmlspecialchars($record['Doorno']); ?>" required><br>
                Name: <input type="text" name="name" value="<?php echo htmlspecialchars($record['name']); ?>" required><br>
                Address: <textarea name="address" required><?php echo htmlspecialchars($record['address']); ?></textarea><br>
            </fieldset>

            <fieldset>
                <legend>Details</legend>
                <div id="details-container">
                    <?php if ($detailToUpdate): ?>
                        <div class="detail">
                            Date: <input type="date" name="date[]" value="<?php echo htmlspecialchars($detailToUpdate['date']); ?>" required><br>
                            Time: <input type="time" name="time[]" value="<?php echo htmlspecialchars($detailToUpdate['time']); ?>" required><br>
                            Amount: <input type="number" step="0.01" name="amount[]" value="<?php echo htmlspecialchars($detailToUpdate['amount']); ?>" required><br>
                            Type:
                            <select name="type[]" required>
                                <option value="water" <?php echo $detailToUpdate['type'] == 'water' ? 'selected' : ''; ?>>Water</option>
                                <option value="current" <?php echo $detailToUpdate['type'] == 'current' ? 'selected' : ''; ?>>Current</option>
                                <option value="House" <?php echo $detailToUpdate['type'] == 'House' ? 'selected' : ''; ?>>House</option>
                            </select><br>
                            Year: <input type="number" name="year[]" value="<?php echo htmlspecialchars($detailToUpdate['year']); ?>" required><br>
                            <hr>
                        </div>
                    <?php endif; ?>
                </div>
                <button type="button" onclick="addDetail()">Add Another Detail</button><br>
            </fieldset>

            <input type="submit" value="Update">
        </form>
    <?php else: ?>
        <h1>Submit New Record</h1>
        <form action="index.php" method="post">
            <fieldset>
                <legend>Main Information</legend>
                Doorno: <input type="text" name="Doorno" required><br>
                Name: <input type="text" name="name" required><br>
                Address: <textarea name="address" required></textarea><br>
            </fieldset>

            <fieldset>
                <legend>Details</legend>
                <div id="details-container">
                    <div class="detail">
                        Date: <input type="date" name="date[]" required><br>
                        Time: <input type="time" name="time[]" required><br>
                        Amount: <input type="number" step="0.01" name="amount[]" required><br>
                        Type:
                        <select name="type[]" required>
                            <option value="water">Water</option>
                            <option value="current">Current</option>
                            <option value="House">House</option>
                        </select><br>
                        Year: <input type="number" name="year[]" required><br>
                        <hr>
                    </div>
                </div>
                <button type="button" onclick="addDetail()">Add Another Detail</button><br>
            </fieldset>

            <input type="submit" value="Submit">
        </form>
    <?php endif; ?>

    <h2>Existing Records</h2>
    <?php
    $sql = "SELECT * FROM information";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Doorno</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>No</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Year</th>
                    <th>Actions</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $details = json_decode($row['details'], true);
            foreach ($details as $detail) {
                echo "<tr>
                        <td>{$id}</td>
                        <td>{$row['Doorno']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['address']}</td>
                        <td>{$detail['no']}</td>
                        <td>" . date('d.m.Y', strtotime($detail['date'])) . "</td>
                        <td>{$detail['time']}</td>
                        <td>{$detail['amount']}</td>
                        <td>{$detail['type']}</td>
                        <td>{$detail['year']}</td>
                        <td>
                            <a href='index.php?update={$id}&no={$detail['no']}'>Update</a> |
                            <a href='index.php?delete={$id}&no={$detail['no']}' onclick=\"return confirm('Are you sure you want to delete this record?')\">Delete</a>
                        </td>
                    </tr>";
            }
        }

        echo "</table>";
    } else {
        echo "No records found.";
    }
    ?>

</body>
</html>

<?php $conn->close(); ?>
