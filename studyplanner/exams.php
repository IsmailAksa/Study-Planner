<?php
include("config.php");
session_start();
if (!isset($_SESSION['username'])) {
	header('Location: index.php');
	die();
}
$user = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $course     	 	= $_POST['course'];
    $instructor      	= $_POST['instructor'];
    $syllabus     	 	= $_POST['syllabus'];
    $date 	    	 	= $_POST['date'];
    $time 	    	 	= $_POST['time'];
    
    if ( empty($course) || empty($instructor) || empty($syllabus) || empty($date) || empty($time) ) {
        echo "<script>alert('All fields should be filled. Either one or many fields are empty.')</script>";
    } else {
        $sql = "INSERT INTO `exams` (`id`, `course`, `instructor`, `syllabus`, `date`, `time`, `user`) VALUES (NULL, '$course', '$instructor', '$syllabus', '$date', '$time', '$user')";
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
								<legend>Exam</legend>
								<table>
								<tr>
								<td>Course	Name:</td>
								<td><input name="course" type="text"/></td>
								</tr>
								<tr>
								<td>Course	Instructor:</td>
								<td><input name="instructor" type="text"/></td>
								</tr>
								<tr>
								<td>Syllabus:</td>
								<td><input name="syllabus" type="text"/></td>
								</tr>
								<tr>
								<td>Exam	Date:</td>
								<td><input name="date" type="date"/></td>
								</tr>
								<tr>
								<td>Exam	Time:</td>
								<td><input name="time" type="time"/></td>
								</tr>
								</table><hr>
								<input type="submit" value="ADD">
							</fieldset>
							<br>
						</form>
						<fieldset>
						<legend>Exam LIST</legend>
	                        <?php
							$sql = "SELECT `id`, `course`, `instructor`, `syllabus`, `date`, `time`, `user` FROM `exams` WHERE `user` = '$user'";
							$result = mysqli_query($conn, $sql) or die("<script>alert('Could not fetch todos.')</script>");

							if ($result->num_rows > 0) {
							    echo '<ul>';
							    while ($row = $result->fetch_assoc()) {
							        echo '<br><li><strong>' . $row['course'] . '</strong> (' . $row['instructor'] . ') - <em>' . $row['syllabus'] . '</em> @ ' . $row['date'] . ' ' . $row['time'] . ' <button onclick="deleteExam(' . $row['id'] . ')">✖</button></li>';
							    }
							    echo '</ul>';
							}
							?>
						</fieldset>
					</td>
				</tr>
				
			</table>

		<script type="text/javascript">
            function deleteExam(id) {
                window.location = 'delete_exam.php?id=' + id;
            }
        </script>
	</body>
</html>