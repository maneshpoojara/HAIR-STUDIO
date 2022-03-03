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
		.messages{
			width: 80%;
			border: 2px solid #009688;
			padding: 10px;
			margin-bottom: 5px;
			border-radius: 0.5cm;
		}
		.reply{
			width: 150px;
			background: #009688;
			border: 3px solid #009688;
			padding: 10px;
			border-radius: .5cm;
			cursor: pointer;
			transition: 0.5s;
		}
		.reply:hover{
			background: transparent;
		}
		.content{
			overflow-y: scroll;
			width: 100%;
			height: 80vh;
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
				<li class="active"><a href="#">Messages</a></li>
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
			<center>
			<?php
				require_once "../db/config.php";
				$cond = "SELECT * FROM `message`";
				$chck = mysqli_query($link, $cond);
				if ($chck) {
					if (mysqli_num_rows($chck)>0) {
						while ($data = mysqli_fetch_array($chck)) {
							$message = $data['Message'];
							$id = $data['userId'];
							$cond = "SELECT * FROM `user` WHERE `userId` = '$id'";
							$cmd = mysqli_query($link, $cond);
							$res = mysqli_fetch_array($cmd);
							$mail = $res['Mail'];
							echo '<div class="messages">'.$message;
							echo '<br><br>';
							echo '<button class="reply"><a style="text-decoration: none;" href="mailto:'.$mail.'">Reply Now</a></button>';
							echo "</div>";
						}
					}
				}
			?>
			</center>
		</div>
	</div>
</body>
</html>