<?php
	session_start();
	if (!isset($_SESSION['username'])) {
		header('Location: index.php');
		die();
	}
	$user = $_SESSION['username'];
	include ('config.php');
	
	$assignmentid = $_GET['id'];
	$sql = "DELETE FROM `assignment` WHERE `assignment`.`id` = '$assignmentid' AND `assignment`.`user` = '$user'";
	$result = mysqli_query($conn, $sql) or die("<script>alert('Could not delete assignment.')</script>");

	header('location: assignments.php');
?>