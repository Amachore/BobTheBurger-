<?php
include "connect.php";

$sql = "CREATE TABLE IF NOT EXISTS purchase_orders (
    po_id INT AUTO_INCREMENT PRIMARY KEY,
    supplier_id INT NOT NULL,
    ordered_by INT NOT NULL,
    order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM('PENDING','RECEIVED','CANCELLED') DEFAULT 'PENDING',
    FOREIGN KEY (supplier_id) REFERENCES suppliers(supplier_id),
    FOREIGN KEY (ordered_by) REFERENCES users(user_id)
)";

echo ($mysqli->query($sql))
    ? "Purchase orders table created successfully!"
    : "Error: " . $mysqli->error;
?>
