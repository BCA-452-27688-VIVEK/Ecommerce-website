<?php
session_start();
include("config/db.php");

/* Check Login */

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}

$user_id = $_SESSION['user_id'];

$message = "";

/* Order Food */

if(isset($_POST['order'])){

$food_id = $_POST['food_id'];
$quantity = $_POST['quantity'];

$food = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM foods WHERE id='$food_id'"));

$total_price = $food['price'] * $quantity;

$sql = "INSERT INTO orders (user_id,food_id,quantity,total_price,status)
VALUES ('$user_id','$food_id','$quantity','$total_price','Pending')";

if(mysqli_query($conn,$sql)){
$message = "✅ Order Placed Successfully!";
}else{
$message = "❌ Order Failed!";
}

}

/* Fetch Foods */

$foods = mysqli_query($conn,"SELECT * FROM foods ORDER BY id DESC");

?>

<!DOCTYPE html>
<html>
<head>

<title>Order Food</title>

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
}

/* NAVBAR */

.navbar{
background:#111;
padding:18px 80px;
display:flex;
justify-content:space-between;
align-items:center;
color:white;
}

.logo{
font-size:22px;
font-weight:bold;
}

.navbar a{
color:white;
text-decoration:none;
margin-left:25px;
font-size:15px;
}

.navbar a:hover{
color:#ff9800;
}

/* TITLE */

.title{
text-align:center;
margin:40px 0;
font-size:32px;
}

/* SUCCESS MESSAGE */

.success{
text-align:center;
width:40%;
margin:auto;
background:#e8f5e9;
padding:12px;
border-radius:6px;
color:#2e7d32;
margin-bottom:20px;
}

/* FOOD GRID */

.container{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
gap:30px;
padding:0 80px 80px;
}

.card{
background:white;
border-radius:12px;
box-shadow:0 8px 25px rgba(0,0,0,0.1);
overflow:hidden;
transition:0.4s;
}

.card:hover{
transform:translateY(-10px);
box-shadow:0 15px 40px rgba(0,0,0,0.2);
}

.card img{
width:100%;
height:200px;
object-fit:cover;
}

.card-body{
padding:20px;
}

.card-body h3{
margin-bottom:8px;
}

.card-body p{
font-size:14px;
color:#555;
margin-bottom:10px;
}

/* PRICE */

.price{
color:#ff9800;
font-weight:bold;
font-size:18px;
margin-bottom:12px;
}

/* INPUT */

input[type=number]{
width:100%;
padding:8px;
margin-bottom:12px;
border:1px solid #ccc;
border-radius:6px;
}

/* BUTTON */

button{
width:100%;
padding:10px;
border:none;
background:#ff9800;
color:white;
border-radius:6px;
cursor:pointer;
font-size:15px;
transition:0.3s;
}

button:hover{
background:#e68900;
}

</style>

</head>

<body>

<!-- NAVBAR -->

<div class="navbar">

<div class="logo">🍽 Delicious Restaurant</div>

<div>
<a href="index.php">Home</a>
<a href="menu.php">Menu</a>
<a href="orders.php">My Orders</a>
<a href="logout.php">Logout</a>
</div>

</div>

<h2 class="title">Order Your Favorite Food</h2>

<?php if($message!=""){ ?>
<p class="success"><?php echo $message; ?></p>
<?php } ?>

<div class="container">

<?php while($row=mysqli_fetch_assoc($foods)) { ?>

<div class="card">

<img src="uploads/<?php echo $row['image']; ?>">

<div class="card-body">

<h3><?php echo $row['name']; ?></h3>

<p><?php echo $row['description']; ?></p>

<p class="price">₹<?php echo number_format($row['price'],2); ?></p>

<form method="POST">

<input type="hidden" name="food_id" value="<?php echo $row['id']; ?>">

<input type="number" name="quantity" value="1" min="1" required>

<button type="submit" name="order">Order Now</button>

</form>

</div>

</div>

<?php } ?>

</div>

</body>
</html>