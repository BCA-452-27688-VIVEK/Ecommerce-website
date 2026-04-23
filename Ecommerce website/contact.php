<?php
include("config/db.php");

$message="";

if(isset($_POST['send_message'])){

$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message_text = $_POST['message'];

$sql="INSERT INTO contact_messages(name,email,subject,message)
VALUES('$name','$email','$subject','$message_text')";

if(mysqli_query($conn,$sql)){
$message="Message Sent Successfully!";
}else{
$message="Error Sending Message";
}

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Contact Us</title>

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
display:flex;
justify-content:space-between;
align-items:center;
padding:20px 80px;
background:#1e1e2f;
color:white;
}

.navbar ul{
display:flex;
list-style:none;
}

.navbar ul li{
margin-left:25px;
}

.navbar ul li a{
color:white;
text-decoration:none;
}

/* CONTACT SECTION */

.contact{
padding:80px 10%;
display:flex;
gap:50px;
flex-wrap:wrap;
}

.contact-form{
flex:1;
background:white;
padding:30px;
border-radius:10px;
box-shadow:0 10px 20px rgba(0,0,0,0.1);
}

.contact-form h2{
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

/* CONTACT INFO */

.contact-info{
flex:1;
}

.contact-info h2{
margin-bottom:20px;
}

.info-box{
background:white;
padding:20px;
margin-bottom:15px;
border-radius:8px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

/* MAP */

.map{
margin-top:40px;
}

iframe{
width:100%;
height:300px;
border:none;
border-radius:10px;
}

footer{
background:#1e1e2f;
color:white;
text-align:center;
padding:15px;
margin-top:40px;
}

</style>

</head>

<body>

<!-- NAVBAR -->

<div class="navbar">

<h2>Delicious</h2>

<ul>
<li><a href="index.php">Home</a></li>
<li><a href="menu.php">Menu</a></li>
</ul>

</div>


<!-- CONTACT SECTION -->

<div class="contact">

<!-- CONTACT FORM -->

<div class="contact-form">

<h2>Contact Us</h2>

<?php
if($message!=""){
echo "<div class='success'>$message</div>";
}
?>

<form method="POST">

<input type="text" name="name" placeholder="Your Name" required>

<input type="email" name="email" placeholder="Your Email" required>

<input type="text" name="subject" placeholder="Subject" required>

<textarea name="message" rows="5" placeholder="Your Message"></textarea>

<button type="submit" name="send_message">Send Message</button>

</form>

</div>


<!-- CONTACT INFO -->

<div class="contact-info">

<h2>Restaurant Info</h2>

<div class="info-box">
📍 Address: Mithapur, Patna, Bihar
</div>

<div class="info-box">
📞 Phone: +91 9876543210
</div>

<div class="info-box">
📧 Email: info@delicious.com
</div>


<div class="map">

<iframe src="https://maps.google.com/maps?q=patna&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>

</div>

</div>

</div>


<footer>

<p>© 2026 Delicious Restaurant | All Rights Reserved</p>

</footer>

</body>
</html>