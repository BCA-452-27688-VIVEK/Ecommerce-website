<?php
session_start();
include("config/db.php");

$foods = mysqli_query($conn,"SELECT * FROM foods ORDER BY id DESC LIMIT 6");

$user_logged_in = isset($_SESSION['user_id']);
$user_name = $user_logged_in ? $_SESSION['user_name'] : "";
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Delicious Restaurant</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
background:#f5f7fb;
}

/* NAVBAR */

.navbar{
display:flex;
justify-content:space-between;
align-items:center;
padding:20px 80px;
background:rgba(0,0,0,0.85);
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
align-items:center;
}

.navbar ul li{
margin-left:25px;
position:relative;
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

/* USER BADGE */

.user-name{
background:#ff9800;
padding:6px 12px;
border-radius:20px;
font-size:14px;
}

/* HERO */

.hero{
height:100vh;
background:url("https://images.unsplash.com/photo-1414235077428-338989a2e8c0") center/cover no-repeat;
display:flex;
align-items:center;
justify-content:center;
text-align:center;
color:white;
position:relative;
}

.hero::before{
content:"";
position:absolute;
top:0;
left:0;
width:100%;
height:100%;
background:rgba(0,0,0,0.65);
}

.hero-content{
position:relative;
z-index:2;
}

.hero h1{
font-size:60px;
margin-bottom:20px;
}

.hero p{
font-size:20px;
margin-bottom:30px;
}

.btn{
padding:12px 30px;
background:#ff9800;
color:white;
text-decoration:none;
border-radius:5px;
font-size:18px;
transition:0.3s;
}

.btn:hover{
background:#e68900;
}

/* FOOD */

.food{
padding:100px 10%;
text-align:center;
background:#fafafa;
}

.food h2{
font-size:36px;
margin-bottom:40px;
}

.food-container{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
gap:30px;
}

.food-card{
background:white;
padding:20px;
border-radius:12px;
box-shadow:0 8px 25px rgba(0,0,0,0.1);
transition:0.4s;
}

.food-card img{
width:100%;
height:180px;
object-fit:cover;
border-radius:10px;
}

.food-card h3{
margin-top:15px;
}

.food-card p{
font-size:14px;
color:#555;
margin-top:8px;
}

.price{
color:#ff9800;
font-weight:bold;
margin-top:10px;
font-size:18px;
}

.order-btn{
display:inline-block;
margin-top:15px;
padding:8px 18px;
background:#ff9800;
color:white;
text-decoration:none;
border-radius:5px;
font-size:14px;
}

.order-btn:hover{
background:#e68900;
}

.food-card:hover{
transform:translateY(-10px);
box-shadow:0 15px 40px rgba(0,0,0,0.2);
}

/* ABOUT */

.about{
padding:100px 10%;
display:flex;
align-items:center;
gap:50px;
background:white;
flex-wrap:wrap;
}

.about img{
width:450px;
border-radius:10px;
}

.about-text h2{
font-size:36px;
margin-bottom:20px;
}

.about-text p{
line-height:1.6;
color:#444;
}

/* FOOTER */

footer{
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

<div class="logo">🍽 Delicious</div>

<ul>

<li><a href="index.php">Home</a></li>
<li><a href="menu.php">Menu</a></li>
<li><a href="contact.php">Contact</a></li>

<?php if($user_logged_in){ ?>

<li><a href="orders.php">My Orders</a></li>

<li class="user-name">👤 <?php echo $user_name; ?></li>

<li><a href="logout.php">Logout</a></li>

<?php } else { ?>

<li><a href="login.php">Login</a></li>

<?php } ?>

</ul>

</div>


<!-- HERO -->

<section class="hero">

<div class="hero-content">

<h1>Welcome to Delicious Restaurant</h1>

<p>Enjoy the best food experience in the city</p>

<a href="menu.php" class="btn">Explore Menu</a>

</div>

</section>


<!-- FOOD -->

<section class="food">

<h2>Popular Dishes</h2>

<div class="food-container">

<?php while($row=mysqli_fetch_assoc($foods)) { ?>

<div class="food-card">

<img src="uploads/<?php echo $row['image']; ?>">

<h3><?php echo $row['name']; ?></h3>

<p><?php echo $row['description']; ?></p>

<div class="price">₹<?php echo number_format($row['price'],2); ?></div>

<a href="order_food.php" class="order-btn">Order Now</a>

</div>

<?php } ?>

</div>

</section>


<!-- ABOUT -->

<section class="about">

<img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5">

<div class="about-text">

<h2>About Our Restaurant</h2>

<p>
Our restaurant provides high-quality food made with fresh ingredients.
Enjoy delicious meals prepared by expert chefs in a comfortable environment.
Experience taste, quality, and hospitality like never before.
</p>

</div>

</section>


<footer>

<p>© 2026 Delicious Restaurant | All Rights Reserved</p>

</footer>

</body>
</html>