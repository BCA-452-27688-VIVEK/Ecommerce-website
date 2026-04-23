<?php
include("config/db.php");

$query = "SELECT * FROM foods ORDER BY id DESC";
$result = mysqli_query($conn,$query);
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Restaurant Menu</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
background:#f5f5f5;
}

/* NAVBAR */

.navbar{
display:flex;
justify-content:space-between;
align-items:center;
padding:20px 80px;
background:#000;
position:fixed;
width:100%;
z-index:1000;
}

.logo{
color:white;
font-size:26px;
font-weight:bold;
}

.navbar ul{
display:flex;
list-style:none;
}

.navbar ul li{
margin-left:30px;
}

.navbar ul li a{
color:white;
text-decoration:none;
font-size:16px;
transition:0.3s;
}

.navbar ul li a:hover{
color:#ff9800;
}

/* HEADER */

.page-header{
height:40vh;
background:url("https://images.unsplash.com/photo-1504674900247-0877df9cc836") center/cover no-repeat;
display:flex;
align-items:center;
justify-content:center;
color:white;
font-size:40px;
font-weight:bold;
margin-bottom:60px;
}

/* MENU SECTION */

.menu{
padding:40px 10%;
}

.menu-container{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
gap:30px;
}

.menu-card{
background:white;
border-radius:10px;
box-shadow:0 5px 20px rgba(0,0,0,0.1);
overflow:hidden;
transition:0.3s;
}

.menu-card:hover{
transform:translateY(-10px);
}

.menu-card img{
width:100%;
height:200px;
object-fit:cover;
}

.menu-content{
padding:20px;
}

.menu-content h3{
margin-bottom:10px;
}

.price{
color:#ff9800;
font-weight:bold;
font-size:18px;
margin-top:10px;
}

.btn{
display:inline-block;
margin-top:15px;
padding:10px 20px;
background:#ff9800;
color:white;
text-decoration:none;
border-radius:5px;
}

.btn:hover{
background:#e68900;
}

/* FOOTER */

footer{
margin-top:80px;
background:black;
color:white;
text-align:center;
padding:20px;
}

</style>

</head>
<body>

<!-- NAVBAR -->

<div class="navbar">

<div class="logo">Delicious</div>

<ul>
<li><a href="index.php">Home</a></li>
<li><a href="menu.php">Menu</a></li>
</ul>

</div>


<!-- PAGE HEADER -->

<div class="page-header">
Our Menu
</div>


<!-- MENU ITEMS -->

<section class="menu">

<div class="menu-container">

<?php
while($row=mysqli_fetch_assoc($result)){
?>

<div class="menu-card">

<img src="uploads/<?php echo $row['image']; ?>">

<div class="menu-content">

<h3><?php echo $row['name']; ?></h3>

<p><?php echo $row['description']; ?></p>

<div class="price">₹<?php echo number_format($row['price'],2); ?></div>

<a href="order_food.php?id=<?php echo $row['id']; ?>" class="btn">Order Now</a>

</div>

</div>

<?php } ?>

</div>

</section>


<!-- FOOTER -->

<footer>

<p>© 2026 Delicious Restaurant | All Rights Reserved</p>

</footer>

</body>
</html>