<?php
    include("dbconnect.php");

    $sql="SELECT * FROM category";
    $query=mysqli_query($con, $sql);
    $data=array();
    if(mysqli_num_rows($query)>0){
        while($row=mysqli_fetch_assoc($query)){
            $data[]=$row;
        }
        // echo json_encode($data);
        $fp = fopen('js/tags.json', 'w');
        fwrite($fp, json_encode($data));
        fclose($fp);
    }
?>