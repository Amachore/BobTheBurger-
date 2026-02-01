<?php
include "connect.php";

$stock_column = 'quantity';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_id = $_POST['item_id'];
    $user_id = $_POST['user_id'];
    $transaction_type = $_POST['transaction_type'];
    $quantity = $_POST['quantity'];
    $raw_date = $_POST['transaction_date'];

    if (empty($raw_date)) {
        die("Error: Transaction date is required.");
    }
    $date_obj = DateTime::createFromFormat('Y-m-d', $raw_date);
    if (!$date_obj || $date_obj->format('Y-m-d') !== $raw_date) {
        die("Error: Invalid date format. Please use YYYY-MM-DD.");
    }
    $transaction_date = $date_obj->format('Y-m-d H:i:s');

    echo "Formatted transaction_date: $transaction_date<br>";

    if (empty($item_id) || empty($user_id) || empty($transaction_type) || empty($quantity)) {
        die("Error: All fields are required.");
    }

    $mysqli->begin_transaction();

    try {
        $stmt = $mysqli->prepare("INSERT INTO inventory_transactions (item_id, user_id, transaction_type, quantity, transaction_date) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iisss", $item_id, $user_id, $transaction_type, $quantity, $transaction_date);
        $stmt->execute();
        $stmt->close();

        if ($transaction_type == 'IN') {
            $update_sql = "UPDATE items SET $stock_column = $stock_column + ? WHERE item_id = ?";
        } else {
            $update_sql = "UPDATE items SET $stock_column = $stock_column - ? WHERE item_id = ?";
        }
        $update_stmt = $mysqli->prepare($update_sql);
        $update_stmt->bind_param("di", $quantity, $item_id);
        $update_stmt->execute();
        $update_stmt->close();

        $mysqli->commit();

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    } catch (Exception $e) {
        $mysqli->rollback();
        die("Error inserting transaction: " . $e->getMessage());
    }
} else {
    header("Location: index.php");
    exit();
}
?>
