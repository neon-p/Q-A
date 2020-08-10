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
                                <h3 class="mb-30">Members List</h3>
                                <table id="example" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Location</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $sql_mlist="SELECT * FROM user";
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
                                            <?php
                                                if($row_mlist["status"]=='Approved'){
                                                    echo '<td><a href="php/delete_q&a.php?user_id_b='.$row_mlist["user_id"].'"><button class="btn btn-danger">Banned</button></a></td>';
                                                }elseif($row_mlist["status"]=='Banned'){
                                                    echo '<td><a href="php/delete_q&a.php?user_id_a='.$row_mlist["user_id"].'"><button class="btn btn-danger">Active</button></a></td>';
                                                }
                                            ?>
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
                    "pageLength": 5,
                    "bLengthChange":false,
                    "ordering":false
                });


               
                $('.input-sm').keyup(function(){  
                    var query= $(this).val();  
                    if(query != '')  
                    {  
                        $.ajax({  
                                url:"php/admin_search.php",  
                                method:"POST",  
                                data:{query_m:query},  
                                success:function(data)  
                                {  
                                    $('#example').fadeIn();
                                    $('#example').html(data);  
                                }  
                        });  
                    }
                });
            });

        </script>
    </body>
</html>
