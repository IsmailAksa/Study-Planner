<?php
	session_start();
	if (!isset($_SESSION['username'])) {
		header('Location: index.php');
		die();
	}
	$user = $_SESSION['username'];
	include ('config.php');
	
	$scheduleid = $_GET['id'];
	$sql = "DELETE FROM `schedule` WHERE `schedule`.`id` = '$scheduleid' AND `schedule`.`user` = '$user'";
	$result = mysqli_query($conn, $sql) or die("<script>alert('Could not delete schedule.')</script>");

	header('location: class_schedule.php');
?>