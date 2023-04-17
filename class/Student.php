<?php
include_once('DbConnection.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require 'vendor/autoload.php';


class Student extends DbConnection{
     
    public function __construct(){
        parent::__construct();
    }


    public function escape_string($value){
        return $this->conn->real_escape_string($value);
    }
    
    public function send_link($email, $flag){

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->SMTPAuth = true;
        $mail->Username = 'iit2021193@iiita.ac.in';
<<<<<<< HEAD
        $mail->Password = 'passwordehere';
=======
        $mail->Password = '*password_here*';
>>>>>>> eb5f0153cc9be265dd49e7e821d6634893b35755
        $mail->setFrom('iit2021193@iiita.ac.in', 'Anurag Singh');
        $mail->addReplyTo('iit2021193@iiita.ac.in', 'Anurag Singh');
        $mail->addAddress($email);
        $mail->isHTML(true);

        $mail->Subject = 'Email verification from ClassFeed';

        $expFormat = mktime(date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y"));
        $expDate = date("Y-m-d H:i:s",$expFormat);
        $verification_token = md5($email);
        $addKey = substr(md5(uniqid(rand(),1)),3,10);
        $verification_token = $verification_token . $addKey;
        
        if($flag == 0){
            $email_template = "
            <h5>Verify you email to register for ClassFeed with the link given below</h5>
            <br>
            <a href='http://localhost/signup/register/register.php?token=$verification_token&email=$email'>http://localhost/signup/register/register.php?token=$verification_token&email=$email</a>
            <h5>DO NOT SHARE THIS LINK WITH ANYONE</h5>
            ";

        }
        else if($flag == 1){
            $email_template = "
            <h5>Reset Password link for ClassFeed</h5>
            <br>
            <a href='http://localhost/signup/register/register.php?token=$verification_token&email=$email'>http://localhost/signup/register/register.php?token=$verification_token&email=$email</a>
            <h5>DO NOT SHARE THIS LINK WITH ANYONE</h5>
            ";

        }

        $mail->Body = $email_template;

        if(!$mail->send()){
            echo "Error : 1";

        }else{
            if($flag == 0){
                $add_user = "INSERT INTO P2_Verification (`email` , `token`, `expiryDate`) VALUES ('$email', '$verification_token', '$expDate')";
                if($this->conn->query($add_user)){
                echo "Verification link sent!!";
                }else {
                echo "Error : 2";
                }
            }
            else if($flag == 1){

            }

            
        }
    }


    public function fetch_query($sql_query){
        $query = $this->conn->query($sql_query);
        $result = $query->fetch_assoc();
        return $result;
    }


    public function count_row($sql_query){
        $query = $this->conn->query($sql_query);
        $result = $query->num_rows;
        return $result;
    }


    public function run_query($sql_query){
        $query = $this->conn->query($sql_query);
        return $query;
    }
    


}
