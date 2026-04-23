<?php
session_start();
include("config/db.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = mysqli_query($conn,"
SELECT orders.*, foods.name, foods.image, foods.price
FROM orders
JOIN foods ON orders.food_id = foods.id
WHERE orders.user_id='$user_id'
ORDER BY orders.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>My Orders</title>

<style>

body{
    font-family: Arial;
    background:#f5f7fb;
    margin:0;
}

/* NAVBAR */

.navbar{
    background:#2c3e50;
    padding:15px;
    color:white;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.navbar a{
    color:white;
    text-decoration:none;
    margin-left:20px;
}

/* CONTAINER */

.container{
    width:90%;
    margin:auto;
    margin-top:40px;
}

/* TABLE */

table{
    width:100%;
    border-collapse:collapse;
    background:white;
}

table th{
    background:#34495e;
    color:white;
    padding:12px;
}

table td{
    padding:12px;
    border-bottom:1px solid #ddd;
    text-align:center;
}

img{
    width:70px;
    border-radius:5px;
}

/* STATUS */

.pending{
    color:orange;
    font-weight:bold;
}

.completed{
    color:green;
    font-weight:bold;
}

.cancelled{
    color:red;
    font-weight:bold;
}

</style>
</head>

<body>

<div class="navbar">
    <h2>Food Order System</h2>

    <div>
        <a href="index.php">Home</a>
        <a href="menu.php">Menu</a>
        <a href="orders.php">My Orders</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="container">

<h2>My Orders</h2>

<table>

<tr>
<th>ID</th>
<th>Food</th>
<th>Image</th>
<th>Price</th>
<th>Quantity</th>
<th>Total</th>
<th>Status</th>
</tr>

<?php

if(mysqli_num_rows($query) > 0){

while($row = mysqli_fetch_assoc($query)){

$total = $row['price'] * $row['quantity'];

?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['name']; ?></td>

<td>
<img src="uploads/<?php echo $row['image']; ?>">
</td>

<td>₹<?php echo $row['price']; ?></td>

<td><?php echo $row['quantity']; ?></td>

<td>₹<?php echo $total; ?></td>

<td>
<span class="<?php echo strtolower($row['status']); ?>">
<?php echo ucfirst($row['status']); ?>
</span>
</td>

</tr>

<?php } } else { ?>

<tr>
<td colspan="7">No Orders Found</td>
</tr>

<?php } ?>

</table>

</div>

</body>
</html>