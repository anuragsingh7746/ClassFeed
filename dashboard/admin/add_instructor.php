<?php 
require('../../class/Admin.php');


$admin = new Admin;
$name = $_GET['name'];
$email_id = $_GET['email_id'];
$dept_name = $_GET['dept_name'];

$query = "INSERT INTO `P2_Instructor` (`name`, `email_id`, `dept_name`) VALUES ('$name', '$email_id', '$dept_name')";
$check = $admin->run_query($query);
if($check == '1'){
    echo "success";
}
?>
