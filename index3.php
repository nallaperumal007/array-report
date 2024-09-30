<?php
// Database connection
$servername = "localhost"; // Your server name
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "information"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from activity table
$sql = "SELECT ins, `out`, drs, ins_details, out_details, drs_details, pod_details FROM activity"; // Include all required fields
$result = $conn->query($sql);

$data = [];

// Process results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Process ins_details, out_details, drs_details, pod_details fields
        foreach (['ins_details', 'out_details', 'drs_details', 'pod_details'] as $field) {
            if (!empty($row[$field])) {
                $entries = json_decode($row[$field], true);
                foreach ($entries as $entry) {
                    $entry['field_name'] = $field; // Add field identifier
                    $data[] = $entry;
                }
            }
        }
    }
}

// Sort data by activity_sl_no, if it exists
usort($data, function($a, $b) {
    return ($a['activity_sl_no'] ?? 0) <=> ($b['activity_sl_no'] ?? 0);
});

// Check if there are any entries to display
if (!empty($data)) {
    // Get all unique keys for headers
    $headers = array_keys(array_merge(...$data));
    
    // Display data in a table
    echo "<table border='1'>
    <tr>";

    // Display headers
    foreach ($headers as $header) {
        echo "<th>" . htmlspecialchars($header) . "</th>";
    }
    echo "</tr>";

    // Display each entry
    foreach ($data as $entry) {
        echo "<tr>";
        foreach ($headers as $header) {
            echo "<td>" . htmlspecialchars($entry[$header] ?? '') . "</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No data found.";
}

// Close connection
$conn->close();
?>
