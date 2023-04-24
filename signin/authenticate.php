<?php
require('../class/Student.php');
$student = new Student;
session_start();
$username = $_POST['username'];
$password = $_POST['password'];

$login = "SELECT * FROM P2_Login where enroll_no = '$username'";
$result = $student->fetch_query($login);
$hash = $result['hash'];
if(password_verify($password, $hash)){
    $_SESSION['enroll_no'] = $username;
    header("Location: ../dashboard/student/student.html");
}else header("Location: ../index.html");
?>
