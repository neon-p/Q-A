<!Doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SignUp</title>
        <link rel="icon" type="image/x-icon" href="img/">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link href="css/style.css" rel="stylesheet" type="text/css"/>

        <script>
            function validate_email(){
                var emails=document.getElementById("signup_email").value;
                if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(emails)){
                    return(true);
                }else{
                    alert("You have entered an invalid email address!"); 
                    document.getElementById("signup_email").value="";
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
                        <div class="signup">
                            <h2 class="text-center mb-15">Sign Up </h2>
                            <form class="pt-15" action="php/signup.php" method="post">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Name:</label>
                                        <input type="text" name="name" class="form-control" placeholder="First Name" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Email :</label>
                                        <input id="signup_email" type="email" name="email" class="form-control" placeholder="Email" onchange="validate_email()" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Password :</label>
                                        <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="submit" name="register" class="form-control btn btn-primary" value="Sign Up">
                                    </div>
                                </div>
                            </form>
                            <div class="text-center pt-15">
                                <p>Already have an account ?</p>
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
