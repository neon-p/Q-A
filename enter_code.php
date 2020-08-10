<!Doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Code</title>
        <link rel="icon" type="image/x-icon" href="img/">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <script>
            function random_code_generator()
            {
                var code=Math.floor(Math.random() * 8999 + 1000);
                $.ajax({
                    type: 'post',
                    url: 'php/sending_code.php',
                    data: {
                    code:code},
                    success: function (html) {
                        alert("We Send a Code in Your mail!");
                    },
                });
            }
        </script>

    </head>
    <body onload="random_code_generator()">
        <div class="container pt-100">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <div class="jumbotron">
                        <div id="login">
                            <h5 style="margin-left:150px;">Please enter the Code</h5>
                            <form class="pt-15" action="php/verifying_code.php" method="post">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input id="code" type="text" class="form-control" name="code" placeholder="4 digit code" required>
                                    </div>
                                </div>
                                <br><br>
                                <div class="form-group">
                                    <div class="col-sm-6" style="margin-left:110px;">
                                        <input type="submit" name="submit" class="btn btn-success form-control" value="submit">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Jquery -->
        <script src="js/jquery.js"></script>
    </body>
</html>
