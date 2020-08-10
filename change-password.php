<?php
    include("php/session.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-tagsinput.css">
	<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
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

                        <?php
                            if($row['status']=='Approved'){
                                echo '<li class=""><a href="#" class="quesion"  data-toggle="modal" data-target="#addQuesion"> Add Quesion</a></li>';
                            }
                        ?>


                    </ul>



                </div>
            </div>
        </nav>
        <div class="container pt-100">
            <div class="row" id="search_list">
                <div class="col-sm-6">
                    <h3>Change Password</h3>
                    <hr>
                    
                    <form action="php/edit_profile.php" method="post">
                        <div class="form-group">
                            <label>Old Password :</label>
                            <input type="password" name="old_password" id="old_password" class="form-control" placeholder="Enter your old password" required>
                            <span><input type="checkbox" id="show_old_password"> Show Password</span>
                        </div>
                        <div class="form-group">
                            <label>New Password :</label>
                            <input type="password" name="new_password" id="new_password" class="form-control" required>
                            <span><input type="checkbox" id="show_new_password"> Show Password</span>
                        </div>
                         <div class="form-group">
                            <label>Confirm New Password :</label>
                            <input type="password" name="con_password" id="con_password" class="form-control" required>
                            <span><input type="checkbox" id="show_con_password"> Show Password</span>
                        </div>
                         <div class="form-group" id="tag">
                             <input type="submit" class="btn btn-danger btn-block" id="submit_btn" name="submit_user_password">
                        </div>                   
                    </form>
                </div>
                
            </div>
        </div>

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
        
</body>
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
    $("#new_password").change(function () {
        var x = document.getElementById("new_password").value;
        if (x.length <= 8) {
            document.getElementById("new_password").value=null;
            alert("Password must be 8 Characters!");
        }
    });
    $("#submit_btn").mouseover(function () {
        var new_password=document.getElementById("new_password").value;
        var con_password=document.getElementById("con_password").value;

        if(new_password!=con_password){
            alert("New Password Doesn't match! Try again!");
            document.getElementById("new_password").value=null;
            document.getElementById("con_password").value=null;
        }
    });
    $("#show_old_password").click(function () {
        var x = document.getElementById("old_password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    });
    $("#show_new_password").click(function () {
        var x = document.getElementById("new_password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    });
    $("#show_con_password").click(function () {
        var x = document.getElementById("con_password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    });
</script>
