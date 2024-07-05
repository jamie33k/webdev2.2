<?php
include 'db_connect.php';

$sql = "SELECT id, name, description, price FROM products";
$result = pg_query($conn, $sql);

if (!$result) {
    echo "An error occurred.\n";
    exit;
}

echo "<table border='1'>
<tr>
<th>ID</th>
<th>Name</th>
<th>Description</th>
<th>Price</th>
</tr>";

while ($row = pg_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['description'] . "</td>";
    echo "<td>" . $row['price'] . "</td>";
    echo "</tr>";
}
echo "</table>";

pg_close($conn);
?>
