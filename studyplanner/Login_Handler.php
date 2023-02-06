<?php
	include 'config.php';
	$flag; // determine whether user or admin
	
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$username = $_POST['username']; //also email
		$password = $_POST['password'];
	}
	
	function form_validation() //all
	{
		global $conn;
		global $username;
		global $password;
		
		if($username == "" || $password == "")
		{
			echo '<script language="javascript">';
			echo 'alert("Fields cannot be empty !!")';
			echo '</script>';
			return false;
		}

		//user id
		$sql_username = "SELECT username FROM users WHERE username='$username' AND password='$password'";

		$data = mysqli_query($conn,$sql_username);
		$row = mysqli_fetch_array($data);

		// if no users are present, show alert
		if ($row === NULL) {
			echo '<script language="javascript">';
			echo 'alert("Invalid username or password!");';
			echo '</script>';
		} else {
			date_default_timezone_set('Asia/Dhaka');
			$current_time = date("Y-m-d H:i:s");
			
			if($row !== NULL and count($row) == 2)
			{	
				session_start();
				$username = $row[0];
				
				$last_logged_in = "UPDATE users SET last_log_in = '$current_time' WHERE users.username = '$username'";
				mysqli_query($conn,$last_logged_in); //inserting last login time
				
				$_SESSION['username'] = $username;
			}
			
			global $flag;
			$flag = "user";
			$_SESSION['usertype'] = "user";

			return true;
		}
	}
?>