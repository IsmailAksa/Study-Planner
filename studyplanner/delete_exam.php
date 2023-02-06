<?php
	session_start();
	if (!isset($_SESSION['username'])) {
		header('Location: index.php');
		die();
	}
	$user = $_SESSION['username'];
	include ('config.php');
	
	$examid = $_GET['id'];
	$sql = "DELETE FROM `exams` WHERE `exams`.`id` = '$examid' AND `exams`.`user` = '$user'";
	$result = mysqli_query($conn, $sql) or die("<script>alert('Could not delete exam.')</script>");

	header('location: exams.php');
?>