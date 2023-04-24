<?php
require('../../class/Student.php');
$student = new Student();


$email = $_GET['email'];
$enroll = substr($email, 0, 10);

$check_student = "SELECT * FROM P2_Student WHERE enroll_no = '$enroll' ";
$count = $student->count_row($check_student);
if($count > 0){
  echo "User already exists!!";
}
else{
  $student->send_link($email, 0);
}

?>
