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
                        <a class="navbar-brand" href="dashboard.php"><i class="glyphicon glyphicon-user"></i> Admin</a>
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
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1 pt-20">
                            <div class="table-responsive">
                                <h3 class="mb-30">All Post</h3>
                                <h4 class="mb-30">This rank is been created based on Question Upvote</h4>
                                <table id="example" class="table table-striped">
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
                                    <tbody>
                                    <?php
                                        $sql_qlist="SELECT * FROM question ORDER BY question_upvote DESC";
                                        $query_qlist=mysqli_query($con, $sql_qlist);
                                        $i=0;
                                        while($row_qlist=mysqli_fetch_array($query_qlist)){
                                            $user_qid=$row_qlist["user_id"];
                                            $i++;
                                            $sql_Qmem="SELECT user_name FROM user WHERE user_id='$user_qid'";
                                            $query_Qmem=mysqli_query($con,$sql_Qmem);
                                            $row_Qmem=mysqli_fetch_array($query_Qmem);
                                    ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $row_Qmem["user_name"]; ?></td>
                                            <td><?php echo $row_qlist["question_title"]; ?></td>
                                            <td><?php echo $row_qlist["question_upvote"]; ?></td>
                                            <td><?php echo $row_qlist["question_downvote"]; ?></td>
                                            <td><button class="btn btn-primary" style="margin-top:10px;margin-left:120px;" data-toggle="modal" data-target="#viewquestion<?php echo $i; ?>">View Post</button></td>
                                        </tr>
                                    <!--Modal-->
                                    <div class="modal fade" id="viewquestion<?php echo $i; ?>" role="dialog">
                                        <div class="modal-dialog" style="width:500px;">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <label><?php echo $row_qlist["question_title"]; ?></label>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <img src="img/bloom-blooming-blossom-blur-462118.jpg" class="img-responsive" alt=""/>
                                                        <p><?php echo $row_qlist["question_body"]; ?></p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="php/delete_q&a.php?question_id=<?php echo $row_qlist["question_id"]; ?>"><button class="btn btn-danger">Delete</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Modal End-->
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        
        <script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="js/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                $('#example').DataTable({
                    "ordering":false,
                    "pageLength": 5,
                    "bLengthChange":false
                });
                $('.input-sm').keyup(function(){  
                    var query= $(this).val();  
                    if(query != '')  
                    {  
                        $.ajax({  
                                url:"php/admin_search.php",  
                                method:"POST",  
                                data:{query_q:query},  
                                success:function(data)  
                                {  
                                    $('#example').html(data);  
                                }  
                        });  
                    }
                });

            });

        </script>
    </body>
</html>
