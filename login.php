<?php
session_start();
include "connect.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // Join with roles to get the role name immediately
    $sql = "SELECT u.*, r.role_name FROM users u 
            JOIN roles r ON u.role_id = r.role_id 
            WHERE u.username = '$username'";
            
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['role'] = $user['role_name'];

            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "User not found!";
    }
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Bob the Burger - Login</title>
    <link rel="stylesheet" href="loginstyle.css">
</head>
<body>

<div class="login-container">
    <div class="brand-section">
        <div class="burger-icon">🍔</div>
        <h1>BOB THE BURGER</h1>
        <p>Quality in every bite.</p>
    </div>

    <div class="form-section">
        <h2>WELCOME</h2>
        
        <?php if($error): ?>
            <div class="error-msg"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            
            <button type="submit">LOGIN</button>
        </form>

        <div style="margin-top: 30px; border-top: 1px solid #ccc; padding-top: 10px;">
            <small>[ Bob's Inventory Management System ]</small>
        </div>
    </div>
</div>

<div id="datetime-container" class="clock-display">
    <div id="live-date"></div>
    <div id="live-clock"></div>
</div>

<script>
    function updateClock() {
        const now = new Date();

        // 1. Format the Date: Month/Day/Year
        const monthName = now.toLocaleString('default', { month: 'long' });
        const day = now.getDate();
        const year = now.getFullYear();
        document.getElementById('live-date').textContent = `${monthName}/${day}/${year}`;

        // 2. Format the Time
        const timeOptions = { 
            hour: '2-digit', 
            minute: '2-digit', 
            second: '2-digit', 
            hour12: true 
        };
        document.getElementById('live-clock').textContent = now.toLocaleTimeString([], timeOptions);
    }

    setInterval(updateClock, 1000);
    updateClock();
</script>

</body>
</html>