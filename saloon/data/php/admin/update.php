<?php
	session_start();
	if(!$_SESSION['loggedin'] === true){
		header("location: ../../../login.php");
	}
	
	if(isset($_POST['update'])){
		$name = $_POST['name'];
		$mail = $_POST['mail'];
		$mob = $_POST['mob'];
		$id = $_SESSION['id'];
		require_once "../db/config.php";
		$cond = "UPDATE `user` SET `Name`='$name',`Mail`='$mail',`Mobile`='$mob' WHERE `userId` = '$id'";
		$chck = mysqli_query($link, $cond);
		if($chck){
			$msg = "Account Updated Successfully";
			$cond = "SELECT * FROM `user` WHERE `userId` = '$id'";
			$chck = mysqli_query($link, $cond);
			$data = mysqli_fetch_array($chck);
			$_SESSION['name'] = $data['Name'];
			$_SESSION['mail'] = $data['Mail'];
			$_SESSION['mob'] = $data['Mobile'];
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
				<li><a href="Manage.php">Employee</a></li>
				<li><a href="Message.php">Messages</a></li>
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
				<h1>Update Profile</h1>
				<input class="txtbox" placeholder="Enter your Name" type="text" value="<?php echo $_SESSION['name'] ?>" name="name"/><br>
				<input class="txtbox" placeholder="Enter your Mail ID" type="text" value="<?php echo $_SESSION['mail'] ?>" name="mail"/><br>
				<input class="txtbox" placeholder="Enter your Mobile Number" type="text" value="<?php echo $_SESSION['mob'] ?>" name="mob"/><br>
				<span style="color:red;"><?php echo $msg; ?></span><br>
				<input type="submit" name="update" class="btn" value="Update">
			</form>
		</div>
	</div>
</body>
</html>