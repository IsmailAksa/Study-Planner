<?php
include("config.php");
session_start();
if (!isset($_SESSION['username'])) {
	header('Location: index.php');
	die();
}
$user = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $work	     	 	= $_POST['work'];
    $aCourse      		= $_POST['aCourse'];
    $date 	    	 	= $_POST['date'];
    
    if ( empty($work) || empty($aCourse) || empty($date) ) {
        echo "<script>alert('All fields should be filled. Either one or many fields are empty.')</script>";
    } else {
        $sql = "INSERT INTO `assignment` (`id`, `name`, `course`, `deadline`, `user`) VALUES (NULL, '$work', '$aCourse', '$date', '$user')";
        mysqli_query($conn, $sql) or die("<script>alert('Could not execute the insert query.')</script>");
    }
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
						<fieldset>
							<legend>ASSIGNMENT</legend>
							<table>
							<tr>
							<td>Assignment	name:</td>
							<td><input name="work" type="text"/></td>
							</tr>
							<tr>
							<td>Course:</td>
							<td><input name="aCourse" type="type"/></td>
							</tr>
							<tr>
							<td>Last	Date:</td>
							<td><input name="date" type="date"/></td>
							</tr>
							</table><hr>
							<input type="submit"	value="ADD">
						</fieldset>
						<br>
					</form>
					<fieldset>
					<legend>Assignment	LIST</legend>
					<?php
					$sql = "SELECT `id`, `name`, `course`, `course`, `deadline`, `user` FROM `assignment` WHERE `user` = '$user'";
					$result = mysqli_query($conn, $sql) or die("<script>alert('Could not fetch todos.')</script>");

					if ($result->num_rows > 0) {
					    echo '<ul>';
					    while ($row = $result->fetch_assoc()) {
					        echo '<br><li><strong>' . $row['name'] . '</strong> <em>(' . $row['course'] . ')</em> @ ' . $row['deadline'] . ' <button onclick="deleteAssignment(' . $row['id'] . ')">✖</button></li>';
					    }
					    echo '</ul>';
					}
					?>
					</fieldset>	
				</td>
			</tr>
		</table>

		<script type="text/javascript">
            function deleteAssignment(id) {
                window.location = 'delete_assignment.php?id=' + id;
            }
        </script>
	</body>
</html>
