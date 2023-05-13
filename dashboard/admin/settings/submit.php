<?php
require('../../../class/Student.php');
$student = new Student();
session_start();
$password = $_POST['password'];
$hash = password_hash($password, PASSWORD_BCRYPT);
if(isset($_POST['password'])){
  $login = "UPDATE P2_Login SET `hash` = '$hash' WHERE login_id = 'admin@iiit'";
  $result = $student->run_query($login);
echo "Password Updated";
}
?>
