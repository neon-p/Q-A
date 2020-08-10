<?php
include("dbconnect.php");

if(isset($_POST["query_m"])){                                                       //members search for admin 
    $sql_mlist="SELECT * FROM user WHERE user_name LIKE '%".$_POST["query_m"]."%'";
    $query_mlist=mysqli_query($con, $sql_mlist);
    $i=0;
    if(mysqli_num_rows($query_mlist) > 0){
?>
<thead>
    <tr>
        <th>SL</th>
        <th>User Name</th>
        <th>Email</th>
        <th>Location</th>
        <th></th>
    </tr>
</thead>
<?php
        while($row_mlist=mysqli_fetch_array($query_mlist)){
            $i++;
?>
<tbody>
<tr>
    <td><?php echo $i; ?></td>
    <td><?php echo $row_mlist["user_name"]; ?></td>
    <td><?php echo $row_mlist["user_email"]; ?></td>
    <td><?php echo $row_mlist["user_location"]; ?></td>
    <?php
        if($row_mlist["status"]=='Approved'){
            echo '<td><a href="php/delete_q&a.php?user_id_b='.$row_mlist["user_id"].'"><button class="btn btn-danger">Banned</button></a></td>';
        }elseif($row_mlist["status"]=='Banned'){
            echo '<td><a href="php/delete_q&a.php?user_id_a='.$row_mlist["user_id"].'"><button class="btn btn-danger">Active</button></a></td>';
        }
    ?>
</tr>
</tbody>
<?php
        }
    }else{
        echo "<h4> Nothing Found</h4>";
    }

}elseif(isset($_POST["query_q"])){                                                  //question search for admin
    $sql_qlist="SELECT * FROM question WHERE question_title LIKE '%".$_POST["query_q"]."%' ";
    $query_qlist=mysqli_query($con, $sql_qlist);
    $i=0;
    if(mysqli_num_rows($query_qlist) > 0){
?>
<thead>
    <tr>
        <th>SL</th>
        <th>User Name</th>
        <th>Question</th>
        <th>Question Upvote</th>
        <th>Question Downvote</th>
        <th></th>
    </tr>
</thead>
<?php  
        while($row_qlist=mysqli_fetch_array($query_qlist)){
            $user_qid=$row_qlist["user_id"];
            $i++;
            $sql_Qmem="SELECT user_name FROM user WHERE user_id='$user_qid'";
            $query_Qmem=mysqli_query($con,$sql_Qmem);
            $row_Qmem=mysqli_fetch_array($query_Qmem);
?>
<tbody>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $row_Qmem["user_name"]; ?></td>
        <td><?php echo $row_qlist["question_title"]; ?></td>
        <td><?php echo $row_qlist["question_upvote"]; ?></td>
        <td><?php echo $row_qlist["question_downvote"]; ?></td>
        <td><a href="php/delete_q&a.php?question_id=<?php echo $row_qlist["question_id"]; ?>"><button class="btn btn-danger">Delete</button></a></td>
    </tr>
</tbody>
<?php
        }
    }else{
        echo "<h4> Nothing Found</h4>";
    }

}elseif(isset($_POST["query_c"])){                                                  //category search for admin 
    $sql_clist="SELECT * FROM category WHERE category_name LIKE '%".$_POST["query_c"]."%'";
    $query_clist=mysqli_query($con, $sql_clist);
    $i=0;
    if(mysqli_num_rows($query_clist) > 0){
?>
<thead>
    <tr>
        <th>SL</th>
        <th>Category Name</th>
        <th>Category choose by user</th>
        <th></th>
    </tr>
</thead>
<?php 
        while($row_clist=mysqli_fetch_array($query_clist)){
            $i++;
            $category_cid=$row_clist["category_id"];
            $sql_cat_ulike="SELECT DISTINCT user_id FROM user_category WHERE category_id='$category_cid'";
            $query_cat_ulike=mysqli_query($con, $sql_cat_ulike);
            $num_Oflike=mysqli_num_rows($query_cat_ulike);
?>
<tbody>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $row_clist["category_name"]; ?></td>
        <td><?php echo $num_Oflike; ?></td>
    </tr>
</tbody>
<?php
        }
    }else{
        echo "<h4> Nothing Found</h4>";
    }
}
?>