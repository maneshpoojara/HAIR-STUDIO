<?php
	session_start();
	if(!$_SESSION['loggedin'] === true){
		header("location: ../../../login.php");
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
		}::-webkit-scrollbar {
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
		.banner{
			width: 100%;
			height: 100vh;
			background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url(../../img/bg.jpg);
			background-size: cover;
			background-position: center;
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
			position: absolute;
			top: 50%;
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
		.edit{
			width: 150px;
			background: transparent;
			border: 3px solid #009688;
			padding: 10px;
			border-radius: .5cm;
			cursor: pointer;
			transition: 0.5s;
		}
		.edit:hover{
			background: #009688;
		}
	</style>
</head>
<body>
	<div class="banner">
		<div class="navbar">
			<b class="logo">Hair Studio</b>
			<ul>
				<li class="active"><a href="#">Home</a></li>
				<li><a href="manage.php">Employee</a></li>
				<li><a href="message.php">Messages</a></li>
				<?php
					if ($_SESSION['loggedin'] === true) {
						echo '<li><a href="../../../logout.php">Logout</a></li>';
					}
					else{
						echo '<li><a href="login.php">Login</a></li>';
					}
				?>
			</ul>
		</div>
		<div class="content">
			<h1>Welcome <?php echo $_SESSION['name']; ?></h1>
			<p>To the world's classy Hair Saloon.</p>
			<div>
				<button class="edit"><a style="text-decoration: none;" href="update.php">Edit Profile</a></button>
			</div>
		</div>
	</div>
</body>
</html>