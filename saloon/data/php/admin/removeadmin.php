<?php
	$id = $_GET['id'];
	require_once "../db/config.php";
	$cond = "DELETE FROM `user` WHERE `userId` = '$id'";
	$chck = mysqli_query($link, $cond);
	if ($chck) {
		header("location:admins.php");
	}
?>