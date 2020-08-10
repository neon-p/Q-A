
<?php 
    include("dbconnect.php");
    if(isset($_POST["query"])){  
        $query = "SELECT * FROM question WHERE question_title LIKE '%".$_POST["query"]."%'";  
        $result = mysqli_query($con, $query);  
        if(mysqli_num_rows($result) > 0){  
            while($row_s = mysqli_fetch_array($result)){
?>
<a href="post_answer.php?question_id=<?php echo $row_s["question_id"];?>">
    <div class="media">
    
        <div class="media-left">
        </div>

        <div class="media-body">
                <?php echo $row_s["question_title"]; ?>
        </div>
        
    </div>
</a>
<hr>
<?php
            }
        }else{
            echo "<h4> Nothing Found</h4>";
        }
    }
?>