<?php

session_start();

?>
<?php
require('../../server/connect.php');
$enroll = $_SESSION['enroll_no'];
$review = $_POST['review'];
$rating1 = $_POST['rating1'];
$rating2 = $_POST['rating2'];
$rating3 = $_POST['rating3'];
$rating4 = $_POST['rating4'];
$rating5 = $_POST['rating5'];
$avgrating = ($rating1 + $rating2 + $rating3 + $rating4 + $rating5) / 5;
$courseid = $_POST['button'];
$currentdate = date('Y-m-d H:i:s');
$year = date('Y');
$sql = "SELECT pseudo_name FROM P2_Mapping where enroll_no = '$enroll'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);
$pseudo_name = $row['pseudo_name'];
$feebackid = md5($enroll . '-' . $currentdate);

$sql = "insert into P2_Feedback values ('$feebackid', '$pseudo_name', '$courseid', '$year', '$rating1', '$rating2', '$rating3', '$rating4', '$rating5', '$review', '$avgrating')";
if(mysqli_query($conn, $sql)){
    header("location:student.php");
  }



?>
