<?php
    include("dbconnect.php");
    if(isset($_POST["ans_id_u"]) && isset($_POST["qus_id_u"]) && isset($_POST["ans_user_id"])){
        $ans_id_u=$_POST["ans_id_u"];
        $qus_id_u=$_POST["qus_id_u"];
        $user_id=$_POST["ans_user_id"];
        $sql="INSERT INTO `answer_vote`(`answer_id`, `question_id`, `user_id`, `answer_upvote`, `answer_downvote`) VALUES ('$ans_id_u','$qus_id_u','$user_id',1,0)";
        mysqli_query($con, $sql);
    }elseif(isset($_POST["ans_id_d"]) && isset($_POST["qus_id_d"]) && isset($_POST["ans_user_id"])){
        $ans_id_d=$_POST["ans_id_d"];
        $qus_id_d=$_POST["qus_id_d"];
        $user_id=$_POST["ans_user_id"];
        $sql="INSERT INTO `answer_vote`(`answer_id`, `question_id`, `user_id`, `answer_upvote`, `answer_downvote`) VALUES ('$ans_id_d','$qus_id_d','$user_id',0,1)";
        mysqli_query($con, $sql);
    }elseif(isset($_POST["qus_id_u"]) && isset($_POST["qus_user_id"])){
        $qus_id_u=$_POST["qus_id_u"];
        $user_id=$_POST["qus_user_id"];
        $sql="INSERT INTO `question_vote`(`question_id`, `user_id`, `question_upvote`, `question_downvote`) VALUES ('$qus_id_u','$user_id',1,0)";
        mysqli_query($con, $sql);
    }elseif(isset($_POST["qus_id_d"]) && isset($_POST["qus_user_id"])){
        $qus_id_d=$_POST["qus_id_d"];
        $user_id=$_POST["qus_user_id"];
        $sql="INSERT INTO `question_vote`(`question_id`, `user_id`, `question_upvote`, `question_downvote`) VALUES ('$qus_id_d','$user_id',0,1)";
        mysqli_query($con, $sql);
    }elseif(isset($_POST["qus_v_id"])){
        $qus_v_id=$_POST["qus_v_id"];
        $sql="DELETE FROM question_vote WHERE question_vote_id='$qus_v_id'";
        mysqli_query($con,$sql);
    }elseif(isset($_POST["ans_v_id"])){
        $ans_v_id=$_POST["ans_v_id"];
        $sql="DELETE FROM answer_vote WHERE answer_vote_id='$ans_v_id'";
        mysqli_query($con,$sql);
    }
?>