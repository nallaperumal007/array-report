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

// Mapping field names to desired display names
$fieldNameMapping = [
    'ins_details' => 'IN-SCANNED',
    'out_details' => 'OUT-BOUND',
    'drs_details' => 'DELIVERY RUN-SHEET',
    'pod_details' => 'POD-UPDATION',
];

// Check if there are any entries to display
if (!empty($data)) {
    // Get all unique keys for headers
    $headers = array_keys(array_merge(...$data));

    // Display data in a table with styling
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Activity Data</title>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css'>
        <style>
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background-color: #f0f4f8;
                margin: 20px;
                color: #333;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            h2 {
                text-align: center;
                color: #6A1B9A;
                margin-bottom: 20px;
                font-weight: bold;
                position: relative;
                display: inline-block;
            }
            h2::after {
                content: '';
                display: block;
                width: 100%;
                height: 4px;
                background: #4CAF50;
                position: absolute;
                bottom: -8px;
                left: 0;
                animation: slide 0.5s forwards;
            }
            @keyframes slide {
                0% { transform: scaleX(0); }
                100% { transform: scaleX(1); }
            }
            .table-responsive {
                margin-top: 20px;
                overflow-x: auto;
                border-radius: 10px;
                box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
                background-color: white;
                transition: transform 0.3s;
                width: 100%;
            }
            .table-responsive:hover {
                transform: scale(1.02);
            }
            table {
                width: 100%;
                border-collapse: collapse;
                min-width: 800px;
                animation: fadeIn 0.5s ease-in-out;
            }
            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }
            th, td {
                padding: 15px;
                text-align: left;
                border: 1px solid #ddd;
                transition: background-color 0.3s, transform 0.2s;
            }
            th {
                background-color: #6A1B9A;
                color: white;
                text-transform: uppercase;
                letter-spacing: 0.1em;
            }
            tr:nth-child(even) {
                background-color: #f9f9f9;
            }
            tr:hover {
                background-color: #FFEB3B;
                transform: translateY(-2px);
                transition: transform 0.2s;
            }
            .icon {
                margin-right: 8px;
                color: #4CAF50;
                transition: color 0.3s;
            }
            .icon:hover {
                color: #FF5722; /* Change color on hover */
            }
            @media (max-width: 900px) {
                table, thead, tbody, th, td, tr {
                    display: block;
                }
                th {
                    display: none;
                }
                td {
                    text-align: right;
                    position: relative;
                    padding-left: 50%;
                    border: none;
                }
                td:before {
                    content: attr(data-label);
                    position: absolute;
                    left: 10px;
                    width: 45%;
                    padding-right: 10px;
                    white-space: nowrap;
                    text-align: left;
                    font-weight: bold;
                    color: #333;
                }
            }
        </style>
    </head>
    <body>
        <h2><i class='fas fa-list-alt icon'></i> Activity Data</h2>
        <div class='table-responsive'>
            <table>
                <thead>
                    <tr>
                        <th>Sno</th>
                        <th>Field Name</th>";

    // Display unique field names as headers
    foreach ($headers as $header) {
        if ($header !== 'field_name') {
            echo "<th>" . htmlspecialchars($fieldNameMapping[$header] ?? $header) . "</th>";
        }
    }
    echo "</tr>
                </thead>
                <tbody>";

    // Initialize Sno counter
    $sno = 1;

    // Display each entry
    foreach ($data as $entry) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($sno++) . "</td>"; // Increment Sno
        // Use mapped field name for display
        echo "<td>" . htmlspecialchars($fieldNameMapping[$entry['field_name']] ?? $entry['field_name']) . "</td>";
        foreach ($headers as $header) {
            if ($header !== 'field_name') {
                echo "<td data-label='" . htmlspecialchars($fieldNameMapping[$header] ?? $header) . "'>" . htmlspecialchars($entry[$header] ?? '') . "</td>";
            }
        }
        echo "</tr>";
    }

    echo "</tbody>
            </table>
        </div>
    </body>
    </html>";
} else {
    echo "No data found.";
}

// Close connection
$conn->close();
?>
