<?php
session_start();
include("../config/db.php");

/* Fetch Foods */

$query = mysqli_query($conn,"SELECT * FROM foods ORDER BY id DESC");

/* Delete Food */

if(isset($_GET['delete'])){

$id = $_GET['delete'];

mysqli_query($conn,"DELETE FROM foods WHERE id='$id'");

header("Location: manage_food.php");

}

?>

<!DOCTYPE html>
<html>
<head>

<title>Manage Foods</title>

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
width:230px;
background:#111;
height:100vh;
padding-top:30px;
position:fixed;
}

.sidebar h2{
color:white;
text-align:center;
margin-bottom:30px;
}

.sidebar a{
display:block;
color:#ddd;
padding:15px 25px;
text-decoration:none;
}

.sidebar a:hover{
background:#ff9800;
color:white;
}

/* MAIN CONTENT */

.main{
margin-left:230px;
padding:40px;
width:100%;
}

h1{
margin-bottom:20px;
}

/* TABLE */

table{
width:100%;
border-collapse:collapse;
background:white;
box-shadow:0 5px 20px rgba(0,0,0,0.1);
}

table th{
background:#2c3e50;
color:white;
padding:12px;
}

table td{
padding:12px;
text-align:center;
border-bottom:1px solid #ddd;
}

img{
width:70px;
border-radius:6px;
}

/* BUTTONS */

.btn{
padding:6px 12px;
border-radius:4px;
text-decoration:none;
color:white;
}

.edit{
background:#3498db;
}

.delete{
background:#e74c3c;
}

.add{
background:#27ae60;
padding:10px 18px;
margin-bottom:15px;
display:inline-block;
}

</style>

</head>

<body>


<!-- SIDEBAR -->

<div class="sidebar">

<h2>Admin Panel</h2>

<a href="admin_dashboard.php">Dashboard</a>

<a href="admin_add_food.php">Add Food</a>

<a href="manage_food.php">Manage Foods</a>

<a href="../logout.php">Logout</a>

</div>


<!-- MAIN -->

<div class="main">

<h1>Manage Food Items</h1>

<a class="btn add" href="admin_add_food.php">+ Add New Food</a>

<table>

<tr>

<th>ID</th>
<th>Image</th>
<th>Name</th>
<th>Description</th>
<th>Price</th>
<th>Actions</th>

</tr>

<?php while($row=mysqli_fetch_assoc($query)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td>
<img src="../uploads/<?php echo $row['image']; ?>">
</td>

<td><?php echo $row['name']; ?></td>

<td><?php echo $row['description']; ?></td>

<td>₹<?php echo number_format($row['price'],2); ?></td>

<td>

<a class="btn edit" href="edit_food.php?id=<?php echo $row['id']; ?>">Edit</a>

<a class="btn delete" 
href="manage_food.php?delete=<?php echo $row['id']; ?>" 
onclick="return confirm('Delete this food item?')">

Delete

</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>