<?php 
require('../../class/Admin.php');


$admin = new Admin;
$name = $_GET['name'];
$email_id = $_GET['email_id'];
$dept_name = $_GET['dept_name'];
$default = 'password';
$hash = password_hash($default, PASSWORD_BCRYPT);
$role = 'professor';
$query = "INSERT INTO `P2_Instructor` (`name`, `email_id`, `dept_name`) VALUES ('$name', '$email_id', '$dept_name')";
$check = $admin->run_query($query);
$query = "INSERT INTO `P2_Login` (`login_id`, `hash`, `role`) VALUES ('$email_id', '$hash', '$role')";
$check = $admin->run_query($query);
if($check == '1'){
    echo "success";
}
?>
