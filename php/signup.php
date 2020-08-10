<?php
    session_start();
    include("dbconnect.php");

    if(isset($_POST['register'])){
        $name=$_POST['name'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        if(empty($name) || empty($email) || empty($password)){
            echo '<script language="javascript">';
            echo 'alert("All field must be filled up!")';
            echo '</script>';
            echo "<script>location.href='index.php';</script>";
        }else{
            $sql="INSERT INTO `user`(`user_name`, `user_email`, `user_password`,`user_work`,`user_qualification`,`user_location`,`image`,`status`) VALUES ('$name','$email','$password','default','default','default','default.png','pending')";
            if(mysqli_query($con,$sql)){
                $_SESSION['signup_email']=$email;
                echo "<script>location.href='../enter_code.php';</script>";
            }else{
                echo '<script language="javascript">';
                echo 'alert("Please Try again!")';
                echo '</script>';
                echo "<script>location.href='../login.php';</script>";
            }
        }
    }elseif(isset($_POST["submit_email"])){
        $email=$_POST["email"];
        if(empty($email)){
            echo '<script language="javascript">';
            echo 'alert("Email must be needed!")';
            echo '</script>';
            echo "<script>location.href='../login.php';</script>";   
        }else{
            $sql="SELECT user_email FROM user WHERE user_email='$email'";
            $query=mysqli_query($con, $sql);
            if(mysqli_num_rows($query)==0){
                echo '<script language="javascript">';
                echo 'alert("This email doesnot exist!")';
                echo '</script>';
                echo "<script>location.href='../login.php';</script>";
            }else{
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
                $mail->Password = 'Faria@123'; //email password
                $mail->SetFrom('fariahossain656@gmail.com','');//email
                $mail->addAddress($email);

                //random code generator
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $new_password = '';
                for ($i = 0; $i < 8; $i++) {
                    $new_password .= $characters[rand(0, $charactersLength - 1)];
                }
                //end of this function

                $mail->Subject = 'Reset Password';
                $mail->msgHTML("This is your New Password $new_password ."); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
                $mail->AltBody = 'HTML messaging not supported';
                if(!$mail->Send()) {
                // 	$error = 'Mail error: '.$mail->ErrorInfo; 
                // 	return false;
                } else {
                    // header("location:home.php");
                // 	$error = 'Message sent!';
                // 	return true;
                }
                $query="UPDATE user SET `user_password`='$new_password' WHERE user_email='$email'";
                if(mysqli_query($con,$query)){
                    echo '<script language="javascript">';
                    echo 'alert("Check your Email. We send you a new password!")';
                    echo '</script>';
                    echo "<script>location.href='../login.php';</script>";
                }
                
            }
        }
    }
?>