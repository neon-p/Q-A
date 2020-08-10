<?php
    session_start();
    include("dbconnect.php");

    if(isset($_POST["code"])){
        $email=$_SESSION["signup_email"];
        $code=$_POST["code"];
    
        if(!empty($email)){
            require_once '../mail/PHPMailerAutoload.php';

            $mail = new PHPMailer();  // create a new object
            $mail->IsSMTP(); // enable SMTP
            $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = true;  // authentication enabled
            $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
            $mail->SMTPAutoTLS = false;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
        
            $mail->Username = 'fariahossain656@gmail.com';//email
            $mail->Password = 'Faria@123'; //email pass
            $mail->SetFrom('fariahossain656@gmail.com','');//email
            $mail->addAddress($email);
    
            $mail->Subject = 'Verification Code';
            $mail->msgHTML("This is your one time verification code $code ."); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
            $mail->AltBody = 'HTML messaging not supported';
            if(!$mail->Send()) {
            // 	$error = 'Mail error: '.$mail->ErrorInfo; 
            // 	return false;
            } else {
                // header("location:home.php");
            // 	$error = 'Message sent!';
            // 	return true;
            }
            $query="UPDATE user SET `status`='$code' WHERE user_email='$email'";
            mysqli_query($con,$query);
        }
    }
?>