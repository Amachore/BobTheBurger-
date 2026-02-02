<?php
include "connect.php";

$sql = "CREATE TABLE IF NOT EXISTS categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(50) NOT NULL
)";

echo ($mysqli->query($sql))
    ? "Categories table created successfully!"
    : "Error: " . $mysqli->error;
?>
