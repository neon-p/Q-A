<?php
    include("php/session.php");
?>
<!Doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Home</title>


        <link rel="icon" type="image/x-icon" href="img/">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-tagsinput.css">
        <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script src="js/bootstrap-typeahead.min.js"></script>
        <script src="js/bootstrap-tagsinput.js"></script>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>

    </head>
    <body class="bg-white">

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
                        <li class=""><a href="index.php"><i class="fa fa-book" aria-hidden="true"></i> Home</a></li>
                        <li class=""><a href="answer.php"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Answer</a></li>
                        <li class=""><a href="notification.php"><i class="fa fa-bell-o" aria-hidden="true"></i>Notifications</a></li>

                    </ul>
                    <form class="navbar-form navbar-left" action="/action_page.php">
                        <div class="form-group">
                            <input type="text" id="search_qus" class="form-control" placeholder="Search">
                        </div>

                    </form>
                    <?php 
                        include("php/showing_tags.php");
                        $user_id=$_SESSION['user_id'];
                        $sql="SELECT * FROM `user` WHERE user_id='$user_id'";
                        $query=mysqli_query($con, $sql);
                        $row=mysqli_fetch_array($query);
                    ?>
                    <ul class="nav navbar-nav">

                        <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><img src="img/<?php echo $row["image"];?>" class="img-responsive img-circle pro-pic" alt=""/>  
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="profile.php" class="username"> <img src="img/<?php echo $row["image"];?>" class="img-responsive img-circle pro-pic"><?php echo $row['user_name'];?></a></li>
                                <li class="divider"></li>
                                <li><a href="change-password.php">Change Password</a></li>
                                <li><a href="logout.php">Logout</a></li>

                            </ul>
                        </li>

                        <li class=""><a href="#" class="quesion"  data-toggle="modal" data-target="#addQuesion"> Add Quesion</a></li>


                    </ul>



                </div>
            </div>
        </nav>



        <div class="container pt-100">
        <?php
            if(isset($_GET["profile_id"])){
                $profile_id=$_GET["profile_id"];
                if($profile_id==$user_id){
                    header("location:profile.php");
                }else{
                    $sql_profile="SELECT * FROM `user` WHERE user_id='$profile_id'";
                    $query_profile=mysqli_query($con, $sql_profile);
                    $row_profile=mysqli_fetch_array($query_profile);
        ?>
            <div class="row" id="search_list">
              
                <div class="col-sm-8">
                    <div class="status bg-white p-10 mb-15">
                        <div class="row">
                             <div class="media">
                                <div class="media-left">
                                    <img src="img/<?php echo $row_profile["image"]; ?>" class="media-object img-circle" width="100px">
                                </div>
                                <div class="media-body">
                                    <h3 class="media-heading mb-15"><?php echo $row_profile["user_name"];?></h3>
                                    <br>
                                    <p>Once a teacher, always a teacher - even when retired!</p>
                                </div>
                            </div>
                        </div>  

                    </div>
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#ask">Ask</a></li>
                        <li><a data-toggle="tab" href="#answer">Answer</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="ask" class="tab-pane fade in active">
                        <?php
                            $sql_qus="SELECT * FROM question WHERE user_id='$profile_id'";//retrive question details from database
                            $query_qus=mysqli_query($con, $sql_qus);
                            $i=0;
                            while($row_qus=mysqli_fetch_array($query_qus)){
                                $i++;
                                $s="demo";
                                $user_id_qus=$row_qus["user_id"];
                                $question_id=$row_qus["question_id"];

                                $question_full=$row_qus["question_body"];
                                $question_cut=substr($question_full,0,300);
                                $question_remain=substr($question_full,300,strlen($question_full));

                                $sql_ans="SELECT * FROM answer WHERE question_id='$question_id'";//retrive comment details of this question
                                $query_ans=mysqli_query($con, $sql_ans);
                                $row_ans_count=mysqli_num_rows($query_ans);
                        ?>
                            <div class="post">
                                <h4><strong><?php echo $row_qus["question_title"];?></strong></h4>
                                <img src="img/bloom-blooming-blossom-blur-462118.jpg" class="img-responsive" alt=""/>
                                <p><?php echo $question_cut; ?><span id="dots<?php echo $i; ?>">...<button onclick="readFunction<?php echo $i; ?>()">See more</button></span><span id="more<?php echo $i; ?>" style="display:none;"><?php echo $question_remain; ?></span></p>
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
                            <?php
                                if($row["status"]=='Banned'){
                                    echo '<br><h4 class="pt-5" style="padding-left:7px;">You temporary Banned!</h4>';
                                }elseif($row["status"]=='Approved'){
                            ?>
                            <a href="post_answer.php?question_id=<?php echo $question_id; ?>" style="padding-left:605px;"><button title="Post Answer" ><i class="fa fa-paper-plane" aria-hidden="true"></i> <span> Post Your Answer</span></button></a>
                            <?php
                                }
                            ?>
                            <div class="react pt-10">
                                <?php
                                    $sql_upvt="SELECT SUM(question_upvote) AS question_upvote FROM question_vote WHERE question_id='$question_id'";
                                    $query_upvt=mysqli_query($con,$sql_upvt);
                                    $row_upvt=mysqli_fetch_assoc($query_upvt);

                                    $sql_dwvt="SELECT SUM(question_downvote) AS question_downvote FROM question_vote WHERE question_id='$question_id'";
                                    $query_dwvt=mysqli_query($con,$sql_dwvt);
                                    $row_dwvt=mysqli_fetch_assoc($query_dwvt);
                                ?>
                                <i class="fa fa-arrow-up" aria-hidden="true"></i> <span> <?php echo $row_upvt["question_upvote"];?></span>&nbsp;&nbsp;
                                <i class="fa fa-arrow-down" aria-hidden="true"></i> <span> <?php echo $row_dwvt["question_downvote"];?></span>
                                <br><br>
                                <button title="Comments" data-toggle="collapse" data-target="#<?php echo $s.$i; ?>">
                                    <i class="fa fa-comment-o" aria-hidden="true"></i> <span> <?php echo $row_ans_count;?></span>
                                </button>

                                <div id="<?php echo $s.$i; ?>" class="collapse">
                                <br>
                                    <div class="row" id="user_answer">
                                        <?php
                                            while($row_ans=mysqli_fetch_array($query_ans)){
                                                $user_id_ans=$row_ans["user_id"];
                                                $answer_id=$row_ans["answer_id"];
                                                $sql_ans_d="SELECT user_id,user_name,image FROM user WHERE user_id='$user_id_ans'";//retrive user image,name for comment
                                                $query_ans_d=mysqli_query($con, $sql_ans_d);
                                                $row_ans_d=mysqli_fetch_array($query_ans_d);
                                        ?>
                                        <div class="col-sm-12">
                                            <div class="media">
                                                <div class="media-left">
                                                    <img src="img/<?php echo $row_ans_d["image"]; ?>" class="img-circle pro-pic">
                                                </div>

                                                <div class="media-body">
                                                    <a href="other-user-profile.php?profile_id=<?php echo $row_ans_d["user_id"];?>"><h5 class="media-heading"><?php echo $row_ans_d["user_name"]; ?></a></h5>
                                                </div>

                                            </div> 

                                            <div>
                                                <div class="comment mb-15">
                                                    <?php echo $row_ans["answer"]; ?>
                                                </div>
                                                <?php
                                                    $sql_aupvt="SELECT SUM(answer_upvote) AS answer_upvote FROM answer_vote WHERE question_id='$question_id' AND answer_id='$answer_id'";
                                                    $query_aupvt=mysqli_query($con,$sql_aupvt);
                                                    $row_aupvt=mysqli_fetch_assoc($query_aupvt);
                
                                                    $sql_adwvt="SELECT SUM(answer_downvote) AS answer_downvote FROM answer_vote WHERE question_id='$question_id' AND answer_id='$answer_id'";
                                                    $query_adwvt=mysqli_query($con,$sql_adwvt);
                                                    $row_adwvt=mysqli_fetch_assoc($query_adwvt);
                                                ?>
                                                <i class="fa fa-arrow-up" aria-hidden="true"></i><span> <?php echo $row_aupvt["answer_upvote"]; ?></span>&nbsp;&nbsp;
                                                <i class="fa fa-arrow-down" aria-hidden="true"></i><span> <?php echo $row_adwvt["answer_downvote"]; ?></span>
                                            </div>
                                            <br>
                                        </div>
                                        <?php 
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <?php
                                }
                            ?>
                        </div>
                        <div id="answer" class="tab-pane fade">
                        <?php
                            $i=0;
                            $sql_ans="SELECT DISTINCT question_id FROM answer WHERE user_id='$profile_id'";
                            $query_ans=mysqli_query($con, $sql_ans);

                            if(mysqli_num_rows($query_ans)==0){
                                // echo '<div class="post">';
                                // echo    '<h5>None of answer Yet</h5>';
                                // echo '</div>';
                                // echo '<script language="javascript">';
                                // echo 'alert("Please Try again!")';
                                // echo '</script>';
                            }else{
                                while($row_ans=mysqli_fetch_array($query_ans)){
                                    $question_id=$row_ans["question_id"];

                                    $sql_qus="SELECT question_id,question_title FROM question WHERE question_id='$question_id' and user_id!='$profile_id'";
                                    $query_qus=mysqli_query($con, $sql_qus);
                                    while($row_qus=mysqli_fetch_array($query_qus)){
                        ?>
                        <div class="post">
                            <h4><strong><?php echo $row_qus["question_title"]; ?></h4></strong>
                        </div>
                        <div class="react pt-10">
                        <?php
                            if($row["status"]=='Banned'){
                                echo '<br><h4 class="pt-5" style="padding-left:7px;">You temporary Banned!</h4>';
                            }elseif($row["status"]=='Approved'){
                        ?>
                        <a href="post_answer.php?question_id=<?php echo $row_qus["question_id"]; ?>" style=""><button title="Post Answer" ><i class="fa fa-paper-plane" aria-hidden="true"></i> <span> View Post</span></button></a>
                        <?php
                            }
                        ?>
                        </div>
                        <hr>
                        <?php
                                    }
                                }
                            }
                        ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                <h3>Credentials & Highlights &nbsp; &nbsp;</h3>
                    <hr>
                    <p><i class="fa fa-briefcase" aria-hidden="true"></i> <span><?php echo $row_profile["user_work"]; ?></span> </p>
                    <p><i class="fa fa-graduation-cap" aria-hidden="true"></i> <span><?php echo $row_profile["user_qualification"]; ?></span> </p>
                    <p><i class="fa fa-map-marker" aria-hidden="true"></i> <span> <?php echo $row_profile["user_location"]; ?></span> </p>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="addQuesion" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Add Quesion</h4>
                            </div>
                            <form method="post" action="php/inserting_qus.php">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" id="qus_title" name="qus_title" class="form-control" require>
                                    </div>
                                    <div class="form-group">
                                        <label>Body</label>
                                        <textarea rows="8" class="form-control" id="qus_body" name="qus_body" require></textarea>
                                    </div>
                                    <div class="bootstrap-tagsinput">
                                        <label>Add Tags:</label><br/>
                                        <input type="text" id="qus_tags" name="qus_tags" value="" data-role="tagsinput" placeholder="Add a tag"/>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" id="submit_qus_btn" name="submit_qus_btn" class="btn btn-success">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                    }
                }
            ?>
        </div>

        <script>
            function readFunction() {
                var dots = document.getElementById("dots");
                var moreText = document.getElementById("more");


                if (dots.style.display === "none") {
                    dots.style.display = "inline";

                    moreText.style.display = "none";
                } else {
                    dots.style.display = "none";

                    moreText.style.display = "inline";
                }
            }
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
            $('#qus_body').change( function(){
                var q_t=$('#qus_title').val();
                var q_b=$('#qus_body').val();
                var q_t2=strip_tags(q_t);
                var q_b2=strip_tags(q_b);
                if (q_t==q_t2 && q_b==q_b2){
                    $('#submit_qus_btn').prop('disabled', false);
                }else if(q_t!=q_t2){
                    alert("Any kind of code not acceptable!");
                    $('#qus_title').val('');
                    $('#submit_qus_btn').prop('disabled', true);
                }else if(q_b!=q_b2){
                    alert("Any kind of code not acceptable!");
                    $('#qus_body').val('');
                    $('#submit_qus_btn').prop('disabled', true);
                }
            });
            function strip_tags(str){
                var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi;
                var commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
                return str.replace(commentsAndPhpTags, '').replace(tags, '');
            }
            $('#qus_tags').tagsinput({
                itemValue: 'category_id',
                itemText: 'category_name',
                typeahead: {
                    displayKey:'category_name',
                    valueKey:'category_id',
                    source: function(query) {
                        return $.getJSON('js/tags.json');
                    },
                    afterSelect: function(val) { 
                        this.$element.val("");
                        this.tagsinput('add', val); 
                    }
                },
                freeInput: false
            });
        </script>
    </body>
</html>
