<?php
    include("session.php");

    if(isset($_POST["submit_qus_btn"])){
        $qus_title=$_POST["qus_title"];
        $qus_body=$_POST["qus_body"];
        $qus_tags=$_POST["qus_tags"];
        if(empty($qus_body) || empty($qus_title) || empty($qus_tags)){
            echo '<script language="javascript">';
            echo 'alert("Required Question!")';
            echo '</script>';
        }else{
            $user_id=$_SESSION['user_id'];

            $sql="INSERT INTO `question`(`question_title`, `question_body`,`user_id`,`question_status`) VALUES ('$qus_title','$qus_body','$user_id','pending')";
            if(mysqli_query($con,$sql)){
                $_SESSION["qus_tags"]=$qus_tags;
                header("location:inserting_tags.php");
            }
        }
    }
?>