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

// Fetch total field data
$sql = "SELECT ins, `out`, drs FROM activity"; // Use backticks around 'out'
$result = $conn->query($sql);

$data = [];

// Process results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Decode JSON for each field
        if (!empty($row['ins'])) {
            $insEntries = json_decode($row['ins'], true);
            foreach ($insEntries as $entry) {
                $entry['field_name'] = 'ins'; // Add field identifier
                $data[] = $entry;
            }
        }
        
        if (!empty($row['out'])) {
            $outEntries = json_decode($row['out'], true);
            foreach ($outEntries as $entry) {
                $entry['field_name'] = 'out'; // Add field identifier
                $data[] = $entry;
            }
        }
        
        if (!empty($row['drs'])) {
            $drsEntries = json_decode($row['drs'], true);
            foreach ($drsEntries as $entry) {
                $entry['field_name'] = 'drs'; // Add field identifier
                $data[] = $entry;
            }
        }
    }
}

// Sort data by activity_sl_no
usort($data, function($a, $b) {
    return $a['activity_sl_no'] <=> $b['activity_sl_no'];
});

// Display data in a table
echo "<table border='1'>
<tr>
    <th>Field Name</th>
    <th>Order</th>
    <th>Rcd Sts</th>
    <th>Ins Date</th>
    <th>Ins Time</th>
    <th>Ins Branch</th>
    <th>Ins By</th>
    <th>Eway Amt</th>
    <th>Eway No</th>
    <th>RO</th>
    <th>PCS</th>
    <th>Weight</th>
    <th>Vol Weight</th>
    <th>Truck</th>
    <th>VNO</th>
    <th>Activity SL No</th>
</tr>";

foreach ($data as $entry) {
    echo "<tr>
        <td>{$entry['field_name']}</td>
        <td>{$entry['order']}</td>
        <td>{$entry['rcd_sts']}</td>
        <td>{$entry['ins_date']}</td>
        <td>{$entry['ins_time']}</td>
        <td>{$entry['ins_branch']}</td>
        <td>{$entry['ins_by']}</td>
        <td>{$entry['ins_eway_amt']}</td>
        <td>{$entry['ins_ewayno']}</td>
        <td>{$entry['ins_ro']}</td>
        <td>{$entry['ins_pcs']}</td>
        <td>{$entry['ins_wgt']}</td>
        <td>{$entry['ins_vol_wgt']}</td>
        <td>{$entry['ins_truck']}</td>
        <td>{$entry['ins_vno']}</td>
        <td>{$entry['activity_sl_no']}</td>
    </tr>";
}

echo "</table>";

// Close connection
$conn->close();
?>
