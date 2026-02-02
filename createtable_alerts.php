<?php
include "connect.php";

$sql = "CREATE TABLE IF NOT EXISTS alerts (
    alert_id INT AUTO_INCREMENT PRIMARY KEY,
    item_id INT NOT NULL,
    alert_type ENUM('LOW_STOCK','EXPIRING_SOON') NOT NULL,
    alert_message VARCHAR(255),
    alert_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    is_resolved BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (item_id) REFERENCES items(item_id)
)";

echo ($mysqli->query($sql))
    ? "Alerts table created successfully!"
    : "Error: " . $mysqli->error;
?>
