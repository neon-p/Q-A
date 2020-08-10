<!Doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Forget Password</title>
        <link rel="icon" type="image/x-icon" href="img/">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script>
            function validate_email(){
                var emaild=document.getElementById("fp_email").value;
                if( /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(emaild)){
                    return (true);
                }else{
                    alert("You have entered an invalid email address!");
                    document.getElementById("fp_email").value="";
                    return (false);
                }
            }

        </script>
    </head>
    <body>
        <div class="container pt-100">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <div class="jumbotron">
                        <div id="forgot_pass">
                            <h2 class="text-center mb-15">Forget Password</h2>
                            <form class="pt-15" action="php/signup.php" method="post">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Email :</label>
                                        <input id="fp_email" type="email" name="email" class="form-control" placeholder="Email" onblur="validate_email()" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="submit" name="submit_email" class="form-control btn btn-primary" value="Submit">
                                    </div>
                                </div>
                            </form>
                            <div class="text-center pt-15">
                                <a href="login.php" class="login">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </div>
    </body>
</html>
