<?php
include("../config/db.php");

/* TOTAL ORDERS */
$order_query = mysqli_query($conn,"SELECT COUNT(*) AS total_orders FROM orders");
$order_data = mysqli_fetch_assoc($order_query);
$total_orders = $order_data['total_orders'];


/* TOTAL USERS */
$user_query = mysqli_query($conn,"SELECT COUNT(*) AS total_users FROM users");
$user_data = mysqli_fetch_assoc($user_query);
$total_users = $user_data['total_users'];

/* TOTAL FOOD ITEMS */
$food_query = mysqli_query($conn,"SELECT COUNT(*) AS total_food FROM foods");
$food_data = mysqli_fetch_assoc($food_query);
$total_food = $food_data['total_food'];

/* TOTAL REVENUE */
$revenue_query = mysqli_query($conn,"SELECT SUM(total_price) AS revenue FROM orders");
$revenue_data = mysqli_fetch_assoc($revenue_query);
$total_revenue = $revenue_data['revenue'] ? $revenue_data['revenue'] : 0;

/* RECENT ORDERS */
$recent_orders = mysqli_query($conn,"
SELECT orders.id, users.name AS customer, foods.name AS food, orders.status
FROM orders
JOIN users ON orders.user_id = users.id
JOIN foods ON orders.food_id = foods.id
ORDER BY orders.id DESC
LIMIT 5
");
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
display:flex;
background:#f4f6f9;
}

/* SIDEBAR */

.sidebar{
width:250px;
height:100vh;
background:#1e1e2f;
color:white;
position:fixed;
}

.sidebar h2{
text-align:center;
padding:20px;
border-bottom:1px solid #333;
}

.sidebar ul{
list-style:none;
}

.sidebar ul li{
padding:15px 20px;
border-bottom:1px solid #333;
}

.sidebar ul li a{
color:white;
text-decoration:none;
display:block;
}

.sidebar ul li:hover{
background:#ff9800;
}

/* MAIN CONTENT */

.main{
margin-left:250px;
width:100%;
padding:30px;
}

/* TOP BAR */

.topbar{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:30px;
}

.logout{
background:#ff4d4d;
padding:8px 18px;
color:white;
text-decoration:none;
border-radius:5px;
}

/* CARDS */

.cards{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:20px;
}

.card{
background:white;
padding:25px;
border-radius:10px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.card p{
font-size:28px;
font-weight:bold;
color:#ff9800;
}

/* TABLE */

.table-section{
margin-top:40px;
background:white;
padding:20px;
border-radius:10px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

table{
width:100%;
border-collapse:collapse;
}

table th,table td{
padding:12px;
border-bottom:1px solid #ddd;
}

table th{
background:#ff9800;
color:white;
}

</style>

</head>
<body>

<!-- SIDEBAR -->

<div class="sidebar">

<h2>Admin Panel</h2>

<ul>

<li><a href="admin_dashboard.php">Dashboard</a></li>
<li><a href="admin_add_food.php">Add Food</a></li>
<li><a href="manage_food.php">Manage Food</a></li>
<li><a href="manage_orders.php">Orders</a></li>
<li><a href="manage_users.php">Users</a></li>

</ul>

</div>

<!-- MAIN -->

<div class="main">

<div class="topbar">

<h1>Restaurant Dashboard</h1>

<a href="logout.php" class="logout">Logout</a>

</div>

<!-- CARDS -->

<div class="cards">

<div class="card">
<h3>Total Orders</h3>
<p><?php echo $total_orders; ?></p>
</div>

<div class="card">
<h3>Total Users</h3>
<p><?php echo $total_users; ?></p>
</div>

<div class="card">
<h3>Food Items</h3>
<p><?php echo $total_food; ?></p>
</div>

<div class="card">
<h3>Total Revenue</h3>
<p>₹<?php echo number_format($total_revenue); ?></p>
</div>

</div>

<!-- RECENT ORDERS -->

<div class="table-section">

<h2>Recent Orders</h2>

<table>

<tr>
<th>Order ID</th>
<th>Customer</th>
<th>Food</th>
<th>Status</th>
</tr>

<?php
while($row=mysqli_fetch_assoc($recent_orders)){
?>

<tr>

<td>#<?php echo $row['id']; ?></td>

<td><?php echo $row['customer']; ?></td>

<td><?php echo $row['food']; ?></td>

<td><?php echo $row['status']; ?></td>

</tr>

<?php } ?>

</table>

</div>

</div>

</body>
</html>