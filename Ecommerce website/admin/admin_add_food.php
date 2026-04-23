<?php
include("../config/db.php");

$message="";

if(isset($_POST['add_food'])){

$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];

$image_name = $_FILES['image']['name'];
$tmp_name = $_FILES['image']['tmp_name'];

$folder = "../uploads/".$image_name;

move_uploaded_file($tmp_name,$folder);

$sql = "INSERT INTO foods (name,description,price,image)
VALUES ('$name','$description','$price','$image_name')";

if(mysqli_query($conn,$sql)){
$message="Food Added Successfully";
}else{
$message="Error Adding Food";
}

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Add Food - Admin</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
background:#f4f6f9;
display:flex;
}

/* SIDEBAR */

.sidebar{
width:230px;
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
margin-left:230px;
width:100%;
padding:30px;
}

/* TOPBAR */

.topbar{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:30px;
}

.logout{
background:#ff4d4d;
color:white;
padding:8px 18px;
text-decoration:none;
border-radius:5px;
}

/* FORM */

.container{
background:white;
padding:30px;
width:500px;
border-radius:10px;
box-shadow:0 10px 25px rgba(0,0,0,0.1);
}

h2{
margin-bottom:20px;
}

input,textarea{
width:100%;
padding:12px;
margin-bottom:15px;
border:1px solid #ccc;
border-radius:5px;
}

button{
width:100%;
padding:12px;
background:#ff9800;
border:none;
color:white;
font-size:16px;
border-radius:5px;
cursor:pointer;
}

button:hover{
background:#e68900;
}

.success{
background:#d4edda;
color:#155724;
padding:10px;
border-radius:5px;
margin-bottom:15px;
}

.preview{
width:120px;
margin-top:10px;
display:none;
border-radius:6px;
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
<li><a href="orders.php">Orders</a></li>
<li><a href="users.php">Users</a></li>
<li><a href="../logout.php">Logout</a></li>

</ul>

</div>


<!-- MAIN CONTENT -->

<div class="main">

<div class="topbar">

<h1>Add Food Item</h1>

<a href="../logout.php" class="logout">Logout</a>

</div>


<div class="container">

<?php
if($message!=""){
echo "<div class='success'>$message</div>";
}
?>

<form method="POST" enctype="multipart/form-data">

<input type="text" name="name" placeholder="Food Name" required>

<textarea name="description" placeholder="Food Description" required></textarea>

<input type="number" name="price" placeholder="Price" required>

<input type="file" name="image" id="imageInput" required>

<img id="preview" class="preview">

<button type="submit" name="add_food">Add Food</button>

</form>

</div>

</div>


<script>

document.getElementById("imageInput").onchange = function(evt){

const [file] = this.files;

if(file){
const preview = document.getElementById("preview");
preview.src = URL.createObjectURL(file);
preview.style.display="block";
}

};

</script>

</body>
</html>