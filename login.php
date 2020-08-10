<!Doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login</title>
        <link rel="icon" type="image/x-icon" href="img/">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script>
            function validate_email(){
                var email=document.getElementById("signin_email").value;
                if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)){
                    return (true);
                }else{
                    alert("You have entered an invalid email address!");
                    document.getElementById("signin_email").value="";
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
                        <div>
                            <h2 class="text-center mb-15">Login </h2>

                            <form class="pt-15" action="php/signin.php" method="post">
                                <div class="input-group form-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="signin_email" type="text" class="form-control" name="email" placeholder="Email" onchange="validate_email()" required>
                                </div>
                                <div class="input-group form-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="login" class="btn btn-success form-control" value="Login">
                                </div>
                            </form>
                            <div class="col-sm-6">
                                <h4>Have not account yet ?</h4>
                                <a href="signup.php">Sign up</a>
                            </div>
                            <div class="col-sm-6">
                                <h4>Forget Password ?</h4>
                                <a href="forget_pass.php">Forget Pass</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </div>
    </body>
</html>
