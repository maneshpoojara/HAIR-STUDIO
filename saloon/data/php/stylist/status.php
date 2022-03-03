<?php
	$id = $_GET['id'];
	$op = $_GET['op'];
	require_once "../db/config.php";
	if ($op === "approve") {
		$cond = "UPDATE `booking` SET `Status` = 'Approved' WHERE `bookid` = '$id'";
		$chck = mysqli_query($link, $cond);
		if ($chck) {
			header("location:approve.php");
		}
	}
	else{
		$cond = "UPDATE `booking` SET `Status` = 'Rejected' WHERE `bookid` = '$id'";
		$chck = mysqli_query($link, $cond);
		if ($chck) {
			header("location:reject.php");
		}
	}
?>