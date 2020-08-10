<?php
    include("session.php");

    if(isset($_POST['submit_user_name'])){
        $user_id=$_SESSION['user_id'];
        $user_name=$_POST['user_name'];
        if (empty($user_name)){
            echo '<script language="javascript">';
            echo 'alert("Name Required!")';
            echo '</script>';
            echo "<script>location.href='../profile.php';</script>";
        }else{
            $sql="UPDATE `user` SET `user_name`='$user_name' WHERE user_id='$user_id'";
            if(mysqli_query($con, $sql)){
                echo '<script language="javascript">';
                echo 'alert("Successfully Updated your Name!")';
                echo '</script>';
                echo "<script>location.href='../profile.php';</script>";
            }else{
                echo '<script language="javascript">';
                echo 'alert("Try Again!")';
                echo '</script>';
                echo "<script>location.href='../profile.php';</script>";
            }   
        }
    }elseif(isset($_POST['submit_user_email'])){
        $user_id=$_SESSION['user_id'];
        $user_email=$_POST['user_email'];
        if (empty($user_email)){
            echo '<script language="javascript">';
            echo 'alert("Email Required!")';
            echo '</script>';
            echo "<script>location.href='../profile.php';</script>";
        }else{
            $sql="UPDATE `user` SET `user_email`='$user_email' WHERE user_id='$user_id'";
            if(mysqli_query($con, $sql)){
                echo '<script language="javascript">';
                echo 'alert("Successfully Updated your Email!")';
                echo '</script>';
                echo "<script>location.href='../profile.php';</script>";
            }else{
                echo '<script language="javascript">';
                echo 'alert("Try Again!")';
                echo '</script>';
                echo "<script>location.href='../profile.php';</script>";
            }
        }
    }elseif(isset($_POST['submit_user_work'])){
        $user_id=$_SESSION['user_id'];
        $user_work=$_POST['user_work'];
        if (empty($user_work)){
            echo '<script language="javascript">';
            echo 'alert("Work details Required!")';
            echo '</script>';
            echo "<script>location.href='../profile.php';</script>";
        }else{
            $sql="UPDATE `user` SET `user_work`='$user_work' WHERE user_id='$user_id'";
            if(mysqli_query($con, $sql)){
                echo '<script language="javascript">';
                echo 'alert("Successfully Updated your Employment Credential!")';
                echo '</script>';
                echo "<script>location.href='../profile.php';</script>";
            }else{
                echo '<script language="javascript">';
                echo 'alert("Try Again!")';
                echo '</script>';
                echo "<script>location.href='../profile.php';</script>";
            }
        }
    }elseif(isset($_POST['delete_user_work'])){
        $user_id=$_SESSION['user_id'];
        $sql="UPDATE `user` SET `user_work`='default' WHERE user_id='$user_id'";
        if(mysqli_query($con, $sql)){
            echo '<script language="javascript">';
            echo 'alert("Successfully Deleted your Employment Credential!")';
            echo '</script>';
            echo "<script>location.href='../profile.php';</script>";
        }else{
            echo '<script language="javascript">';
            echo 'alert("Try Again!")';
            echo '</script>';
            echo "<script>location.href='../profile.php';</script>";
        }
    }elseif(isset($_POST['submit_user_qualification'])){
        $user_id=$_SESSION['user_id'];
        $user_qualification=$_POST['user_qualification'];
        if (empty($user_qualification)){
            echo '<script language="javascript">';
            echo 'alert("Education details Required!")';
            echo '</script>';
            echo "<script>location.href='../profile.php';</script>";
        }else{
            $sql="UPDATE `user` SET `user_qualification`='$user_qualification' WHERE user_id='$user_id'";
            if(mysqli_query($con, $sql)){
                echo '<script language="javascript">';
                echo 'alert("Successfully Updated your Education Credential!")';
                echo '</script>';
                echo "<script>location.href='../profile.php';</script>";
            }else{
                echo '<script language="javascript">';
                echo 'alert("Try Again!")';
                echo '</script>';
                echo "<script>location.href='../profile.php';</script>";
            }
        }
    }elseif(isset($_POST['delete_user_qualification'])){
        $user_id=$_SESSION['user_id'];
        $sql="UPDATE `user` SET `user_qualification`='default' WHERE user_id='$user_id'";
        if(mysqli_query($con, $sql)){
            echo '<script language="javascript">';
            echo 'alert("Successfully Deleted your Education Credential!")';
            echo '</script>';
            echo "<script>location.href='../profile.php';</script>";
        }else{
            echo '<script language="javascript">';
            echo 'alert("Try Again!")';
            echo '</script>';
            echo "<script>location.href='../profile.php';</script>";
        }
    }elseif(isset($_POST['submit_user_location'])){
        $user_id=$_SESSION['user_id'];
        $user_location=$_POST['user_location'];
        if (empty($user_location)){
            echo '<script language="javascript">';
            echo 'alert("Location Required!")';
            echo '</script>';
            echo "<script>location.href='../profile.php';</script>";
        }else{
            $sql="UPDATE `user` SET `user_location`='$user_location' WHERE user_id='$user_id'";
            if(mysqli_query($con, $sql)){
                echo '<script language="javascript">';
                echo 'alert("Successfully Updated your New Location!")';
                echo '</script>';
                echo "<script>location.href='../profile.php';</script>";
            }else{
                echo '<script language="javascript">';
                echo 'alert("Try Again!")';
                echo '</script>';
                echo "<script>location.href='../profile.php';</script>";
            }
        }
    }elseif(isset($_POST['delete_user_location'])){
        $user_id=$_SESSION['user_id'];
        $sql="UPDATE `user` SET `user_location`='default' WHERE user_id='$user_id'";
        if(mysqli_query($con, $sql)){
            echo '<script language="javascript">';
            echo 'alert("Successfully Deleted your Location!")';
            echo '</script>';
            echo "<script>location.href='../profile.php';</script>";
        }else{
            echo '<script language="javascript">';
            echo 'alert("Try Again!")';
            echo '</script>';
            echo "<script>location.href='../profile.php';</script>";
        }
    }elseif(isset($_POST['submit_user_image'])){
        $target_dir="../img/";
        $path=$_FILES["image_name"]["name"];
        $target_file= $target_dir.basename($path);
        
        $filename = $_POST['previous_file'];

        $user_id=$_SESSION['user_id'];
        if (empty($path)){
            echo '<script language="javascript">';
            echo 'alert("Image file Required!")';
            echo '</script>';
            echo "<script>location.href='../profile.php';</script>";
        }else{
            $sql="UPDATE `user` SET `image`='$path' WHERE user_id='$user_id'";
            if (mysqli_query($con, $sql)){
                move_uploaded_file($_FILES["image_name"]["tmp_name"], $target_file);
                if($filename!="default.png"){
                    unlink($target_dir.basename($filename));
                    echo '<script language="javascript">';
                    echo 'alert("New Picture Succesfully Updated")';
                    echo '</script>';
                    echo "<script>location.href='../profile.php';</script>";
                }else{
                    echo '<script language="javascript">';
                    echo 'alert("New Picture Succesfully Update")';
                    echo '</script>';
                    echo "<script>location.href='../profile.php';</script>";
                }
            }else{
                echo '<script language="javascript">';
                echo 'alert("Try Again!")';
                echo '</script>';
                echo "<script>location.href='../profile.php';</script>";
            }
        }
    }elseif(isset($_POST['submit_user_password'])){
        $user_id=$_SESSION['user_id'];
        $old_password=$_POST['old_password'];
        $new_password=$_POST['new_password'];
        if (empty($old_password) || empty($new_password) || empty($new_password)){
            echo '<script language="javascript">';
            echo 'alert("All field must be filled up!")';
            echo '</script>';
            echo "<script>location.href='../change-password.php';</script>";
        }else{
            $sql="SELECT `user_password` FROM user WHERE user_password='$old_password' AND user_id='$user_id'";
            $query=mysqli_query($con,$sql);
            $row=mysqli_fetch_array($query);
            if($row>0){
                $sql1="UPDATE `user` SET `user_password`='$new_password' WHERE user_id='$user_id'";
                if(mysqli_query($con,$sql1)){
                    echo '<script language="javascript">';
                    echo 'alert("Password Succesfully Change!")';
                    echo '</script>';
                    echo "<script>location.href='../profile.php';</script>";
                }else{
                    echo '<script language="javascript">';
                    echo 'alert("Password does not Change!")';
                    echo '</script>';
                    echo "<script>location.href='../change-password.php';</script>";
                }
            }else{
                echo '<script language="javascript">';
                echo 'alert("Your Old Password is Wrong! Try Again!")';
                echo '</script>';
                echo "<script>location.href='../change-password.php';</script>";
            }
        }

    }elseif(isset($_POST['save_question'])){
        $qus_title=$_POST["title"];
        $qus_body=mysqli_real_escape_string($con, $_POST["q_body"]);
        $qus_id=$_POST["qus_id"];
        $sql="UPDATE question SET `question_title`='$qus_title', `question_body`='$qus_body' WHERE question_id='$qus_id' ";
        if(mysqli_query($con,$sql)){
            echo '<script language="javascript">';
            echo 'alert("Question Succesfully Updated!")';
            echo '</script>';
            echo '<script>location.href="../post_answer.php?question_id='.$qus_id.'";</script>';
        }else{
            echo '<script language="javascript">';
            // echo 'alert("'.($con->error).'")';
            echo 'alert("Question does not Updated!")';
            echo '</script>';
            echo '<script>location.href="../edit_question.php?question_id='.$qus_id.'";</script>';
        }
        
    }elseif(isset($_POST['save_answer'])){
        $ans_body=mysqli_real_escape_string($con, $_POST["ans_body"]);
        $ans_id=$_POST["answer_id_editA"];
        $qus_id=$_POST["question_id_editA"];
        $sql="UPDATE answer SET `answer`='$ans_body' WHERE answer_id='$ans_id' ";
        if(mysqli_query($con,$sql)){
            echo '<script language="javascript">';
            echo 'alert("Answer Succesfully Updated!")';
            echo '</script>';
            echo '<script>location.href="../post_answer.php?question_id='.$qus_id.'";</script>';
        }else{
            echo '<script language="javascript">';
            // echo 'alert("'.($con->error).'")';
            echo 'alert("Answer does not Updated!")';
            echo '</script>';
            echo '<script>location.href="../edit_question.php?question_id='.$qus_id.'";</script>';
        }
        
    }elseif(isset($_POST['send_feedback'])){
        $feedback=mysqli_real_escape_string($con, $_POST["m_body"]);
        $user_id=$_POST["user_id"];
        $sql="INSERT INTO `feedback`(`feedback`,`user_id`) VALUES ('$feedback','$user_id')";
        if(mysqli_query($con,$sql)){
            echo '<script language="javascript">';
            echo 'alert("Feedback Send!")';
            echo '</script>';
            echo '<script>location.href="../index.php";</script>';
        }else{
            echo '<script language="javascript">';
            echo 'alert("Feedback doesnot send!")';
            echo '</script>';
            echo '<script>location.href="../feedback.php";</script>';
        }
        
    }
?>