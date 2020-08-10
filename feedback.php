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
                <h3>Feedback</h3>
                    <div class="bg-white p-10 mb-15">
                        <div class="media">
                            <div class="media-left">
                                <img src="img/<?php echo $row["image"];?>" class="img-circle pro-pic">
                            </div>
                            <div class="media-body">
                                <a href="other-user-profile.php?profile_id=<?php echo $row["user_id"]; ?>"><h5 class="media-heading"><?php echo $row["user_name"];?></a> <small><i><?php echo $row["user_location"]; ?></i></small>
                                    <br>
                                    <h6><?php echo $row["user_work"]; ?>, <?php echo $row["user_qualification"]; ?></h6>
                                </h5>
                            </div>

                        </div> 
                        <div class="post">
                            <form action="php/edit_profile.php" method="post">
                                <label>Message</label>
                                <textarea rows="8" class="form-control" name="m_body" require></textarea>
                                <br>
                                <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
                                <button type="submit" name="send_feedback" class="btn btn-success">Send</button>
                            </form>
                        </div>
                    </div>
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
        </script>
    </body>
</html>
