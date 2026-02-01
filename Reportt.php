<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Bob the Burger IMS - Report</title>
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
    .report-layout {display:flex;gap:20px;}
    .report-left {flex:2;}
    .graph {position:relative;} 
    .graph-box {min-height:400px;max-height:600px;background:#fff;border:1px solid #ccc;border-radius:8px;padding:10px;overflow-x:auto;}
    table {width:100%;border-collapse:collapse;margin-top:20px;background:#fff;border-radius:8px;overflow:hidden;position:relative;}
    table th, table td {padding:12px;text-align:center;border-bottom:1px solid #ddd;}
    table th {background-color:#EA0802;color:white;}
    .in-row {background:#e8f9e8;}
    .out-row {background:#fce8e8;}
    .filter-box {margin-bottom:15px;}
    .add-entry-btn {position:absolute;top:10px;right:10px;background:#06D6A0;color:#fff;border:none;padding:12px 24px;border-radius:20px;cursor:pointer;font-weight:bold;font-size:16px;box-shadow:0 4px 8px rgba(0,0,0,0.2);z-index:10;transition:background 0.3s;}
    .add-entry-btn:hover {background:#05b890;}
    .add-entry-btn::before {content:"+";margin-right:8px;font-size:18px;}
    .modal {display:none;position:fixed;z-index:1000;left:0;top:0;width:100%;height:100%;overflow:auto;background:rgba(0,0,0,0.5);}
    .modal-content {background:#fff;margin:10% auto;padding:20px;border-radius:8px;width:400px;}
    .close {float:right;font-size:24px;font-weight:bold;cursor:pointer;}
    .form-group {margin-bottom:15px;}
    .form-group label {display:block;margin-bottom:5px;}
    .form-group input, .form-group select {width:100%;padding:8px;border:1px solid #ccc;border-radius:4px;}
    .submit-btn {background:#EA0802;color:#fff;border:none;padding:10px 20px;border-radius:4px;cursor:pointer;font-weight:bold;}
  </style>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
      <h1>Inventory Report</h1>
      <img src="logo.png" alt="Bob the Burger Logo" class="small-logo">
    </header>

    <div class="report-layout">
      <div class="report-left">
        <section class="graph">
          <h2>Stock Flow</h2>
          <button class="add-entry-btn" onclick="document.getElementById('addModal').style.display='block'">Add Entry</button>
          <div class="filter-box">
            <form method="GET">
              <label>View by:</label>
              <select name="range" onchange="this.form.submit()">
                <option value="daily" <?php if($_GET['range']=='daily') echo 'selected'; ?>>Daily</option>
                <option value="monthly" <?php if($_GET['range']=='monthly') echo 'selected'; ?>>Monthly</option>
                <option value="yearly" <?php if($_GET['range']=='yearly') echo 'selected'; ?>>Yearly</option>
              </select>
              <label>Mode:</label>
              <select name="mode" onchange="this.form.submit()">
                <option value="aggregated" <?php if($_GET['mode']!='individual') echo 'selected'; ?>>Aggregated</option>
                <option value="individual" <?php if($_GET['mode']=='individual') echo 'selected'; ?>>Individual</option>
              </select>
            </form>
          </div>
          <div class="graph-box">
            <canvas id="transactionChart"></canvas>
          </div>
        </section>

        <section class="transaction-table">
          <h2>Transaction Records</h2>
          <table>
            <thead>
              <tr>
                <th>ID</th><th>Item</th><th>User</th><th>Type</th><th>Qty</th><th>Date</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include "connect.php";
              $range = $_GET['range'] ?? 'daily';
              $mode = $_GET['mode'] ?? 'aggregated';
              $sql = "SELECT it.transaction_id, i.item_name, u.full_name, it.transaction_type, it.quantity, it.transaction_date
                      FROM inventory_transactions it
                      JOIN items i ON it.item_id = i.item_id
                      JOIN users u ON it.user_id = u.user_id
                      ORDER BY it.transaction_date DESC";
              $result = $mysqli->query($sql);
              $labels = [];
              $inData = [];
              $outData = [];
              if ($mode == 'aggregated') {
                $grouped = [];
                while($row = $result->fetch_assoc()){
                  $class = $row['transaction_type'] == 'IN' ? 'in-row' : 'out-row';
                  echo "<tr class='$class'>
                            <td>{$row['transaction_id']}</td>
                            <td>{$row['item_name']}</td>
                            <td>{$row['full_name']}</td>
                            <td>{$row['transaction_type']}</td>
                            <td>{$row['quantity']}</td>
                            <td>{$row['transaction_date']}</td>
                         </tr>";
                  if ($range == 'daily') {
                    $label = date("Y-m-d", strtotime($row['transaction_date']));
                  } elseif ($range == 'monthly') {
                    $label = date("Y-m", strtotime($row['transaction_date']));
                  } else {
                    $label = date("Y", strtotime($row['transaction_date']));
                  }
                  if (!isset($grouped[$label])) $grouped[$label] = ['in' => 0, 'out' => 0];
                  if ($row['transaction_type'] == 'IN') { $grouped[$label]['in'] += $row['quantity']; }
                  else { $grouped[$label]['out'] += $row['quantity']; }
                }
                $labels = array_keys($grouped);
                $inData = array_column($grouped, 'in');
                $outData = array_column($grouped, 'out');
              } else { // individual mode
                while($row = $result->fetch_assoc()){
                  $class = $row['transaction_type'] == 'IN' ? 'in-row' : 'out-row';
                  echo "<tr class='$class'>
                            <td>{$row['transaction_id']}</td>
                            <td>{$row['item_name']}</td>
                            <td>{$row['full_name']}</td>
                            <td>{$row['transaction_type']}</td>
                            <td>{$row['quantity']}</td>
                            <td>{$row['transaction_date']}</td>
                         </tr>";
                  $label = date("Y-m-d", strtotime($row['transaction_date'])); 
                  $labels[] = $label;
                  if ($row['transaction_type'] == 'IN') {
                    $inData[] = $row['quantity'];
                    $outData[] = 0; 
                  } else {
                    $inData[] = 0; 
                    $outData[] = $row['quantity'];
                  }
                }
              }
              ?>
            </tbody>
          </table>
        </section>
      </div>
    </div>
  </main>

  <div id="addModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="document.getElementById('addModal').style.display='none'">&times;</span>
    <h2>Add Transaction</h2>
    <form action="InsertTrans.php" method="POST" onsubmit="document.getElementById('addModal').style.display='none';">
      <div class="form-group">
        <label>Item</label>
        <select name="item_id" required>
          <?php
          $items = $mysqli->query("SELECT item_id, item_name FROM items ORDER BY item_name");
          while($i = $items->fetch_assoc()){ echo "<option value='{$i['item_id']}'>{$i['item_name']}</option>"; }
          ?>
        </select>
      </div>
      <div class="form-group">
        <label>User</label>
        <select name="user_id" required>
          <?php
          $users = $mysqli->query("SELECT user_id, full_name FROM users ORDER BY full_name");
          while($u = $users->fetch_assoc()){ echo "<option value='{$u['user_id']}'>{$u['full_name']}</option>"; }
          ?>
        </select>
      </div>
      <div class="form-group">
        <label>Transaction Type</label>
        <select name="transaction_type" required>
          <option value="IN">IN</option>
          <option value="OUT">OUT</option>
        </select>
      </div>
      <div class="form-group">
        <label>Quantity</label>
        <input type="number" step="0.01" name="quantity" required>
      </div>
      <div class="form-group">
        <label>Date</label>
        <input type="date" name="transaction_date" max="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>" required>
      </div>
      <button type="submit" class="submit-btn">Save Transaction</button>
    </form>
  </div>
</div>

  <script>
    const labels = <?php echo json_encode($labels); ?>;
    const inData = <?php echo json_encode($inData); ?>;
    const outData = <?php echo json_encode($outData); ?>;
    new Chart(document.getElementById('transactionChart'), {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [
          { label: 'IN', data: inData, backgroundColor: '#A8E008' },
          { label: 'OUT', data: outData, backgroundColor: '#EA0802' }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { position: 'top' } },
        scales: {
          x: { ticks: { autoSkip: false, maxRotation: 45, minRotation: 30 } },
          y: { beginAtZero: true }
        }
      }
    });
  </script>
</body>
</html>