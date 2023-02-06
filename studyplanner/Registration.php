<?php
	session_start();
	if (isset($_SESSION['username'])) {
		header('Location: index.php');
  		die();
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		include("Registration_Handler.php");
		
		if(validation())
		{	
			echo '<script language="javascript"> alert("Registration completed successfully");
			window.location = "Login.php";
			</script>';
		}
	}
?>

<html>
    <?php include 'head.php'; ?>
	<body>
		<table border="0" height="70%" width="80%" cellpadding="20" align="center">
			<tr>
				<td style="background: #efefef;"><a class="nav-link" href="index.php"/>Study planner</a></td>
				<td style="background: #efefef;"><a class="nav-link" href="Login.php"/>Login</a></td>
			</tr>
			<tr height="200%">
				<td colspan="2">
						<form method="POST">
							<fieldset>
								<legend>REGISTRATION</legend>
								<br>Name &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
								:<input id="name" name="name" type="text"/><hr>
								Email &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
								:<input id="email" name="email" type="text"/><hr>
								User Name&emsp;&emsp;&emsp;&emsp;&ensp;&ensp;
								:<input id="username" name="username" type="text"/><hr>
								Password &emsp;&emsp;&emsp;&emsp;&emsp;&ensp;
								:<input id="password" name="password" type="password"/><hr>
								Confirm Password &emsp;&emsp;
								:<input id="confirm_password" name="confirm_password" type="password"/><hr>
								
								<fieldset>
									<legend>Gender</legend>
									<input id="male" name="gender" type="radio" value="m"/>Male
									<input id="female" name="gender" type="radio" value="f"/>Female
									<input id="other" name="gender" type="radio" value="o"/>Other
								</fieldset>
								<hr>
								<fieldset>
									<legend>Date of Birth</legend>
									<input id="day" name="day" type="text"/>/
									<input id="month" name="month" type="text"/>/
									<input id="year" name="year" type="text"/> (dd/mm/yyyy)
								</fieldset>
								<hr>
								
								<input type="submit"/> <input type="reset"/>
								
							</fieldset>
							
					</form>
				</td>
			</tr>
			<tr height="10%">
				<td align="center" colspan="2">
					Copyright &copy; <?php echo date('Y'); ?>
				</td>
			</tr>
		</table>
	</body>
</html>

<script>
	var msg = "<?php echo $message; ?>";
	var gender = "<?php echo $gender; ?>";
	
	if(msg != "")
	{
		document.getElementById('name').value = "<?= $_POST['name']; ?>";
		document.getElementById('email').value = "<?= $_POST['email']; ?>";
		document.getElementById('username').value = "<?= $_POST['username']; ?>";
		
		if(gender == "Male")
		{
			document.getElementById('male').checked = true;
		}
		else if(gender == "Female")
		{
			document.getElementById('female').checked = true;
		}
		else if(gender == "Others")
		{
			document.getElementById('other').checked = true;
		}
		
		document.getElementById('day').value = "<?= $_POST['day']; ?>";
		document.getElementById('month').value = "<?= $_POST['month']; ?>";
		document.getElementById('year').value = "<?= $_POST['year']; ?>";
	}
</script>