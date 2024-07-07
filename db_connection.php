<?php
$host = "localhost";
$port = "5432";
$dbname = "rianab_logistics";
$user = "your_username";
$password = "your_password";

// Create connection
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

// Check connection
if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

// Create function
function createRecord($conn, $table, $data) {
    $columns = implode(", ", array_keys($data));
    $values = implode(", ", array_map(function($item) {
        return "'" . pg_escape_string($item) . "'";
    }, array_values($data)));

    $query = "INSERT INTO $table ($columns) VALUES ($values)";
    $result = pg_query($conn, $query);

    if ($result) {
        echo "Record created successfully.\n";
    } else {
        echo "Error creating record: " . pg_last_error($conn) . "\n";
    }
}

// Read function
function readRecords($conn, $table, $conditions = "1=1") {
    $query = "SELECT * FROM $table WHERE $conditions";
    $result = pg_query($conn, $query);

    if ($result) {
        while ($row = pg_fetch_assoc($result)) {
            print_r($row);
        }
    } else {
        echo "Error reading records: " . pg_last_error($conn) . "\n";
    }
}

// Update function
function updateRecord($conn, $table, $data, $conditions) {
    $updates = [];
    foreach ($data as $column => $value) {
        $updates[] = "$column = '" . pg_escape_string($value) . "'";
    }
    $updates = implode(", ", $updates);

    $query = "UPDATE $table SET $updates WHERE $conditions";
    $result = pg_query($conn, $query);

    if ($result) {
        echo "Record updated successfully.\n";
    } else {
        echo "Error updating record: " . pg_last_error($conn) . "\n";
    }
}

// Delete function
function deleteRecord($conn, $table, $conditions) {
    $query = "DELETE FROM $table WHERE $conditions";
    $result = pg_query($conn, $query);

    if ($result) {
        echo "Record deleted successfully.\n";
    } else {
        echo "Error deleting record: " . pg_last_error($conn) . "\n";
    }
}

// Usage examples
// Create a new record
createRecord($conn, 'your_table_name', [
    'column1' => 'value1',
    'column2' => 'value2',
    // Add more columns and values as needed
]);

// Read records
readRecords($conn, 'your_table_name');

// Update a record
updateRecord($conn, 'your_table_name', [
    'column1' => 'new_value1',
    'column2' => 'new_value2',
    // Add more columns and values as needed
], "id = 1");

// Delete a record
deleteRecord($conn, 'your_table_name', "id = 1");

// Close the connection
pg_close($conn);
?>
