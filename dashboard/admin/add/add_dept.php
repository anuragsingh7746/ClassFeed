<?php 
require('../../class/Admin.php');


$admin = new Admin;
$dept_name = $_GET['dept_name'];

$query = "INSERT INTO `P2_Department` (`dept_name`) VALUES ('$dept_name')";
$check = $admin->run_query($query);
if($check == '1'){
    echo "success";
}
?>
