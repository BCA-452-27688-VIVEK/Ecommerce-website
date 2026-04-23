<?php
session_start();
include('../config/db.php');

/* DELETE USER */
if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    mysqli_query($conn,"DELETE FROM users WHERE id='$id'");
    header("Location: manage_users.php");
}

/* FETCH USERS */
$result = mysqli_query($conn,"SELECT * FROM users ORDER BY id DESC");

?>

<!DOCTYPE html>
<html>
<head>

<title>Manage Users</title>

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
    padding:12px;
    border:1px solid #ddd;
    text-align:center;
}

th{
    background:#333;
    color:white;
}

button{
    padding:6px 12px;
    border:none;
    cursor:pointer;
}

.delete{
    background:#dc3545;
    color:white;
}

.delete:hover{
    background:#c82333;
}

</style>

</head>

<body>

<div class="container">

<h2>Admin - Manage Users</h2>

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Role</th>
<th>Action</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)) { ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['role']; ?></td>

<td>

<a href="manage_users.php?delete=<?php echo $row['id']; ?>" 
onclick="return confirm('Delete this user?')">

<button class="delete">Delete</button>

</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>