<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Bob the Burger IMS - Inventory Masterlist</title>
  <style>
    body {margin:0;font-family:Arial,sans-serif;background-color:#f9f9f9;}
    .sidebar {
    position: fixed;
    left: 0;
    top: 0;
    bottom: 0;
    width: 240px;
    background-color: #EA0802;
    color: white;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 20px 0; 
    }
    .sidebar nav ul {list-style:none;padding:0;margin:0;width:100%;}
    .sidebar nav ul li {margin:14px 0;}
    .sidebar nav ul li a {
    display: block;
    text-align: center;
    padding: 14px;
    font-size: 18px;
    font-weight: bold;
    text-decoration: none;
    border-radius: 8px;
    transition: background 0.3s, color 0.3s;
    color: white;
    }

  .sidebar nav ul li:nth-child(1) a { background-color: #EA0802; } 
  .sidebar nav ul li:nth-child(2) a { background-color: #FFD166; color:#8B4513; } 
  .sidebar nav ul li:nth-child(3) a { background-color: #8B4513; } 
  .sidebar nav ul li:nth-child(4) a { background-color: #A8E008; color:#8B4513; }
  .sidebar nav ul li:nth-child(5) a { background-color: #FFCD98; color:#8B4513; } 
  .sidebar nav ul li:nth-child(6) a { background-color: #EE851C; } 
  .sidebar nav ul li:nth-child(7) a { background-color: #FFD166; color:#8B4513; } 
  .sidebar nav ul li:nth-child(8) a { background-color: #EA0802; } 

  .sidebar nav ul li a:hover {
    filter: brightness(0.9);
  }
    .sidebar nav ul li a:hover {background-color:#06D6A0;color:#8B4513;}
    .logo-top img {width:240px;margin-bottom:-15px;} 
    .logo-bottom img {width:240px;margin-top:-15px;} 
    .content {margin-left:260px;padding:20px;}
    .page-header {display:flex;justify-content:space-between;align-items:center;}
    .small-logo {height:100px;}
    table {width:100%;border-collapse:collapse;margin-top:20px;background:#fff;border-radius:8px;}
    th,td {border:1px solid #ddd;padding:10px;text-align:center;}
    th {background-color:#FFCD98;}
    .low-stock {color:#EA0802;font-weight:bold;} 
    .near-expiry {color:#EE851C;font-weight:bold;}
  </style>
</head>
<body>
  <aside class="sidebar">
    <div class="logo-top"><img src="TopBun.png" alt="Top Bun"></div>
    <nav>
      <ul>
        <li><a href="#">User Management</a></li>
        <li><a href="#">Inventory Management</a></li>
        <li><a href="#">Report</a></li>
        <li><a href="#">Inv. Add-Remove</a></li>
        <li><a href="#">Suppliers</a></li>
        <li><a href="#">Transactions</a></li>
        <li><a href="#">Settings</a></li>
        <li><a href="#">Logout</a></li>
      </ul>
    </nav>
    <div class="logo-bottom"><img src="BotBun.png" alt="Bottom Bun"></div>
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
            <th>Quantity</th>
            <th>Unit</th>
            <th>Expiration</th>
            <th>Location</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include "connect.php";

          $categories = [
            1=>"Buns",2=>"Patties",3=>"Cheese",4=>"Veggies",5=>"Sauces",
            6=>"Add-ons",7=>"Sides",8=>"Drinks",9=>"Packaging",
            10=>"Consumables",11=>"Cooking Agents & Seasoning"
          ];
          $locations = [
            1=>"Dry Storage",2=>"Refrigerator",3=>"Freezer",
            4=>"Prep Area",5=>"Cold Storage",6=>"Beverage Chiller",7=>"Packaging Area"
          ];

          $result = $mysqli->query("SELECT * FROM items ORDER BY category_id, item_name");
          if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              $id = $row['item_id'];
              $name = $row['item_name'];
              $category = $categories[$row['category_id']] ?? $row['category_id'];
              $quantity = $row['quantity'];
              $unit = $row['unit'];
              $expiration = $row['expiration_date'];
              $location = $locations[$row['location_id']] ?? $row['location_id'];

              $alert = "";
                if ($quantity < 0) {
                  $alert .= "<span class='low-stock'>NEGATIVE STOCK</span> ";
                  } elseif ($quantity < 20) {
                  $alert .= "<span class='low-stock'>LOW STOCK</span> ";
                }
                if (!empty($expiration)) {
                  $expDate = new DateTime($expiration);
                  $today = new DateTime();
                  $interval = $today->diff($expDate)->days;
                  if ($expDate < $today || $interval <= 5) {
                    $alert .= "<span class='near-expiry'>NEAR EXPIRY</span>";
                  }
                }
              echo "<tr>
                      <td>$id</td>
                      <td>$name</td>
                      <td>$category</td>
                      <td>$quantity</td>
                      <td>$unit</td>
                      <td>$expiration</td>
                      <td>$location</td>
                      <td>$alert</td>
                    </tr>";
            }
          } else {
            echo "<tr><td colspan='8'>No items found</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </section>
  </main>
</body>
</html>