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

                <div class="col-sm-2 part1" style="height: 180vh;background-color:#f8f8f8;">
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
                                <a href="members.php"><h3 class="mb-30">Member List</h3></a>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Location</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $sql_mlist="SELECT * FROM user LIMIT 5";
                                        $query_mlist=mysqli_query($con, $sql_mlist);
                                        $i=0;
                                        while($row_mlist=mysqli_fetch_array($query_mlist)){
                                            $i++;
                                    ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $row_mlist["user_name"]; ?></td>
                                            <td><?php echo $row_mlist["user_email"]; ?></td>
                                            <td><?php echo $row_mlist["user_location"]; ?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1 pt-20">
                            <div class="table-responsive">
                            <a href="all_post.php"><h3 class="mb-30">All Ask Question</h3></a>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>User Name</th>
                                            <th>Question</th>
                                            <th>Question Upvote</th>
                                            <th>Question Downvote</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $sql_qlist="SELECT * FROM question LIMIT 5";
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
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1 pt-20">
                            <div class="table-responsive">
                            <a href="category.php"><h3 class="mb-30">Category List</h3></a>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Category Name</th>
                                            <th>Category choose by user</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $sql_clist="SELECT * FROM category LIMIT 5";
                                        $query_clist=mysqli_query($con, $sql_clist);
                                        $i=0;
                                        while($row_clist=mysqli_fetch_array($query_clist)){
                                            $i++;
                                            $category_cid=$row_clist["category_id"];
                                            $sql_cat_ulike="SELECT DISTINCT category_id FROM user_category WHERE category_id='$category_cid'";
                                            $query_cat_ulike=mysqli_query($con, $sql_cat_ulike);
                                            $num_Oflike=mysqli_num_rows($query_cat_ulike);
                                    ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $row_clist["category_name"]; ?></td>
                                            <td><?php echo $num_Oflike; ?></td>
                                        </tr>
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

                });

            });

        </script>
    </body>
</html>
