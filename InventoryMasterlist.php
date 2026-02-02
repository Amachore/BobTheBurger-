<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Bob the Burger IMS - Inventory</title>
  <style>
    body {margin:0;font-family:Arial,sans-serif;background-color:#f9f9f9;}
    .sidebar {position:fixed;left:0;top:0;bottom:0;width:200px;background-color:#EA0802;color:white;display:flex;flex-direction:column;align-items:center;}
    .sidebar nav ul {list-style:none;padding:0;margin:20px 0;}
    .sidebar nav ul li {padding:10px;cursor:pointer;}
    .logo-top img,.logo-bottom img {width:100px;}
    .content {margin-left:220px;padding:20px;}
    .page-header {display:flex;justify-content:space-between;align-items:center;}
    .small-logo {height:50px;}
    table {width:100%;border-collapse:collapse;margin-top:20px;font-size:14px;}
    th,td {border:1px solid #ddd;padding:10px;text-align:center;}
    th {background-color:#FFCD98;font-weight:bold;}
    tr:nth-child(even) {background-color:#f2f2f2;}
    .edit-btn {
      background-color:#A8E008;
      padding:5px 10px;
      color:white;
      text-decoration:none;
      border-radius:4px;
    }
    .delete-btn {
      background-color:#EA0802;
      padding:5px 10px;
      color:white;
      text-decoration:none;
      border-radius:4px;
      margin-left:5px;
    }
    .edit-btn:hover {background-color:#8ac006;}
    .delete-btn:hover {background-color:#c30602;}
  </style>
</head>
<body>
  <aside class="sidebar">
    <div class="logo-top"><img src="bun-top.png" alt="Top Bun"></div>
    <nav>
      <ul>
        <li>User Management</li>
        <li>Inventory Management</li>
        <li>Report Sales</li>
        <li>Inv. Add-Remove</li>
        <li>Suppliers</li>
        <li>Transactions</li>
        <li>Settings</li>
        <li>Logout</li>
      </ul>
    </nav>
    <div class="logo-bottom"><img src="bun-bottom.png" alt="Bottom Bun"></div>
  </aside>
  <main class="content">
    <header class="page-header">
      <h1>Inventory Masterlist</h1>
      <img src="logo.png" alt="Bob the Burger Logo" class="small-logo">
    </header>
    <section class="inventory-table">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Qnty</th>
            <th>Unit</th>
            <th>Expiration</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            include 'connect.php';
            $result = $mysqli->query("SELECT * FROM inventory");
            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['category']}</td>
                            <td>{$row['quantity']}</td>
                            <td>{$row['unit']}</td>
                            <td>{$row['expiration']}</td>
                            <td>
                              <a href='edit.php?id={$row['id']}' class='edit-btn'>Edit</a>
                              <a href='delete.php?id={$row['id']}' class='delete-btn'>Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No items found</td></tr>";
            }
          ?>
        </tbody>
      </table>
    </section>
  </main>
</body>
</html>