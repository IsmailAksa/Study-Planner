<?php
	session_start();
	if (isset($_SESSION['username'])) {
		header('Location: index.php');
  		die();
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		include("Login_Handler.php");
		
		if(form_validation())
		{
			header("location: index.php");
		}
	}
?>

<html>
    <?php include 'head.php'; ?>
	<body>
			<table height="70%" width="80%" cellpadding="20" align="center">
				<tr>
					<td style="background: #efefef;"><a class="nav-link" href="index.php"/>Study planner</a></td>
					<td style="background: #efefef;"><a class="nav-link" href="Registration.php"/>Registration </a></td>
				</tr>
				<tr height="200%">
					<td colspan="2">
						<form method="POST">
							<fieldset>
								<legend>LOGIN</legend>
								Username: <input name="username" type="text"/><br>
								<br>
								Password: &nbsp;<input name="password" type="password"/><hr>
								<!-- <input name="remember_me" type="checkbox"> Remember Me<br><br> -->
								<input type="submit">
								<!-- <a href="Forgot Password.php">Forgot Password?</a> -->
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
