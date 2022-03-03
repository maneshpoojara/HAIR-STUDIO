<?php
	session_start();
	if(!$_SESSION['loggedin'] === true){
		header("location: ../../../login.php");
	}
	$msg = "";
	if(isset($_POST['signup'])){
		$name = $_POST['name'];
		$mail = $_POST['mail'];
		$mob = $_POST['mob'];
		$pwd = $_POST['pwd'];
		$role = $_POST['role'];
		require_once "../db/config.php";
		$cond = "SELECT * FROM `user` WHERE `Mail` = '$mail'";
		$chck = mysqli_query($link, $cond);
		if($chck){
			if(mysqli_num_rows($chck)>0){
				$msg = "Account Already Exists with this Mail ID!";
			}
			else{
				$pwdhash = password_hash($pwd, PASSWORD_DEFAULT);
				$query = "INSERT INTO `user`(`Name`, `Mail`, `Mobile`, `Acctype`, `Password`) VALUES ('$name','$mail','$mob','Stylist','$pwdhash')";
				$result = mysqli_query($link, $query);
				if($result){
					$msg = "Account Created Successfully";
					$cond = "SELECT * FROM `user` WHERE `Mail` = '$mail'";
					$chck = mysqli_query($link, $cond);
					$data = mysqli_fetch_array($chck);
					$id = $data['userId'];
					$query = "INSERT INTO `artist`(`userId`, `Role`) VALUES ('$id','$role')";
					$result = mysqli_query($link, $query);
					if($result){
						header("location:manage.php");
					}
				}
				else{
					$msg = "Account not Created";
				}
			}
		}
		mysqli_close($link);
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
			<form action="" method="POST">
				<h1>Add Stylist</h1>
				<input class="txtbox" placeholder="Enter Name" type="text" name="name" required /><br>
				<input class="txtbox" placeholder="Enter Mail ID" type="text" name="mail" required /><br>
				<input class="txtbox" placeholder="Enter Mobile Number" type="text" name="mob" required /><br>
				<input class="txtbox" placeholder="Enter Role" type="text" name="role" required /><br>
				<input class="txtbox" placeholder="Enter Password" type="password" name="pwd" required /><br>
				<span style="color:red;"><?php echo $msg; ?></span><br>
				<input type="submit" name="signup" class="btn" value="Add Stylist">
			</form>
		</div>
	</div>
</body>
</html>