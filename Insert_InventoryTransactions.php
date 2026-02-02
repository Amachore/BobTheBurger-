<?php
include "connect.php"; // your DB connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_id = intval($_POST['item_id']);
    $user_id = intval($_POST['user_id']);
    $type    = $_POST['transaction_type']; // 'IN' or 'OUT'
    $qty     = intval($_POST['quantity']);

    // Insert into transactions
    $sql = "INSERT INTO inventory_transactions 
            (item_id, user_id, transaction_type, quantity, transaction_date) 
            VALUES (?, ?, ?, ?, NOW())";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("iisi", $item_id, $user_id, $type, $qty);
    $stmt->execute();

    // Update masterlist quantity
    if ($type == 'IN') {
        $update = $mysqli->prepare("UPDATE items SET quantity = quantity + ? WHERE item_id = ?");
    } else {
        $update = $mysqli->prepare("UPDATE items SET quantity = quantity - ? WHERE item_id = ?");
    }
    $update->bind_param("ii", $qty, $item_id);
    $update->execute();

    echo "Transaction recorded successfully!";
}
?>