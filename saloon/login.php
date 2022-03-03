<?php
	session_start();
	if($_SESSION['loggedin'] === true){
		header("location: index.php");
	}
	$msg = "";
	if(isset($_POST['login'])){
		$mail = $_POST['mail'];
		$pwd = $_POST['pwd'];
		require_once "data/php/db/config.php";
		$cond = "SELECT * FROM `user` WHERE `Mail` = '$mail'";
		$chck = mysqli_query($link, $cond);
		if($chck){
			if(mysqli_num_rows($chck)>0){
				$data = mysqli_fetch_array($chck);
				$hashed_password = $data['Password'];
				if(password_verify($pwd, $hashed_password)){
					session_start();
					$_SESSION['name'] = $data['Name'];
					$_SESSION['mail'] = $data['Mail'];
					$_SESSION['mob'] = $data['Mobile'];
					$_SESSION['Acctype'] = $data['Acctype'];
					$_SESSION['id'] = $data['userId'];
					$_SESSION['loggedin'] = true;
					header("location: index.php");
					if ($data['Acctype'] === "Admin") {
						header("location: data/php/admin");
					}elseif ($data['Acctype'] === "Stylist") {
						header("location: data/php/stylist");
					}else{
						header("location: index.php");
					}
				}
				else{
					$msg = "Wrong Password!";
				}
			}
			else{
				$msg = "No Account is Linked with this Mail ID!";
			}
		}
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
		.btn{
			width: 150px;
			background: transparent;
			border: 3px solid #009688;
			padding: 10px;
			border-radius: .5cm;
			cursor: pointer;
			transition: 0.5s;
		}
		.txtbox{
			width: 400px;
			background: transparent;
			border: 3px solid #009688;
			margin: 10px;
			padding: 10px;
			border-radius: .5cm;
		}
		.btn:hover{
			background: #009688;
		}
		.content p{
			margin: 10px;
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
				<li class="active"><a href="#">Login</a></li>
			</ul>
		</div>
		<div class="content">
			<form action="" method="POST">
				<h1>Login</h1>
				<input class="txtbox" placeholder="Enter your Username" type="text" name="mail"/><br>
				<input class="txtbox" placeholder="Enter your Password" type="password" name="pwd"/><br>
				<span style="color:red;"><?php echo $msg; ?></span><br>
				<input type="submit" name="login" class="btn" value="Login">
			</form>
			<p>Don't Have an Account? <a href="register.php" style="color: blue;text-decoration: none;">Create one</a></p>
		</div>
	</div>
</body>
</html>