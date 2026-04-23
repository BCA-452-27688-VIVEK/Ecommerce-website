<?php
session_start();
include("config/db.php");

$message="";

/* ======================
USER SIGNUP
====================== */

if(isset($_POST['signup'])){

$name=$_POST['name'];
$email=$_POST['email'];
$password=password_hash($_POST['password'],PASSWORD_DEFAULT);

$check=mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");

if(mysqli_num_rows($check)>0){
$message="Email already registered";
}else{

$sql="INSERT INTO users(name,email,password,role)
VALUES('$name','$email','$password','user')";

if(mysqli_query($conn,$sql)){
$message="Account Created Successfully!";
}else{
$message="Error creating account";
}

}

}


/* ======================
USER LOGIN
====================== */

if(isset($_POST['login'])){

$email=$_POST['email'];
$password=$_POST['password'];

$sql=mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");
$user=mysqli_fetch_assoc($sql);

if($user && password_verify($password,$user['password'])){

$_SESSION['user_id']=$user['id'];
$_SESSION['user_name']=$user['name'];
$_SESSION['role']=$user['role'];

if($user['role']=="admin"){
header("Location: admin/admin_dashboard.php");
}else{
header("Location: index.php");
}

}else{
$message="Invalid Email or Password";
}

}

?>


<!DOCTYPE html>
<html>
<head>

<title>User Login</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:linear-gradient(120deg,#ff9800,#ff5722);
}

.container{
width:800px;
height:500px;
background:white;
border-radius:10px;
display:flex;
box-shadow:0 10px 25px rgba(0,0,0,0.2);
overflow:hidden;
}

/* LEFT SIDE */

.left{
width:50%;
background:url("https://images.unsplash.com/photo-1504674900247-0877df9cc836") center/cover;
}

/* RIGHT SIDE */

.right{
width:50%;
padding:40px;
}

h2{
margin-bottom:20px;
}

input{
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

.switch{
margin-top:10px;
text-align:center;
cursor:pointer;
color:#ff5722;
}

.form{
display:none;
}

.form.active{
display:block;
}

.message{
background:#ffe0b2;
padding:10px;
margin-bottom:10px;
border-radius:5px;
}

</style>

</head>

<body>

<div class="container">

<div class="left"></div>

<div class="right">

<?php if($message!=""){ ?>

<div class="message"><?php echo $message; ?></div>

<?php } ?>

<!-- LOGIN FORM -->

<form method="POST" class="form active" id="loginForm">

<h2>Login</h2>

<input type="email" name="email" placeholder="Email" required>

<input type="password" name="password" placeholder="Password" required>

<button type="submit" name="login">Login</button>

<p class="switch" onclick="showSignup()">Don't have an account? Sign Up</p>

</form>


<!-- SIGNUP FORM -->

<form method="POST" class="form" id="signupForm">

<h2>Create Account</h2>

<input type="text" name="name" placeholder="Full Name" required>

<input type="email" name="email" placeholder="Email" required>

<input type="password" name="password" placeholder="Password" required>

<button type="submit" name="signup">Sign Up</button>

<p class="switch" onclick="showLogin()">Already have account? Login</p>

</form>

</div>

</div>


<script>

function showSignup(){
document.getElementById("loginForm").classList.remove("active");
document.getElementById("signupForm").classList.add("active");
}

function showLogin(){
document.getElementById("signupForm").classList.remove("active");
document.getElementById("loginForm").classList.add("active");
}

</script>

</body>
</html>