<?php
    include("dbconnect.php");
    if(isset($_POST["submit_answer"])){
        $answer=$_POST["answer"];
        $qus_id=$_POST["question_id"];
        $user_id=$_POST["user_id"];
        $sql="INSERT INTO `answer`(`answer`,`question_id`, `user_id`) VALUES ('$answer','$qus_id','$user_id')";
        if(mysqli_query($con,$sql)){
            header("location:../post_answer.php?question_id=".$qus_id."");
        }
    }
?>