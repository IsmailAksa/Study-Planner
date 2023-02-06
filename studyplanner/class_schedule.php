<?php
include("config.php");
session_start();
if (!isset($_SESSION['username'])) {
	header('Location: index.php');
	die();
}
$user = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name 	    	 	= $_POST['name'];
    $start_time      	= $_POST['start_time'];
    $end_time     	 	= $_POST['end_time'];
    $day_of_week 	    	 	= $_POST['day_of_week'];
  
    
    if ( empty($name) || empty($start_time) || empty($end_time) || empty($day_of_week) ) {
        echo "<script>alert('All fields should be filled. Either one or many fields are empty.')</script>";
    } else {
        $sql = "INSERT INTO `schedule` (`id`, `name`, `start_time`, `end_time`, `day_of_week`, `user`) VALUES (NULL, '$name', '$start_time', '$end_time', '$day_of_week','$user')";
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
								<legend>Schedule</legend>
								<table>
								<tr>
								<td>Course	Name:</td>
								<td><input name="name" type="text"/></td>
								</tr>
								<tr>
								<td>Start	Time:</td>
								<td><input name="start_time" type="time"/></td>
								<tr>
								<td>End	Time:</td>
								<td><input name="end_time" type="time"/></td>
								</tr>
								<tr>
								<td>Day of week:</td>
								<td><input name="day_of_week" type="text"/></td>
								</tr>
								</table><hr>
								<input type="submit" value="ADD">
							</fieldset>
							<br>
						</form>
						<fieldset>
						<legend>Schedule list</legend>
	                        <?php
							$sql = "SELECT `id`, `name`, `start_time`, `end_time`, `day_of_week`, `user` FROM `schedule` WHERE `user` = '$user'";
							$result = mysqli_query($conn, $sql) or die("<script>alert('Could not fetch schedule.')</script>");

							if ($result->num_rows > 0) {
							    echo '<ul>';
							    while ($row = $result->fetch_assoc()) {
							        echo '<br><li><strong>' . $row['name'] . '</strong> (' . $row['start_time'] . ') - <em>' . $row['end_time'] . '</em> @ ' . $row['day_of_week'] . ' <button onclick="deleteSchedule(' . $row['id'] . ')">X</button></li>';
							    }
							    echo '</ul>';
							}
							?>
						</fieldset>
					</td>
				</tr>
				
			</table>

		<script type="text/javascript">
            function deleteSchedule(id) {
                window.location = 'delete_schedule.php?id=' + id;
            }
        </script>
	</body>
</html>