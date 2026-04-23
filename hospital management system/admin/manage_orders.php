<?php
session_start();
include('../config/db.php');

/* UPDATE ORDER STATUS */
if(isset($_POST['update_status'])){
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    mysqli_query($conn,"UPDATE orders SET status='$status' WHERE id='$order_id'");
}

/* FETCH ORDERS */
$query = "SELECT orders.*, 
          foods.name AS food_name, 
          foods.image, 
          foods.price
          FROM orders
          JOIN foods ON orders.food_id = foods.id
          ORDER BY orders.id DESC";

$result = mysqli_query($conn,$query);
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Orders</title>

<style>

body{
    font-family: Arial;
    background:#f4f4f4;
}

.container{
    width:90%;
    margin:auto;
}

h2{
    margin:20px 0;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
}

table th, table td{
    padding:10px;
    border:1px solid #ddd;
    text-align:center;
}

th{
    background:#333;
    color:white;
}

img{
    width:70px;
}

select{
    padding:5px;
}

button{
    padding:6px 12px;
    background:#28a745;
    color:white;
    border:none;
    cursor:pointer;
}

button:hover{
    background:#218838;
}

</style>
</head>

<body>

<div class="container">

<h2>Admin - Manage Orders</h2>

<table>

<tr>
<th>ID</th>
<th>Food</th>
<th>Image</th>
<th>Price</th>
<th>Quantity</th>
<th>Total</th>
<th>Status</th>
<th>Update</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['food_name']; ?></td>

<td>
<img src="../uploads/<?php echo $row['image']; ?>">
</td>

<td>₹<?php echo $row['price']; ?></td>

<td><?php echo $row['quantity']; ?></td>

<td>₹<?php echo $row['price'] * $row['quantity']; ?></td>

<td><?php echo $row['status']; ?></td>

<td>

<form method="POST">

<input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">

<select name="status">

<option value="Pending" <?php if($row['status']=="Pending") echo "selected"; ?>>Pending</option>

<option value="Preparing" <?php if($row['status']=="Preparing") echo "selected"; ?>>Preparing</option>

<option value="Delivered" <?php if($row['status']=="Delivered") echo "selected"; ?>>Delivered</option>

<option value="Cancelled" <?php if($row['status']=="Cancelled") echo "selected"; ?>>Cancelled</option>

</select>

<button name="update_status">Update</button>

</form>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>