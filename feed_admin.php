<?php
    include("php/session.php");
?>
<!Doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Admin</title>


        <link rel="icon" type="image/x-icon" href="img/">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link href="css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/admin.css" rel="stylesheet" type="text/css"/>       
    </head>
    <body>




        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="row">
                    <div class="navbar-header col-sm-2 part1 text-center">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Admin</a>
                    </div>
                    <div class="col-sm-10">
                        <div class="collapse navbar-collapse" id="myNavbar">

                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i></a></li>
                                <li><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false"><img src="img/blank-profile-pic.png" class="img-responsive img-circle pro-pic" alt="">  
                                    </a>
                                    <ul class="dropdown-menu">
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container-fluid pt-60">
            <div class="row">
                <div class="col-sm-2 part1" style="height: 80vh;background-color:#f8f8f8;">
                    <h3 style="color:black">Main Menu</h3>
                    <hr>
                    <ul class="list-unstyled">
                        <li><a href="dashboard.php"><i class="fa fa-circle-o" aria-hidden="true"></i> Dashboard</a></li><hr>
                        <li><a href="members.php"><i class="fa fa-circle-o" aria-hidden="true"></i> Member List</a></li><hr>
                        <li><a href="all_post.php"><i class="fa fa-circle-o" aria-hidden="true"></i> All Post</a></li><hr>
                        <li><a href="category.php"><i class="fa fa-circle-o" aria-hidden="true"></i> Category</a></li><hr>
                        <li><a href="feed_admin.php"><i class="fa fa-circle-o" aria-hidden="true"></i> Feed</a></li><hr>
                        <li><a href="all_feedback.php"><i class="fa fa-circle-o" aria-hidden="true"></i> Feedback</a></li><hr>
                    </ul>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1 pt-20">
                        <?php
                            $sql1="SELECT * FROM question";//retrive question details from database
                            $query1=mysqli_query($con, $sql1);
                            $i=0;
                            while($row1=mysqli_fetch_array($query1)){
                                $i++;
                                $s="demo";
                                $user_id_qus=$row1["user_id"];
                                $question_id=$row1["question_id"];

                                $question_full=$row1["question_body"];
                                $question_cut=substr($question_full,0,300);
                                $question_remain=substr($question_full,300,strlen($question_full));

                                $sql2="SELECT * FROM user WHERE user_id='$user_id_qus'";//retrive user image,name for question
                                $query2=mysqli_query($con, $sql2);
                                $row2=mysqli_fetch_array($query2);

                                $sql3="SELECT * FROM answer WHERE question_id='$question_id' ORDER BY answer_id DESC";//retrive comment details of this question
                                $query3=mysqli_query($con, $sql3);
                                $row3_count=mysqli_num_rows($query3);
                        ?>
                            <div class="bg-white p-10 mb-15">
                                <div class="media">
                                    <div class="media-left">
                                        <img src="img/<?php echo $row2["image"];?>" class="img-circle pro-pic">
                                    </div>
                                    <div class="media-body">
                                        <a href="#"><h5 class="media-heading"><?php echo $row2["user_name"];?></a> <small><i><?php echo $row2["user_location"]; ?></i></small>
                                            <br>
                                            <h6><?php echo $row2["user_work"]; ?>, <?php echo $row2["user_qualification"]; ?></h6>
                                        </h5>
                                    </div>

                                </div> 

                                <div class="post">
                                    <h4><strong><?php echo $row1["question_title"];?></strong></h4>
                                    <img src="img/bloom-blooming-blossom-blur-462118.jpg" class="img-responsive" alt=""/>
                                    <p><?php echo $question_cut; ?><span id="dots<?php echo $i; ?>">...<button onclick="readFunction<?php echo $i; ?>();">See more</button></span><span id="more<?php echo $i; ?>" style="display:none;"><?php echo $question_remain; ?></span></p>
                                </div>
                                <script>
                                    function readFunction<?php echo $i; ?>() {
                                        var dots = document.getElementById("dots<?php echo $i; ?>");
                                        var moreText = document.getElementById("more<?php echo $i; ?>");


                                        if (dots.style.display === "none") {
                                            dots.style.display = "inline";

                                            moreText.style.display = "none";
                                        } else {
                                            dots.style.display = "none";

                                            moreText.style.display = "inline";
                                        }
                                    }
                                </script>
                                <a href="php/delete_q&a.php?question_id=<?php echo $question_id; ?>" style="padding-left:475px;"><button title="Post Answer" ><i class="fa fa-paper-plane" aria-hidden="true"></i> <span>Delete Post</span></button></a>
                                <div class="react pt-10">
                                        <i class="fa fa-arrow-up" aria-hidden="true"></i> <span> <?php echo $row1["question_upvote"];?></span>&nbsp;&nbsp;
                                        <i class="fa fa-arrow-down" aria-hidden="true"></i> <span> <?php echo $row1["question_downvote"];?></span>
                                        <br><br>
                                        <button title="Comments" data-toggle="collapse" data-target="#<?php echo $s.$i; ?>">
                                            <i class="fa fa-comment-o" aria-hidden="true"></i> <span> <?php echo $row3_count;?></span>
                                        </button>

                                    <div id="<?php echo $s.$i; ?>" class="collapse">
                                        <br>
                                        <div class="row">
                                            <?php
                                                while($row3=mysqli_fetch_array($query3)){
                                                    $user_id_ans=$row3["user_id"];
                                                    $sql4="SELECT user_id,user_name,image FROM user WHERE user_id='$user_id_ans'";//retrive user image,name for comment
                                                    $query4=mysqli_query($con, $sql4);
                                                    $row4=mysqli_fetch_array($query4);
                                            ?>
                                            <div class="col-sm-12" id="user_answer">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <img src="img/<?php echo $row4["image"]; ?>" class="img-circle pro-pic">
                                                    </div>

                                                    <div class="media-body">
                                                        <a href="#"><h5 class="media-heading"><?php echo $row4["user_name"]; ?></a></h5>
                                                    </div>

                                                </div> 

                                                <div>
                                                    <div class="comment mb-15">
                                                        <?php echo $row3["answer"]; ?>
                                                    </div>
                                                    <i class="fa fa-arrow-up" aria-hidden="true"></i><span> <?php echo $row3["answer_upvote"]; ?></span>&nbsp;&nbsp;
                                                    <i class="fa fa-arrow-down" aria-hidden="true"></i><span> <?php echo $row3["answer_downvote"]; ?></span>
                                                </div>
                                                <br>
                                            </div>
                                            <?php 
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                }
                            ?>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
      
    </body>
</html>
