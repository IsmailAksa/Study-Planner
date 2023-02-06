<!DOCTYPE html>
<html>
	<?php include 'head.php'; ?>
	<meta http-equiv="refresh" content="3; url=Courses.php">

<body>
	<table border="0" height="70%" width="80%" cellpadding="20" align="center">
		<tr>
			<?php include 'menu.php'; ?>
		</tr>
		<tr height="200%">
			<td colspan="7">
				<?php
					session_start();
					if (!isset($_SESSION['username'])) {
						header('Location: index.php');
						die();
					}

					if (!isset($_POST["folder"])) {
					    echo "<p style='color: red; font-weight: bold;''>Error: could not upload file.</p>";
					} else {
						$folder_name = $_POST["folder"];
						$target_dir = "Courses/$folder_name/";
						$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

						// if (file_exists($target_file)) {
						//     echo "<script>alert('Error: file already exists.')</script>";
						//     die();
						// }

						if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
							echo "<p style='color: green; font-weight: bold;''>The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.</p>";
						} else {
						    echo "<p style='color: red; font-weight: bold;''>Error: could not upload file.</p>";
						}
					}
				?>
				<br>
				Redirecting...
				or <a href="Courses.php">click here</a>
			</td>
		</tr>
	</table>
</body>
</html>
