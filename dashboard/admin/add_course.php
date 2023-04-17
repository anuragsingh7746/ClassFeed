<?php 
require('../../class/Admin.php');


$admin = new Admin;
$course_id = $_GET['course_id'];
$course_title = $_GET['course_title'];
$dept_name = $_GET['dept_name'];
$type = $_GET['type'];
$credits = $_GET['credits'];

$query = "INSERT INTO `P2_Course` (`course_id`, `course_title`, `dept_name`, `type`, `credits`) VALUES ('$course_id', '$course_title', '$dept_name', '$type', '$credits')";
$check = $admin->run_query($query);
if($check == '1'){
    echo "success";
}
?>
