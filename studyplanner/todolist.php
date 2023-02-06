<?php
include("config.php");
session_start();
if (!isset($_SESSION['username'])) {
	header('Location: index.php');
	die();
}
$user = $_SESSION['username'];
//connecting to db 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $wrk       	= $_POST['work'];
    $todt      	= $_POST['date'];
    $tdetailes 	= $_POST['tDetails'];
    
    
    if ($wrk == "" || $todt == "" || $tdetailes == "") {
        echo "<script>alert('All fields should be filled. Either one or many fields are empty.')</script>";
    } else {
        $sql = "INSERT INTO `todo` (`id`, `name`, `reminder`, `details`, `user`) VALUES (NULL, '$wrk', '$todt', '$tdetailes', '$user')";
        mysqli_query($conn, $sql) or die("Could not execute the insert query.");
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
                            <legend>ADD Todo</legend>
                            <table>
                            <tr>
                            <td>Work    TODO:</td>
                            <td><input name="work" type="text"/></td>
                            </tr>
                            <tr>
                            <td>Last    Date:</td>
                            <td><input name="date" type="date"/></td>
                            </tr>
                            <tr>
                            <td>Details:</td>
                            <td><input name="tDetails" type="text"/></td>
                            </tr>
                            </table><hr>
                            <input type="submit"    value="ADD">
                        </fieldset>
                        <br>
                    </form>

                    <fieldset>
                        <legend>LIST</legend>
                        <?php
						$sql = "SELECT `id`, `name`, `reminder`, `details` FROM `todo` WHERE `user` = '$user'";
						$result = mysqli_query($conn, $sql) or die("Could not fetch todos");

						if ($result->num_rows > 0) {
						    echo '<ul>';
						    while ($row = $result->fetch_assoc()) {
						        echo '<br><li>' . $row['name'] . ' @ ' . $row['reminder'] . ' - ' . $row['details'] . ' <button onclick="deleteTodo(' . $row['id'] . ')">✖</button></li>';
						    }
						    echo '</ul>';
						}
						?>
                   </fieldset>
                </td>
            </tr>
            
        </table>

        <script type="text/javascript">
            function deleteTodo(id) {
                window.location = 'delete_todo.php?id=' + id;
            }
        </script>
    </body>
</html>