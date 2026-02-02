<?php
include "connect.php";

$sql = "CREATE TABLE IF NOT EXISTS inventory_transactions (
    transaction_id INT AUTO_INCREMENT PRIMARY KEY,
    item_id INT NOT NULL,
    user_id INT NOT NULL,
    transaction_type ENUM('IN','OUT') NOT NULL,
    quantity DECIMAL(10,2) NOT NULL,
    transaction_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (item_id) REFERENCES items(item_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
)";

echo ($mysqli->query($sql))
    ? "Inventory transactions table created successfully!"
    : "Error: " . $mysqli->error;
?>
