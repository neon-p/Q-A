<?php
    include("dbconnect.php");

    if(isset($_POST['save'])){
        $category_name=$_POST['category_name'];
        if(empty($category_name)){
            echo '<script language="javascript">';
            echo 'alert("Fillup Category field!")';
            echo '</script>';
            echo "<script>location.href='../category.php';</script>";
        }else{
            $sql="INSERT INTO `category`(`category_name`) VALUES ('$category_name')";
            if(mysqli_query($con, $sql)){
                echo '<script language="javascript">';
                echo 'alert("Category Successfully added!")';
                echo '</script>';
                echo "<script>location.href='../category.php';</script>";
            }
        }
    }
?>