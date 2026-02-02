<?php
include "connect.php";

$sql = "CREATE TABLE IF NOT EXISTS suppliers (
    supplier_id INT AUTO_INCREMENT PRIMARY KEY,
    supplier_name VARCHAR(100) NOT NULL,
    contact_person VARCHAR(100),
    contact_number VARCHAR(30),
    address VARCHAR(255)
)";

echo ($mysqli->query($sql))
    ? "Suppliers table created successfully!"
    : "Error: " . $mysqli->error;
?>
