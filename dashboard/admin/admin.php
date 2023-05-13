<?php
require('../../class/Student.php');
session_start();
if(!isset($_SESSION['enroll_no'])){
    echo "false";
    exit;
}
$student = new Student;
$username = $_SESSION['enroll_no'];
$query = "SELECT role FROM `P2_Login` WHERE login_id= '$username'";
$name = $student->fetch_query($query);
echo $name['role'];

?>
