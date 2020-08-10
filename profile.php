<?php
    include("php/session.php");
?>
<!Doctype html>
<html class="no-js" lang="en">
     <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Profile</title>
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
    <body style="background: #fff;">

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
                            <a class="dropdown-toggle" title="<?php echo $row['user_name'];?>" data-toggle="dropdown" href="#"><img src="img/<?php echo $row["image"];?>" class="img-responsive img-circle pro-pic" alt="<?php echo $row['user_name'];?>"/>  
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
                <div class="col-sm-8">
                    <div class="row mb-15">
                        <div class="col-sm-3"><img src="img/<?php echo $row['image']; ?>" class="img-responsive img-circle"></div>
                        <div class="col-sm-2" style="margin-top:140px;"><button type="button" class="btn btn-default" data-toggle="modal" style="padding:0.5px 5px;" data-target="#edit_image"><i class="fa fa-pencil" aria-hidden="true"></i></button></div>
                        <div class="col-sm-10 pt-10"><h2><?php echo $row['user_name'];?></h2></div>
                        <div class="col-sm-12">

                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-sm-10">

                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#ask">Ask</a></li>
                                <li><a data-toggle="tab" href="#answer">Answer</a></li>
                            </ul>

                            <div class="tab-content">
                                <div id="ask" class="tab-pane fade in active">
                                <?php
                                    $sql_qus="SELECT * FROM question WHERE user_id='$user_id'";//retrive question details from database
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
                                    <a href="post_answer.php?question_id=<?php echo $question_id; ?>" style="padding-left:473px;"><button title="Post Answer" ><i class="fa fa-paper-plane" aria-hidden="true"></i> <span> Post Your Answer</span></button></a>
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
                                    $sql_ans="SELECT DISTINCT question_id FROM answer WHERE user_id='$user_id'";
                                    $query_ans=mysqli_query($con, $sql_ans);

                                    if(mysqli_num_rows($query_ans)==0){

                                    }else{
                                        while($row_ans=mysqli_fetch_array($query_ans)){
                                            $question_id=$row_ans["question_id"];

                                            $sql_qus="SELECT question_title,question_id FROM question WHERE question_id='$question_id' and user_id!='$user_id'";
                                            $query_qus=mysqli_query($con, $sql_qus);
                                            while($row_qus=mysqli_fetch_array($query_qus)){
                                ?>
                                <div class="post">
                                <h4><strong><?php echo $row_qus["question_title"];?></strong></h4>
                                </div>
                                <div class="react pt-10">

                                <a href="post_answer.php?question_id=<?php echo $row_qus["question_id"]; ?>" style=""><button title="Post Answer" ><i class="fa fa-paper-plane" aria-hidden="true"></i> <span> View Post</span></button></a>
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
                    </div>
                </div>
                <div class="col-sm-4">
                    <h3>Credentials & Highlights &nbsp; &nbsp; <button type="button" class="btn btn-default" data-toggle="modal" data-target="#addInfo"><i class="fa fa-pencil" aria-hidden="true"></i></button></h3>
                    <hr>
                    <p><i class="fa fa-envelope" aria-hidden="true"></i> <span> <?php echo $row["user_email"];?></span> </p>
                    <p><i class="fa fa-briefcase" aria-hidden="true"></i> <span> <?php echo $row["user_work"];?></span> </p>
                    <p><i class="fa fa-graduation-cap" aria-hidden="true"></i> <span><?php echo $row["user_qualification"];?></span> </p>
                    <p><i class="fa fa-map-marker" aria-hidden="true"></i> <span> <?php echo $row["user_location"];?></span> </p>
                    <!-- Modal -->
                    <div id="addInfo" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Edit Credential</h4>

                                </div>
                                <div class="modal-body">
                                    <div class="full-body">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" data-toggle="dropdown" href="#"> Add Profile credential 
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li class="divider"></li>
                                                <li><a href="#" class="aem"><i class="fa fa-suitcase"></i> Employment</a></li>
                                                <li><a href="#" class="aed"><i class="fa fa-graduation-cap"></i> Education</a></li>
                                                <li><a href="#" class="aloc"><i class="fa fa-map-marker"></i> Location</a></li>

                                            </ul>
                                        </div>
                                        <hr>
                                        <div class="view-name">
                                            <h5><i class="fa fa-user"></i> <?php echo $row["user_name"];?> &diams; <a href="#" class="en">Edit</a> </h5>
                                            <hr>
                                        </div>
                                        <div class="edit-name" style="display: none">
                                            <h4><i class="fa fa-user"></i> Edit Name </h4>
                                            <form class="form-horizontal" action="php/edit_profile.php" method="post">
                                                <div class="form-group">
                                                    <label class="col-sm-5">Name </label>
                                                    <div class="col-sm-7">
                                                        <input class="form-control" type="text" name="user_name">
                                                    </div>
                                                </div>
                                                <div class="form-group">

                                                    <div class="col-sm-12 text-right">
                                                        <ul class="list-unstyled list-inline">
                                                            <li><a href="#" class="cen">Cancel</a></li>
                                                            <li><input type="submit" class="btn btn-primary" name="submit_user_name" value="Save"></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="view-email">
                                            <h5><i class="fa fa-envelope"></i>  <?php echo $row["user_email"];?> &diams; <a href="#" class="eema">Edit</a> </h5>
                                            <hr>
                                        </div>
                                        <div class="edit-email" style="display: none">
                                            <h4><i class="fa fa-envelope"></i> Edit Email </h4>
                                            <form class="form-horizontal" action="php/edit_profile.php" method="post">
                                                <div class="form-group">
                                                    <label class="col-sm-5">Email </label>
                                                    <div class="col-sm-7">
                                                        <input class="form-control" type="text" name="user_email">
                                                    </div>
                                                </div>
                                                <div class="form-group">

                                                    <div class="col-sm-12 text-right">
                                                        <ul class="list-unstyled list-inline">
                                                            <li><a href="#" class="cema">Cancel</a></li>
                                                            <li><input type="submit" class="btn btn-primary" name="submit_user_email" value="Save"></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="view-employment">
                                            <h5><i class="fa fa-suitcase"></i>  <?php echo $row["user_work"];?> &diams; <a href="#" class="eem">Edit</a> </h5>
                                            <hr>
                                        </div>
                                        <div class="edit-employment" style="display: none">
                                            <h4><i class="fa fa-suitcase"></i> Edit Employment Credential </h4>
                                            <form class="form-horizontal" action="php/edit_profile.php" method="post">
                                                <div class="form-group">
                                                    <label class="col-sm-5"> Company/Organization </label>
                                                    <div class="col-sm-7">
                                                        <input class="form-control" type="text" name="user_work">
                                                    </div>
                                                </div>
                                                <div class="form-group">

                                                    <div class="col-sm-12 text-right">
                                                        <ul class="list-unstyled list-inline">
                                                            <li><a href="#" class="cem">Cancel</a></li>
                                                            <li><input type="submit" class="btn btn-primary" name="delete_user_work" value="Delete"></li>
                                                            <li><input type="submit" class="btn btn-primary" name="submit_user_work" value="Save"></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="view-edu">
                                            <h5><i class="fa fa-graduation-cap"></i> <?php echo $row["user_qualification"];?> &diams; <a href="#" class="eed">Edit</a> </h5>
                                            <hr>
                                        </div>
                                        <div class="edit-education" style="display: none">
                                            <h4><i class="fa fa-graduation-cap"></i> Edit Education Credential </h4>
                                            <br>
                                            <form class="form-horizontal" action="php/edit_profile.php" method="post">
                                                <div class="form-group">
                                                    <label class="col-sm-5"> Concentration </label>
                                                    <div class="col-sm-7">
                                                        <input class="form-control" name="user_qualification" type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group">

                                                    <div class="col-sm-12 text-right">
                                                        <ul class="list-unstyled list-inline">

                                                            <li><a href="#" class="ceed">Cancel</a></li>
                                                            <li><input type="submit" class="btn btn-primary" name="delete_user_qualification" value="Delete"></li>
                                                            <li><input type="submit" class="btn btn-primary" name="submit_user_qualification" value="Save"></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="view-loc">
                                            <h5><i class="fa fa-map-marker"></i>  <?php echo $row["user_location"];?> &diams; <a href="#" class="eloc">Edit</a> </h5>
                                            <hr>
                                        </div>
                                        <div class="edit-location" style="display: none">
                                            <h4><i class="fa fa-map-marker"></i> Edit Location Credential </h4>
                                            <br>
                                            <form class="form-horizontal" action="php/edit_profile.php" method="post">
                                                <div class="form-group">
                                                    <label class="col-sm-5"> Location</label>
                                                    <div class="col-sm-7">
                                                        <input class="form-control" name="user_location" type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group">

                                                    <div class="col-sm-12 text-right">
                                                        <ul class="list-unstyled list-inline">

                                                            <li><a href="#" class="celoc">Cancel</a></li>
                                                            <li><input type="submit" class="btn btn-primary" name="delete_user_location" value="Delete"></li>
                                                            <li><input type="submit" class="btn btn-primary" name="submit_user_location" value="Save"></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>


                                    </div>
                                    <div class="add-employment" style="display: none">
                                        <h4><i class="fa fa-suitcase"></i> Add Employment Credential </h4>
                                        <br>
                                        <form class="form-horizontal">
                                            <div class="form-group">
                                                <label class="col-sm-5"> Position</label>
                                                <div class="col-sm-7">
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-5"> Company/Organization </label>
                                                <div class="col-sm-7">
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-5"> Start </label>
                                                <div class="col-sm-7">
                                                    <select class=""><option value="">Select Year</option><option value="2020">2020</option><option value="2019">2019</option><option value="2018">2018</option><option value="2017">2017</option><option value="2016">2016</option><option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option><option value="1949">1949</option><option value="1948">1948</option><option value="1947">1947</option><option value="1946">1946</option><option value="1945">1945</option><option value="1944">1944</option><option value="1943">1943</option><option value="1942">1942</option><option value="1941">1941</option><option value="1940">1940</option><option value="1939">1939</option><option value="1938">1938</option><option value="1937">1937</option><option value="1936">1936</option><option value="1935">1935</option><option value="1934">1934</option><option value="1933">1933</option><option value="1932">1932</option><option value="1931">1931</option><option value="1930">1930</option><option value="1929">1929</option><option value="1928">1928</option><option value="1927">1927</option><option value="1926">1926</option><option value="1925">1925</option><option value="1924">1924</option><option value="1923">1923</option><option value="1922">1922</option><option value="1921">1921</option><option value="1920">1920</option><option value="1919">1919</option><option value="1918">1918</option><option value="1917">1917</option><option value="1916">1916</option><option value="1915">1915</option><option value="1914">1914</option><option value="1913">1913</option><option value="1912">1912</option><option value="1911">1911</option><option value="1910">1910</option><option value="1909">1909</option><option value="1908">1908</option><option value="1907">1907</option><option value="1906">1906</option><option value="1905">1905</option><option value="1904">1904</option><option value="1903">1903</option><option value="1902">1902</option><option value="1901">1901</option><option value="1900">1900</option></select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-5"> End  </label>
                                                <div class="col-sm-7">
                                                    <select class=""><option value="">Select Year</option><option value="2020">2020</option><option value="2019">2019</option><option value="2018">2018</option><option value="2017">2017</option><option value="2016">2016</option><option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option><option value="1949">1949</option><option value="1948">1948</option><option value="1947">1947</option><option value="1946">1946</option><option value="1945">1945</option><option value="1944">1944</option><option value="1943">1943</option><option value="1942">1942</option><option value="1941">1941</option><option value="1940">1940</option><option value="1939">1939</option><option value="1938">1938</option><option value="1937">1937</option><option value="1936">1936</option><option value="1935">1935</option><option value="1934">1934</option><option value="1933">1933</option><option value="1932">1932</option><option value="1931">1931</option><option value="1930">1930</option><option value="1929">1929</option><option value="1928">1928</option><option value="1927">1927</option><option value="1926">1926</option><option value="1925">1925</option><option value="1924">1924</option><option value="1923">1923</option><option value="1922">1922</option><option value="1921">1921</option><option value="1920">1920</option><option value="1919">1919</option><option value="1918">1918</option><option value="1917">1917</option><option value="1916">1916</option><option value="1915">1915</option><option value="1914">1914</option><option value="1913">1913</option><option value="1912">1912</option><option value="1911">1911</option><option value="1910">1910</option><option value="1909">1909</option><option value="1908">1908</option><option value="1907">1907</option><option value="1906">1906</option><option value="1905">1905</option><option value="1904">1904</option><option value="1903">1903</option><option value="1902">1902</option><option value="1901">1901</option><option value="1900">1900</option></select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-5"> I'm currently working here </label>
                                                <div class="col-sm-7">
                                                    <input class="" type="checkbox">
                                                </div>
                                            </div>
                                            <div class="form-group">

                                                <div class="col-sm-12 text-right">
                                                    <ul class="list-unstyled list-inline">

                                                        <li><a href="#" class="caem">Cancel</a></li>
                                                        <li><input type="submit" class="btn btn-primary" value="Submit"></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="add-education" style="display: none">
                                        <h4><i class="fa fa-graduation-cap"></i> Add Education Credential </h4>
                                        <br>
                                        <form class="form-horizontal">
                                            <div class="form-group">
                                                <label class="col-sm-5"> School</label>
                                                <div class="col-sm-7">
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-5"> Concentration </label>
                                                <div class="col-sm-7">
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-5"> Secondary Concentration </label>
                                                <div class="col-sm-7">
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-5"> Degree Type </label>
                                                <div class="col-sm-7">
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>



                                            <div class="form-group">
                                                <label class="col-sm-5"> Graduation Year  </label>
                                                <div class="col-sm-7">

                                                    <select class=""><option value="" selected="selected"></option><option value="2026">2026</option><option value="2025">2025</option><option value="2024">2024</option><option value="2023">2023</option><option value="2022">2022</option><option value="2021">2021</option><option value="2020">2020</option><option value="2019">2019</option><option value="2018">2018</option><option value="2017">2017</option><option value="2016">2016</option><option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option><option value="1949">1949</option><option value="1948">1948</option><option value="1947">1947</option><option value="1946">1946</option><option value="1945">1945</option><option value="1944">1944</option><option value="1943">1943</option><option value="1942">1942</option><option value="1941">1941</option><option value="1940">1940</option><option value="1939">1939</option><option value="1938">1938</option><option value="1937">1937</option><option value="1936">1936</option><option value="1935">1935</option><option value="1934">1934</option><option value="1933">1933</option><option value="1932">1932</option><option value="1931">1931</option><option value="1930">1930</option><option value="1929">1929</option><option value="1928">1928</option><option value="1927">1927</option><option value="1926">1926</option><option value="1925">1925</option><option value="1924">1924</option><option value="1923">1923</option><option value="1922">1922</option><option value="1921">1921</option><option value="1920">1920</option><option value="1919">1919</option><option value="1918">1918</option><option value="1917">1917</option><option value="1916">1916</option><option value="1915">1915</option><option value="1914">1914</option><option value="1913">1913</option><option value="1912">1912</option><option value="1911">1911</option><option value="1910">1910</option><option value="1909">1909</option><option value="1908">1908</option><option value="1907">1907</option><option value="1906">1906</option><option value="1905">1905</option><option value="1904">1904</option><option value="1903">1903</option><option value="1902">1902</option><option value="1901">1901</option><option value="1900">1900</option></select>
                                                </div>
                                            </div>

                                            <div class="form-group">

                                                <div class="col-sm-12 text-right">
                                                    <ul class="list-unstyled list-inline">

                                                        <li><a href="#" class="caed">Cancel</a></li>
                                                        <li><input type="submit" class="btn btn-primary" value="Submit"></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="add-location" style="display: none">
                                        <h4><i class="fa fa-map-marker"></i> Add Location Credential </h4>
                                        <br>
                                        <form class="form-horizontal">
                                            <div class="form-group">
                                                <label class="col-sm-5"> Location</label>
                                                <div class="col-sm-7">
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-sm-5"> Start </label>
                                                <div class="col-sm-7">
                                                    <select class=""><option value="">Select Year</option><option value="2020">2020</option><option value="2019">2019</option><option value="2018">2018</option><option value="2017">2017</option><option value="2016">2016</option><option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option><option value="1949">1949</option><option value="1948">1948</option><option value="1947">1947</option><option value="1946">1946</option><option value="1945">1945</option><option value="1944">1944</option><option value="1943">1943</option><option value="1942">1942</option><option value="1941">1941</option><option value="1940">1940</option><option value="1939">1939</option><option value="1938">1938</option><option value="1937">1937</option><option value="1936">1936</option><option value="1935">1935</option><option value="1934">1934</option><option value="1933">1933</option><option value="1932">1932</option><option value="1931">1931</option><option value="1930">1930</option><option value="1929">1929</option><option value="1928">1928</option><option value="1927">1927</option><option value="1926">1926</option><option value="1925">1925</option><option value="1924">1924</option><option value="1923">1923</option><option value="1922">1922</option><option value="1921">1921</option><option value="1920">1920</option><option value="1919">1919</option><option value="1918">1918</option><option value="1917">1917</option><option value="1916">1916</option><option value="1915">1915</option><option value="1914">1914</option><option value="1913">1913</option><option value="1912">1912</option><option value="1911">1911</option><option value="1910">1910</option><option value="1909">1909</option><option value="1908">1908</option><option value="1907">1907</option><option value="1906">1906</option><option value="1905">1905</option><option value="1904">1904</option><option value="1903">1903</option><option value="1902">1902</option><option value="1901">1901</option><option value="1900">1900</option></select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-5"> End  </label>
                                                <div class="col-sm-7">
                                                    <select class=""><option value="">Select Year</option><option value="2020">2020</option><option value="2019">2019</option><option value="2018">2018</option><option value="2017">2017</option><option value="2016">2016</option><option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option><option value="1949">1949</option><option value="1948">1948</option><option value="1947">1947</option><option value="1946">1946</option><option value="1945">1945</option><option value="1944">1944</option><option value="1943">1943</option><option value="1942">1942</option><option value="1941">1941</option><option value="1940">1940</option><option value="1939">1939</option><option value="1938">1938</option><option value="1937">1937</option><option value="1936">1936</option><option value="1935">1935</option><option value="1934">1934</option><option value="1933">1933</option><option value="1932">1932</option><option value="1931">1931</option><option value="1930">1930</option><option value="1929">1929</option><option value="1928">1928</option><option value="1927">1927</option><option value="1926">1926</option><option value="1925">1925</option><option value="1924">1924</option><option value="1923">1923</option><option value="1922">1922</option><option value="1921">1921</option><option value="1920">1920</option><option value="1919">1919</option><option value="1918">1918</option><option value="1917">1917</option><option value="1916">1916</option><option value="1915">1915</option><option value="1914">1914</option><option value="1913">1913</option><option value="1912">1912</option><option value="1911">1911</option><option value="1910">1910</option><option value="1909">1909</option><option value="1908">1908</option><option value="1907">1907</option><option value="1906">1906</option><option value="1905">1905</option><option value="1904">1904</option><option value="1903">1903</option><option value="1902">1902</option><option value="1901">1901</option><option value="1900">1900</option></select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-5"> I'm currently live here </label>
                                                <div class="col-sm-7">
                                                    <input class="" type="checkbox">
                                                </div>
                                            </div>
                                            <div class="form-group">

                                                <div class="col-sm-12 text-right">
                                                    <ul class="list-unstyled list-inline">

                                                        <li><a href="#" class="caloc">Cancel</a></li>
                                                        <li><input type="submit" class="btn btn-primary" value="Submit"></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>

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

                                <!-- Modal -->
                <div class="modal fade" id="edit_image" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <form action="php/edit_profile.php" method="post" enctype="multipart/form-data">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Upload Image</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" value="<?php echo $row['image']; ?>" name="previous_file" />
                                    <input type="file" name="image_name" class="form-control"/>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="submit_user_image" class="btn btn-primary">Upload</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script>
                $(".aem").click(function () {
                    $("div.full-body").fadeOut(0);
                    $("div.add-employment").fadeIn(0);


                });

                $(".caem").click(function () {
                    $("div.full-body").fadeIn(0);
                    $("div.add-employment").fadeOut(0);


                });
                $(".aed").click(function () {
                    $("div.full-body").fadeOut(0);
                    $("div.add-education").fadeIn(0);


                });
                $(".caed").click(function () {
                    $("div.full-body").fadeIn(0);
                    $("div.add-education").fadeOut(0);


                });
                $(".aloc").click(function () {
                    $("div.full-body").fadeOut(0);
                    $("div.add-location").fadeIn(0);


                });
                $(".caloc").click(function () {
                    $("div.full-body").fadeIn(0);
                    $("div.add-location").fadeOut(0);


                });



                $(".en").click(function () {
                    $("div.edit-name").fadeIn(0);
                    $("div.view-name").fadeOut(0);


                });
                $(".cen").click(function () {
                    $("div.edit-name").fadeOut(0);
                    $("div.view-name").fadeIn(0);


                });
                $(".eema").click(function () {
                    $("div.edit-email").fadeIn(0);
                    $("div.view-email").fadeOut(0);


                });
                $(".cema").click(function () {
                    $("div.edit-email").fadeOut(0);
                    $("div.view-email").fadeIn(0);


                });
                $(".eem").click(function () {
                    $("div.edit-employment").fadeIn(0);
                    $("div.view-employment").fadeOut(0);


                });
                $(".cem").click(function () {
                    $("div.edit-employment").fadeOut(0);
                    $("div.view-employment").fadeIn(0);


                });

                $(".eed").click(function () {
                    $("div.edit-education").fadeIn(0);
                    $("div.view-edu").fadeOut(0);


                });
                $(".ceed").click(function () {
                    $("div.edit-education").fadeOut(0);
                    $("div.view-edu").fadeIn(0);


                });
                $(".eloc").click(function () {
                    $("div.edit-location").fadeIn(0);
                    $("div.view-loc").fadeOut(0);


                });
                $(".celoc").click(function () {
                    $("div.edit-location").fadeOut(0);
                    $("div.view-loc").fadeIn(0);


                });
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
                $("#qus_tags").tagsinput({
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
