<?php
    include("session.php");

    $qus_tags=$_SESSION["qus_tags"];
    $tags_id=explode (",", $qus_tags);
    $user_id=$_SESSION['user_id'];

    $sql="SELECT question_id FROM question WHERE question_status='pending' and user_id='$user_id'";
    $query=mysqli_query($con,$sql);
    $row=mysqli_fetch_array($query);

    for ($i=0;$i<count($tags_id);$i++){
        unset($_SESSION["qus_tags"]);
        $tags_id_tmp=$tags_id[$i];
        $question_id=$row["question_id"];
        mysqli_query($con,"START TRANSACTION");
        $sql1="INSERT INTO `question_category`(`question_id`, `category_id`) VALUES ('$question_id','$tags_id_tmp')";
        $sql2="INSERT INTO `user_category`(`user_id`, `category_id`) VALUES ('$user_id','$tags_id_tmp')";

        $query1 = mysqli_query($con, $sql1);
        $query2 = mysqli_query($con, $sql2);
    }
    if ($query1 and $query2) {
        mysqli_query($con,"COMMIT");
        $sql="UPDATE question SET question_status='approved' WHERE question_status='pending' and user_id='$user_id'";
        if(mysqli_query($con,$sql)){
            header("location:../index.php");
        }
    } else {        
        mysqli_query($con, "ROLLBACK");
    }
?>