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
		.container{
			width: 90%;
			height: 135px;
			border: 2px solid #009688;
			padding: 10px;
			margin-left: 30px;
			margin-bottom: 5px;
			border-radius: 0.5cm;
		}
		.add{
			width: 150px;
			background: #009688;
			border: 3px solid #009688;
			padding: 10px;
			border-radius: .5cm;
			cursor: pointer;
			transition: 0.5s;
			margin: 10px;
		}
		.add:hover{
			background: transparent;
		}
		.book{
			width: 150px;
			background: #00a2ff;
			border: 3px solid #00a2ff;
			padding: 10px;
			border-radius: .5cm;
			cursor: pointer;
			transition: 0.5s;
			margin: 10px;
		}
		.book:hover{
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
			<?php
				require_once "data/php/db/config.php";
				$id = $_SESSION['id'];
				$cond = "SELECT * FROM `booking` WHERE `userId` = '$id' ORDER BY `bookid` DESC";
				$chck = mysqli_query($link, $cond);
				if ($chck) {
					if (mysqli_num_rows($chck)>0) {
						while ($data = mysqli_fetch_array($chck)) {
							$artid = $data['ArtistId'];
							$bookid = $data['bookid'];
							$status = $data['Status'];
							$appdate = $data['Appdate'];
							$cond = "SELECT * FROM `user` WHERE `userId` = '$artid'";
							$cmd = mysqli_query($link, $cond);
							$res = mysqli_fetch_array($cmd);
							$cond = "SELECT * FROM `artist` WHERE `userId` = '$artid'";
							$cmd = mysqli_query($link, $cond);
							$art = mysqli_fetch_array($cmd);
							$name = $res['Name'];
							$mail = $res['Mail'];
							$role = $art['Role'];
							$mob = $res['Mobile'];
							echo '<div class="container"><h2>'.$name.'</h2>';
							echo '<i style="font-size:13px;">'.$role.'</i>';
							echo '<br><br>';
							if ($status === "Approved") {
								echo 'Mail ID : '.$mail;
								echo "<br>";
								echo 'Mobile : '.$mob;
								echo "<br>";
								echo '<button style="color:#fff;background:green;border:none;padding:10px;float:right;cursor:pointer;" onclick="pay('.$bookid.')">Complete Booking</button>';
							}
							echo 'Appointment Date(YYYY-MM-DD) : '.$appdate;
							echo "<br>";
							echo "Status : ".$status;
							echo "</div>";
						}
					}
				}
			?>
		</div>
		<script type="text/javascript">
			function pay(bid){
				if (window.confirm("Payment Confirmation")){
					location.replace("status.php?id="+bid);
				}
			}
		</script>
	</div>
</body>
</html>