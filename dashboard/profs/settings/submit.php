<?php
require('../../../class/Student.php');
$student = new Student();
session_start();
$ID = $_SESSION['enroll_no'];
$sql = "SELECT email_id FROM P2_Instructor WHERE ID='$ID'";
$result = $student->fetch_query($sql);
$login = $result['email_id'];
$password = $_POST['password'];
$hash = password_hash($password, PASSWORD_BCRYPT);
if(isset($_POST['password'])){
  $login = "UPDATE P2_Login SET `hash` = '$hash' WHERE login_id = '$login'";
  $result = $student->run_query($login);
echo "Password Updated";
}
?>
