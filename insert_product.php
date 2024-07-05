<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['goods-name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $sql = "INSERT INTO products (name, description, price) VALUES ('$name', '$description', '$price')";

    $result = pg_query($conn, $sql);

    if ($result) {
        echo "New record created successfully";
    } else {
        echo "Error: " . pg_last_error($conn);
    }

    pg_close($conn);
}
?>
