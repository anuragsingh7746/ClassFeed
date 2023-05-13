<?php
require('../../class/Student.php');
$student = new Student();
session_start();
$name = $_POST['name'];
$password = $_POST['password'];
$username = $_SESSION['username'];
$batch = $_SESSION['batch'];
$department = strtoupper($_SESSION['department']);
$program = $_SESSION['program'];
$email = $_SESSION['email'];
$hash = password_hash($password, PASSWORD_BCRYPT);
$pseudo_name = md5($username);
$role = "student";
if(isset($_SESSION['username'])){
  $submit = "INSERT INTO P2_Student (`enroll_no`, `name`, `dept_name`, `batch`, `program`) VALUES ('$username', '$name', '$department', '$batch', '$program')";
  $result = $student->run_query($submit);
  $login = "INSERT INTO P2_Login (`login_id`, `hash`, `role`) VALUES ('$username', '$hash', '$role')";
  $result = $student->run_query($login);
  $mapping = "INSERT INTO P2_Mapping (`enroll_no`, `pseudo_name`) VALUES ('$username','$pseudo_name')";
  $result = $student->run_query($mapping);
  $delete = "DELETE FROM P2_Verification where email = '$email'";
  $result = $student->run_query($delete);
session_destroy();
echo "Registration Complete";
}
?>
