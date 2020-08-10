<?php
    include("dbconnect.php");
    if(isset($_GET["answer_id"]) && isset($_GET["question_id"])){
        $answer_id=$_GET["answer_id"];
        $question_id=$_GET["question_id"];
        $sql_ansV="DELETE FROM answer_vote WHERE question_id='$question_id' AND answer_id='$answer_id'";
        if(mysqli_query($con,$sql_ansV)){
            $sql_ans="DELETE FROM answer WHERE question_id='$question_id' AND answer_id='$answer_id'";
            if(mysqli_query($con,$sql_ans)){
                header("location:../post_answer.php?question_id=$question_id");
            }
        }
    }elseif(isset($_GET["question_id"])){
        $question_id=$_GET["question_id"];
        $sql_ans="DELETE FROM answer WHERE question_id='$question_id'";
        if(mysqli_query($con,$sql_ans)){
            $sql_qusC="DELETE FROM question_category WHERE question_id='$question_id'";
            if(mysqli_query($con, $sql_qusC)){
                $sql_qusV="DELETE FROM question_vote WHERE question_id='$question_id'";
                if(mysqli_query($con, $sql_qusV)){
                    $sql_qus="DELETE FROM question WHERE question_id='$question_id'";
                    if(mysqli_query($con,$sql_qus)){
                        header("location:../dashboard.php");
                    }
                }
            }
        }
    }elseif(isset($_GET["user_id_a"])){
        $user_id=$_GET["user_id_a"];
        $sql="UPDATE `user` SET `status`='Approved' WHERE user_id='$user_id'";
        if(mysqli_query($con, $sql)){
            echo '<script language="javascript">';
            echo 'alert("User Unbanned!")';
            echo '</script>';
            echo "<script>location.href='../members.php';</script>";
        }
    }elseif(isset($_GET["cat_id"])){
        $category_id=$_GET["cat_id"];
        $sql_ucat="DELETE FROM question_category WHERE category_id='$category_id'";
        if(mysqli_query($con, $sql_ucat)){
            $sql_ucat="DELETE FROM user_category WHERE category_id='$category_id'";
            if(mysqli_query($con, $sql_ucat)){
                $sql_cat="DELETE FROM category WHERE category_id='$category_id'";
                if(mysqli_query($con, $sql_cat)){
                    echo '<script language="javascript">';
                    echo 'alert("Category Succesfully Deleted!")';
                    echo '</script>';
                    echo "<script>location.href='../category.php';</script>";
                }
            }
        }
    }elseif(isset($_GET["user_id_b"])){
        $user_id=$_GET["user_id_b"];
        $sql="UPDATE `user` SET `status`='Banned' WHERE user_id='$user_id'";
        if(mysqli_query($con, $sql)){
            echo '<script language="javascript">';
            echo 'alert("User Banned!")';
            echo '</script>';
            echo "<script>location.href='../members.php';</script>";
        }
    }elseif(isset($_GET["feedback_id"])){
        $feedback_id=$_GET["feedback_id"];
        $sql="DELETE FROM feedback WHERE feedback_id='$feedback_id'";
        if(mysqli_query($con, $sql)){
            echo '<script language="javascript">';
            echo 'alert("Deleted Succesfully!")';
            echo '</script>';
            echo "<script>location.href='../all_feedback.php';</script>";
        }
    }
?>