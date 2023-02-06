<?php
session_start();
if (!isset($_SESSION['username'])) {
	header('Location: index.php');
	die();
}
?> 

<html>
    <?php include 'head.php'; ?>
	<body>
		<table border="0" height="70%" width="80%" cellpadding="20" align="center">
			<tr>
				<?php include 'menu.php'; ?>
			</tr>
			<tr height="200%">
				<td colspan="7">

					<form method="POST">
						<h3>Courses</h2>
						<br>
						<input type="text" name="foldername" id="foldername" placeholder="New Folder name..."></input>
					 	<input type="submit" name="createfolder" value="Create">
						<?php
							chdir('Courses');
							$curdir = getcwd();
							if ($_SERVER['REQUEST_METHOD'] === 'POST') {
								$fname = $_POST["foldername"];	
								$fname=  $_REQUEST["foldername"];
							 	mkdir($fname, 0777);
							}
						?>
					 	</input>		
					</form>
					<br><br>
					<?php	
						$path = getcwd();
						$dir = opendir($path) or die ("<script>alert('Could not read course list.')</script>");
						while($file = readdir($dir))
						{
							if($file != "." && $file != "..")
								echo "
								<form method='post' action='upload.php' enctype='multipart/form-data'>
								<a href='Courses/$file'>$file</a>
								/ Upload file:
								<input style='display: inline-block;' type='file' name='fileToUpload'>
								<input type='hidden' name='folder' value='$file'>
								<input type='submit' name='submit' value='Upload file'>
								</form>
								";
						}
					?>
				</td>
			</tr>
			<tr height="10%">
				<td align="center" colspan="7">
					Copyright &copy; <?php echo date('Y'); ?>
				</td>
			</tr>
		</table>
	</body>
</html>
