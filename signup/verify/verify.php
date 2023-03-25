<?php
require('../../server/connect.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require 'vendor/autoload.php';


$email = $_GET['email'];

$enroll = substr($email, 0, 10);


function send_link($email){
  
  $verification_token = md5($email);

  $mail = new PHPMailer();

  $mail->isSMTP();

  $mail->Host = 'smtp.gmail.com';
  $mail->Port = 465;

  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

  $mail->SMTPAuth = true;

  $mail->Username = 'iit2021193@iiita.ac.in';

  $mail->Password = '_Piltover123.';

  $mail->setFrom('iit2021193@iiita.ac.in', 'Anurag Singh');

  $mail->addReplyTo('iit2021193@iiita.ac.in', 'Anurag Singh');

  $mail->addAddress($email);
  $mail->isHTML(true);
  //Set the subject line
  $mail->Subject = 'Email verification from ClassFeed';


//The url you wish to send the POST request to
$url = 'http://localhost/signup/register/register.php';

//The data you want to send via POST
$fields = [
    'email'      => $email,
    'token' => $verification_token,
];

//url-ify the data for the POST
$fields_string = http_build_query($fields);

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, true);
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

//So that curl_exec returns the contents of the cURL; rather than echoing it
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 

//execute post
$result = curl_exec($ch);
echo $result;




  $email_template = "
  <h5>Verify you email to register for ClassFeed with the link given below</h5>
  <br>
  <a href='http://localhost/signup/register/register.php?token=$verification_token&email=$email'>http://localhost/signup/register/register.php?token=$verification_token&email=$email</a>
  <a href='$result'>test</a>
";


  //Read an HTML message body from an external file, convert referenced images to embedded,
  //convert HTML into a basic plain-text alternative body
  $mail->Body = $email_template;
  //$mail->msgHTML(file_get_contents('contents.html'), __DIR__);

  $mail->send();


}

send_link($email);
//echo "Verification link sent successfully!!";
//$check_student = "select enroll_no from P2_Student where enroll_no = '$enroll' ";
//$result = $conn->query($check_student);
//if($result->num_rows > 0){
  //echo "User already exists!!";
//}
//else{
  //send_link('$email');
  //echo "Verification link sent!!";
//}


?>
