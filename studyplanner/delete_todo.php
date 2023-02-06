<?php
	session_start();
	if ($_SESSION['username'] == NULL) {
		header('Location: index.php');
		die();
	}
	$user = $_SESSION['username'];
	include ('config.php');
	
	$todoid = $_GET['id'];
	$sql = "DELETE FROM `todo` WHERE `todo`.`id` = '$todoid' AND `todo`.`user` = '$user'";
	$result = mysqli_query($conn, $sql) or die("Could not delete todo");

	header('location: todolist.php');
?>