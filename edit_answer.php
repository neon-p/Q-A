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


        <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
        <link rel="icon" type="image/x-icon" href="img/">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-tagsinput.css">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
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
                        $sql="SELECT `user_name`, `user_email`, `user_work`, `user_qualification`, `user_location`,`image` FROM `user` WHERE user_id='$user_id'";
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
            <div class="row" id="search_list">
                <div class="col-sm-7">
                    <?php
                        if(isset($_GET["question_id"]) && isset($_GET["answer_id"])){
                            $answer_id=$_GET["answer_id"];
                            $q_id=$_GET["question_id"];
                            $sql1="SELECT * FROM question WHERE question_id='$q_id'";//retrive question details from database
                            $query1=mysqli_query($con, $sql1);

                            $row1=mysqli_fetch_array($query1);
                            $user_id_qus=$row1["user_id"];
                            $question_id=$row1["question_id"];

                            $question_full=$row1["question_body"];
                            $question_cut=substr($question_full,0,307);
                            $question_remain=substr($question_full,307,strlen($question_full));

                            $sql2="SELECT * FROM user WHERE user_id='$user_id_qus'";//retrive user image,name for question
                            $query2=mysqli_query($con, $sql2);
                            $row2=mysqli_fetch_array($query2);

                            $sql3="SELECT * FROM answer WHERE question_id='$question_id' ORDER BY answer_id DESC";//retrive comment details of this question
                            $query3=mysqli_query($con, $sql3);
                            $row3_count=mysqli_num_rows($query3);

                            $i=0;
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
                            <p><?php echo $question_cut; ?><span id="dots" style="display:inline;">...<button onclick="readFunction()">See more</button></span><span id="more" style="display:none;"><?php echo $question_remain; ?></span></p>
                        </div>
                        <?php
                            if($user_id_qus==$user_id){
                                echo '<a href="edit_question.php?question_id='.$question_id.'" style="padding-left:512px;"><button title="Edit Question" ><i class="fa fa-edit" aria-hidden="true"></i> <span>Edit Question</span></button></a>';
                            }
                        ?>
                        <div class="react pt-10">
                                <i class="fa fa-arrow-up" aria-hidden="true"></i> <span> <?php echo $row1["question_upvote"];?></span>&nbsp;&nbsp;
                                <i class="fa fa-arrow-down" aria-hidden="true"></i><span> <?php echo $row1["question_downvote"];?></span>&nbsp;&nbsp;
                                <i class="fa fa-comment-o" aria-hidden="true"></i> <span> <?php echo $row3_count;?></span>
                                <br>
                                <br>
                            <br>
                            <input type="hidden" value="<?php echo $q_id; ?>" id="question_id">
                            <div class="row">
                                <?php
                                    while($row3=mysqli_fetch_array($query3)){
                                        $i++;
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
                                    <br>

                                    <div>
                                        <div class="comment mb-15">
                                            <?php
                                                if($row3["answer_id"]==$answer_id){
                                                    echo '<form action="php/edit_profile.php" method="post">';
                                                        echo '<textarea rows="4" class="form-control" name="ans_body" require>'.$row3["answer"].'</textarea><br>';
                                                        echo '<input type="hidden" value="'.$q_id.'" name="question_id_editA">';
                                                        echo '<input type="hidden" value="'.$answer_id.'" name="answer_id_editA">';
                                                        echo '<button type="submit" name="save_answer" class="btn btn-success">Save</button> &nbsp;';
                                                    echo '</form><br>';
                                                    echo '<a href="post_answer.php?question_id='.$q_id.'"><button title="Cancel" class="btn btn-primary">Cancel</button></a>';
                                                }else{
                                                    echo $row3["answer"];
                                                }
                                            ?>
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
                    <?php
                        }
                    ?>
                </div>
                <div class="col-sm-2">

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
            function check_code(){
                var ans=$('#answer').val();
                var ans2=strip_tags(ans);
                if (ans==ans2){
                    $('#submit_answer').prop('disabled', false);
                }else{
                    alert("Any kind of code not acceptable!");
                    $('#answer').val('');
                    $('#submit_answer').prop('disabled', true);
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
            $('#upvote').click(function(){
                var qus_id_u=$('#question_id').val();
                $.ajax({
                    type: 'post',
                    url: 'php/vote.php',
                    data: {
                    qus_id_u:qus_id_u},
                    success: function (html) {
                        location.href="post_answer.php?question_id="+qus_id_u+"";
                    }
                });
            });
            $('#downvote').click(function(){
                var qus_id_d=$('#question_id').val();
                $.ajax({
                    type: 'post',
                    url: 'php/vote.php',
                    data: {
                    qus_id_d:qus_id_d},
                    success: function (html) {
                        location.href="post_answer.php?question_id="+qus_id_d+"";
                    }
                });
            });
        </script>
    </body>
</html>
