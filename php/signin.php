<?php
    session_start();
    include("dbconnect.php");

    if(isset($_POST['login'])){
        $email=$_POST['email'];
        $password=$_POST['password'];

        if(empty($email) || empty($password)){
            echo '<script language="javascript">';
            echo 'alert("Required Email and Password!")';
            echo '</script>';
            echo "<script>location.href='../login.php';</script>";
        }else{
            $sql="SELECT `user_id`,`user_password`,`user_email` FROM user WHERE user_email='$email'";
            $query=mysqli_query($con, $sql);
            $row=mysqli_fetch_array($query);

            $sql_a="SELECT * FROM admin WHERE admin_email='$email'";
            $query_a=mysqli_query($con, $sql_a);
            $row_a=mysqli_fetch_array($query_a);

            if($row['user_password']==$password && $row["user_email"]==$email){
                $_SESSION["user_id"]=$row["user_id"];
                echo "<script>location.href='../index.php';</script>";
            }elseif($row_a['admin_password']==$password && $row_a["admin_email"]==$email){
                $_SESSION["admin_email"]=$row_a["admin_email"];
                echo "<script>location.href='../dashboard.php';</script>";
            }else{
                echo '<script language="javascript">';
                echo 'alert("Wrong Email or Password or Both!")';
                echo '</script>';
                echo "<script>location.href='../login.php';</script>";
            }
        }
    }
?>