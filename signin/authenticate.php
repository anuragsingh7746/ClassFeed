<?php
require('../class/Student.php');
$student = new Student;
session_start();
$username = $_POST['username'];
$password = $_POST['password'];

$login = "SELECT * FROM P2_Login where login_id = '$username'";
$result = $student->fetch_query($login);
$hash = $result['hash'];
$role = $result['role'];
if(password_verify($password, $hash)  &&  $role == 'student'){
    $_SESSION['enroll_no'] = $username;
    header("Location: ../dashboard/student/student.php");
}
else if(password_verify($password, $hash)  &&  $role == 'professor'){
    $name = "SELECT ID from P2_Instructor where email_id = '$username'";
    $result = $student->fetch_query($name);
    $_SESSION['enroll_no'] = $result['ID'];
    header("Location: ../dashboard/profs/professor.html");
}
else if(password_verify($password, $hash)  &&  $role == 'admin'){
    $_SESSION['enroll_no'] = $username;
    header("Location: ../dashboard/admin/index.php");
}
else header("Location: ../index.html");
?>
