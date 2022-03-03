<?php
	session_start();
	if(!$_SESSION['loggedin'] === true){
		header("location: login.php");
	}
	if (isset($_POST['book'])) {
		$user = $_POST['id'];
		$art = $_POST['artid'];
		$date = $_POST['dat'];
		$status = "Pending";
		$available = true;
		require_once "data/php/db/config.php";
		$sql = "SELECT * FROM `booking` WHERE `ArtistId` = '$art'";
		$res = mysqli_query($link, $sql);
		while($data = mysqli_fetch_array($res)){
			$dbdate = $data['Appdate'];
			$hourdiff = round((strtotime($date) - strtotime($dbdate))/3600, 1);
			if ($hourdiff < 1 and $hourdiff >-1) {
				$available = false;
			}
		}
		if ($available) {
			$sql = "INSERT INTO `booking`(`userId`, `ArtistId`, `Appdate`, `Status`) VALUES ('$user','$art','$date','$status')";
			$chck = mysqli_query($link, $sql);
		}
		/**/
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Saloon</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
			background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url(data/img/bg.jpg);
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
		.txtbox{
			width: 400px;
			background: transparent;
			border: 3px solid #009688;
			margin: 10px;
			padding: 10px;
			border-radius: .5cm;
		}
	</style>
</head>
<body>
	<div class="banner">
		<div class="navbar">
			<b class="logo">Hair Studio</b>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li class="active"><a href="#">Book Appointment</a></li>
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
			<button class="add"><a style="text-decoration:none;" href="booking.php">My Bookings</a></button>
			<?php
				require_once "data/php/db/config.php";
				$cond = "SELECT * FROM `artist`";
				$chck = mysqli_query($link, $cond);
				if ($chck) {
					if (mysqli_num_rows($chck)>0) {
						while ($data = mysqli_fetch_array($chck)) {
							$id = $data['userId'];
							$cond = "SELECT * FROM `user` WHERE `userId` = '$id'";
							$cmd = mysqli_query($link, $cond);
							$res = mysqli_fetch_array($cmd);
							$name = $res['Name'];
							$mail = $res['Mail'];
							$role = $data['Role'];
							$mob = $res['Mobile'];
							$usr = $_SESSION['id'];
							echo '<div class="container"><h2>'.$name.'</h2>';
							echo '<i style="font-size:13px;">'.$role.'</i>';
							echo '<br><br>';
							echo '<form action="" method="POST">';
							echo '<input type"text" value="'.$usr.'" name="id" style="display:none;"/>';
							echo '<input type"text" value="'.$id.'" name="artid" style="display:none;"/>';
							echo '<input type="datetime-local" name="dat" class="txtbox" id="txtDate" />';
							echo '<input type="submit" name="book" class="book" value="Book Now"/></form>';
							echo "</div>";
						}
					}
				}
			?>
		</div>
	</div>
	<script type="text/javascript">
		<?php
			if (isset($_POST['book'])) {
				if (!$available) {
					echo 'swal("Artist Not Available", "Plesae try some other date or time", "warning", {
  button: "Close",
});';
				}else{
					$sql = "SELECT * FROM `user` WHERE `userId` = '$art'";
					$res = mysqli_query($link, $sql);
					$data = mysqli_fetch_array($res);
					$artname = $data['Name'];
					echo 'swal("Appointment Booked", "to our Artist '.$artname.' on '.$date.'", "success", {
  button: "Yeahh!",
});';
					
				}
			}
		?>
		$(function(){
			var dtToday = new Date();
			var month = dtToday.getMonth() + 1;
			var day = dtToday.getDate();
			var year = dtToday.getFullYear();
			let hour = dtToday.getHours();
			let min = dtToday.getMinutes();
			if(month < 10)
				month = '0' + month.toString();
			if(day < 10)
				day = '0' + day.toString();
    	if(hour <10)
    		hour = '0' + hour.toString();
    	if(min <10)
    		min = '0' + min.toString();
			var maxDate = year + '-' + month + '-' + day + 'T' + hour + ':' + min;
			console.log(maxDate);
			// or instead:
			// var maxDate = dtToday.toISOString().substr(0, 10);

			$('#txtDate').attr('min', maxDate);
			$('#txtDate').attr('value', maxDate);
		});
	</script>
</body>
</html>