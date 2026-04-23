<?php
session_start();
include("../config/db.php");

/* Get Food ID */

if(!isset($_GET['id'])){
    header("Location: manage_food.php");
}

$id = $_GET['id'];

/* Fetch Food */

$result = mysqli_query($conn,"SELECT * FROM foods WHERE id='$id'");
$food = mysqli_fetch_assoc($result);

$message="";

/* Update Food */

if(isset($_POST['update_food'])){

$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];

$image_name = $_FILES['image']['name'];

if($image_name!=""){

$tmp = $_FILES['image']['tmp_name'];
$folder = "../uploads/".$image_name;

move_uploaded_file($tmp,$folder);

$update = "UPDATE foods SET 
name='$name',
description='$description',
price='$price',
image='$image_name'
WHERE id='$id'";

}else{

$update = "UPDATE foods SET 
name='$name',
description='$description',
price='$price'
WHERE id='$id'";

}

if(mysqli_query($conn,$update)){
$message="Food Updated Successfully";
$food = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM foods WHERE id='$id'"));
}else{
$message="Update Failed";
}

}

?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Food</title>

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
height:100vh;
background:#111;
color:white;
position:fixed;
padding-top:30px;
}

.sidebar h2{
text-align:center;
margin-bottom:30px;
}

.sidebar a{
display:block;
padding:15px 25px;
color:#ddd;
text-decoration:none;
}

.sidebar a:hover{
background:#ff9800;
color:white;
}

/* MAIN */

.main{
margin-left:230px;
padding:40px;
width:100%;
}

/* FORM */

.container{
background:white;
padding:30px;
border-radius:10px;
width:500px;
box-shadow:0 5px 20px rgba(0,0,0,0.1);
}

h1{
margin-bottom:20px;
}

input, textarea{
width:100%;
padding:12px;
margin-bottom:15px;
border:1px solid #ccc;
border-radius:5px;
}

img{
width:120px;
margin-bottom:15px;
border-radius:8px;
}

button{
width:100%;
padding:12px;
border:none;
background:#ff9800;
color:white;
font-size:16px;
border-radius:5px;
cursor:pointer;
}

button:hover{
background:#e68900;
}

.success{
color:green;
margin-bottom:15px;
}

</style>

</head>

<body>

<!-- SIDEBAR -->

<div class="sidebar">

<h2>Admin Panel</h2>

<a href="admin_dashboard.php">Dashboard</a>
<a href="admin_add_food.php">Add Food</a>
<a href="manage_food.php">Manage Food</a>
<a href="../logout.php">Logout</a>

</div>

<!-- MAIN CONTENT -->

<div class="main">

<div class="container">

<h1>Edit Food</h1>

<?php
if($message!=""){
echo "<p class='success'>$message</p>";
}
?>

<form method="POST" enctype="multipart/form-data">

<label>Food Name</label>
<input type="text" name="name" value="<?php echo $food['name']; ?>" required>

<label>Description</label>
<textarea name="description" required><?php echo $food['description']; ?></textarea>

<label>Price (₹)</label>
<input type="number" name="price" value="<?php echo $food['price']; ?>" required>

<label>Current Image</label><br>
<img src="../uploads/<?php echo $food['image']; ?>">

<label>Change Image</label>
<input type="file" name="image">

<button type="submit" name="update_food">Update Food</button>

</form>

</div>

</div>

</body>
</html>