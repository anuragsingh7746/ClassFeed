<?php
require('../../class/Student.php');
session_start();
if(!isset($_SESSION['enroll_no'])){
    echo "false";
    exit;
}
$student = new Student;
$username = $_SESSION['enroll_no'];
$query = "SELECT name FROM `P2_Student` WHERE enroll_no= '$username'";
$name = $student->fetch_query($query);
echo $name['name'];

?>
