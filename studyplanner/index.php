<?php
	session_start();
	$notlogged = false;
	if (!isset($_SESSION['username'])) {
		$notlogged = true;
	} else {
		include('config.php');

		$user = $_SESSION['username'];
		$sql = "SELECT COUNT(*) FROM todo WHERE user = '$user'";
		$data = mysqli_query($conn, $sql)
					or die("Could not execute the insert query.");
		$taskcount = mysqli_fetch_array($data)[0];
	}
?>

<html>
    <?php include 'head.php'; ?>
	<body>
		<table border="0" height="70%" width="80%" cellpadding="20" align="center">
			<tr>
				<?php
				if ($notlogged) {
						echo '
						<td style="background: #efefef;"><a class="nav-link" href="Login.php"/>Login</a></td>
						<td style="background: #efefef;"><a class="nav-link" href="Registration.php"/>Registration</a></td>
						';
					} else {
						include 'menu.php';
					}
				?>
			</tr>
			<tr height="200%">
				<td colspan="<?= $notlogged ? 2 : 6; ?>">
					<h1>Study planner</h1>
					<h3>Welcome to study planner!</h3>

					<?php
					if (!$notlogged) {
						echo "Hello $user! You have $taskcount todos.";
					}
					?>
				</td>
			</tr>
			
		</table>
	</body>
</html>
