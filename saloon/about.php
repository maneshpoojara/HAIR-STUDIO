<?php
	session_start();
	if(!$_SESSION['loggedin'] === true){
		header("location: login.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Saloon</title>
	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
			font-family: sans-serif;
			color: #fff;
		}
		.banner{
			width: 100%;
			height: 100vh;
			background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url(data/img/bg.jpg);
			background-size: cover;
			background-position: center;
			overflow-y: scroll;
		}
		::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #888; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
		.navbar{
			width: 85%;
			margin: auto;
			padding: 35px 0;
			display: flex;
			align-items: center;
			justify-content: space-between;
		}
		.logo{
			font-size: 30px;
			cursor: pointer;
		}
		.navbar ul li{
			list-style: none;
			display: inline-block;
			margin: 0 20px;
			position: relative;
		}
		.navbar ul li a{
			text-decoration: none;
			color: #fff;
			text-transform: uppercase;
		}
		.navbar ul li::after{
			content: '';
			height: 3px;
			width: 0;
			background: #009688;
			position: absolute;
			left: 0;
			bottom: -10px;
			transition: 0.5s;
		}
		.navbar ul li:hover::after{
			width: 100%;
		}

		.navbar ul li.active::after{
			width: 100%;
		}
		.content{
			width: 100%;
			margin-top: 200px;
			margin-bottom: 200px;
			transform: translateY(-50%);
			text-align: center;
			color: #fff;
		}
		.content h1{
			font-size: 50px;
			margin-top: 10px;
		}
		.content p{
			margin: 10px;
		}
		.galleryimg{
			margin: 0;
			filter: grayscale(100%);
			transition: 0.5s;
		}
		.galleryimg:hover{
			filter: grayscale(0%);
		}
		.services{
			width: 250px;
			height: 300px;
			border: 1px solid #fff;
			border-radius: 0.5cm;
			background: #fff;
			color: #000;
		}
		.services b{
			color: #000;
		}
		.services div{
			background: orange;
			width: 100%;
			border: none;
			padding: 10px 0;
		}
		.servicescon ul li{
			display: inline-block;
		}
	</style>
</head>
<body>
	<div class="banner">
		<div class="navbar">
			<b class="logo">Hair Studio</b>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="book.php">Book Appointment</a></li>
				<li><a href="contact.php">Contact us</a></li>
				<?php
					if ($_SESSION['loggedin'] === true) {
						echo '<li><a href="logout.php">Logout</a></li>';
					}
					else{
						echo '<li><a href="login.php">Login</a></li>';
					}
				?>
			</ul>
		</div>
		<div class="content">
			<h1>Hair Studio</h1>
			<p>World's classy Hair Saloon.</p>
		</div>
		<div>
			<h1 style="margin-left: 20px;">Our Team</h1><br>
			<p style="margin-left:30px;margin-right: 15px;">
				Hair Studio is a online platform to Manage Stylist and Custumer of Our Hair Saloon and this platform allow users to book an appointment to the stylist they want to get service from and Stylist has permission to Approve or Reject the appointment.<br><br>
				This Platform is Developed by Manesh, Athar and Mazhar using Html, CSS, JavaScript, Jquery, Php and MySql.
			</p>
		</div><br>
		<div class="servicescon">
			<h1 style="margin-left: 20px;">Our Services</h1><br>
			<center>
			<ul>
			<li><div class="services">
				<br><img src="data/img/haircut.jpg" width="200" height="150"><br>
				<b>hair Cut</b><br><br>
				<div>Price : &#8377;120</div>
			</div></li>
			<li><div class="services">
				<br><img src="data/img/color.jpg" width="200" height="150"><br>
				<b>Hair colour</b><br><br>
				<div>Price : &#8377;150</div>
			</div></li>
			<li><div class="services">
				<br><img src="data/img/trim.jpg" width="200" height="150"><br>
				<b>Trimming</b><br><br>
				<div>Price : &#8377;70</div>
			</div></li>
			<li><div class="services">
				<br><img src="data/img/mehendi.jpg" width="200" height="150"><br>
				<b>Mehendi art</b><br><br>
				<div>Price : Starts from &#8377;300</div>
			</div></li>
		</ul>
	</center>
		</div><br>
		<div>
			<h1 style="margin-left: 20px;">Gallery</h1><br>
			<center>
				<img src="data/img/img1.jpg" class="galleryimg" width="290" height="350" />
				<img src="data/img/img2.jpg" class="galleryimg" width="290" height="350" />
				<img src="data/img/img3.jpg" class="galleryimg" width="290" height="350" />
				<img src="data/img/img4.jpg" class="galleryimg" width="290" height="350" />
				<img src="data/img/img5.jpg" class="galleryimg" width="290" height="350" />
				<img src="data/img/img6.jpg" class="galleryimg" width="290" height="350" />
				<img src="data/img/img7.jpg" class="galleryimg" width="290" height="350" />
				<img src="data/img/img8.jpg" class="galleryimg" width="290" height="350" />
			</center>
		</div><br>
	</div>
</body>
</html>