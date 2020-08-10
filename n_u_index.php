<!Doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Home</title>
        <link rel="icon" type="image/x-icon" href="img/">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-tagsinput.css">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
        <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script src="js/bootstrap-typeahead.min.js"></script>
        <script src="js/bootstrap-tagsinput.js"></script>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>

    </head>
    <body>

        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">Q&A</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.php"><i class="fa fa-book" aria-hidden="true"></i> Home</a></li>
                        <li class=""><a href="answer.php"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Answer</a></li>
                        <li class=""><a href="notification.php"><i class="fa fa-bell-o" aria-hidden="true"></i>Notifications</a></li>

                    </ul>
                    <form class="navbar-form navbar-left">
                        <div class="form-group">
                            <input type="text" id="search_qus" class="form-control" placeholder="Search">
                        </div>
                    </form>
                    <ul class="nav navbar-nav">

                        <li class="dropdown">
                            </a>
                            <ul class="dropdown-menu">
                            </ul>
                        </li>
                        <li class=""><a href="login.php" style="color:Black;" class="quesion">SignUp</a></li>
                    </ul>



                </div>
            </div>
        </nav>



        <div class="container pt-100">
            <div class="row" id="search_list">
                <div class="col-sm-2 left-side">
                    <ul class="list-unstyled">
                    <?php
                        include("php/dbconnect.php");
                        $sql_f="SELECT DISTINCT category_id FROM user_category";
                        $query_f=mysqli_query($con, $sql_f);
                        while($row_f=mysqli_fetch_array($query_f)){
                            $category_id=$row_f["category_id"];
                            $sql_c="SELECT category_name FROM category WHERE category_id='$category_id'";
                            $query_c=mysqli_query($con, $sql_c);
                            while($row_c=mysqli_fetch_array($query_c)){
                    ?>
                        <li><a href="feed.php?category_id=<?php echo $category_id; ?>"class="active"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;<?php echo $row_c["category_name"]; ?></a></li>
                    <?php
                            } 
                        }
                    ?>
                    </ul>
                </div>
                <div class="col-sm-6">
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
                                <a href="other-user-profile.php?profile_id=<?php echo $row2["user_id"]; ?>"><h5 class="media-heading"><?php echo $row2["user_name"];?></a> <small><i><?php echo $row2["user_location"]; ?></i></small>
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
                                                <a href="other-user-profile.php?profile_id=<?php echo $row4["user_id"]; ?>"><h5 class="media-heading"><?php echo $row4["user_name"]; ?></a></h5>
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
                </div>
                <div class="col-sm-2">

                </div>
            </div>
        </div>


        <script>
            $('#search_qus').keyup(function(){  
                var query = $(this).val();  
                if(query != '')  
                {  
                    $.ajax({  
                            url:"php/showing_question.php",  
                            method:"POST",  
                            data:{query:query},  
                            success:function(data)  
                            {  
                                $('#search_list').fadeIn();
                                $('#search_list').html(data);  
                            }  
                    });  
                }
            });
        </script>
    </body>
</html>
