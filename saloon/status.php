<?php
	$id = $_GET['id'];
	$op = $_GET['op'];
	require_once "data/php/db/config.php";
	$cond = "UPDATE `booking` SET `Status` = 'Complete' WHERE `bookid` = '$id'";
	$chck = mysqli_query($link, $cond);
	if ($chck) {
		header("location:booking.php");
	}
?>