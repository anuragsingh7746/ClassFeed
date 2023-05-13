<?php
require('../../class/Student.php');
$student = new Student();

$email = $_GET['email'];
$enroll = substr($email, 0, 10);

$check_student = "SELECT * FROM P2_Student WHERE enroll_no = '$enroll' ";
$count1 = $student->count_row($check_student);
$check_faculty = "SELECT * FROM P2_Instructor WHERE email_id = '$email' ";
$count2 = $student->count_row($check_faculty);

if($count1 > 0 || $count2 > 0){
    $student->send_link($email, 1);
}
else{
  echo "No User found!!";
}


?>
