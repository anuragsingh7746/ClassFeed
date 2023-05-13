<?php
require('../../class/Student.php');
$student = new Student();
session_start();
$password = $_POST['password'];
$email = $_SESSION['email'];
$username = substr($email, 0, 10);
$hash = password_hash($password, PASSWORD_BCRYPT);
if(isset($_SESSION['email'])){
  $login = "UPDATE P2_Login SET `hash` = '$hash' WHERE login_id = '$email' OR login_id =  '$username'";
  $result = $student->run_query($login);
  $delete = "DELETE FROM P2_Verification where email = '$email'";
  $result = $student->run_query($delete);
session_destroy();
echo "Password Updated";
}
?>
