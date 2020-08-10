<?php
    session_start();
    include("dbconnect.php");

    if(isset($_POST['submit'])){
        $code=$_POST['code'];
        if(empty($code)){
            echo '<script language="javascript">';
            echo 'alert("Check your Mail and Try again with New code!")';
            echo '</script>';
            echo "<script>location.href='../enter_code.php';</script>";
        }else{
            $email=$_SESSION['signup_email'];
            $sql="SELECT `status` FROM user WHERE user_email='$email'";
            $query=mysqli_query($con, $sql);
            $row=mysqli_fetch_array($query);
            if($row['status']==$code){
                $query1="UPDATE user SET `status`='Approved' WHERE user_email='$email'";
                mysqli_query($con,$query1);
                echo '<script language="javascript">';
                echo 'alert("Welcome!")';
                echo '</script>';
                echo "<script>location.href='../login.php';</script>";
                unset($_SESSION['signup_email']);
            }else{
                echo '<script language="javascript">';
                echo 'alert("Your Code was wrong! Try again with New code!")';
                echo '</script>';
                echo "<script>location.href='../enter_code.php';</script>";
            }
        }
    }
?>