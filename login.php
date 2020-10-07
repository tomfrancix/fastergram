
<?php include "functions.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Fastergram</title>

    <!-- Bootstrap Core CSS -->
<!--    <link href="./css/bootstrap.min.css" rel="stylesheet">-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link href="./css/blog-home.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body style="height:100vh;width:100vw;overflow-x:hidden;margin-top:0;background-image:url('images/loginbackground.jpg');background-size:cover;background-position:center;background-repeat:no-repeat;">
     <div class="nav-wrapper" style="height:10px;width:100%;margin:0;">
     
    <div class="container" style="text-align:center;">
         <div class="row" style="margin-top:-40px;margin-bottom:5px;">
            <h1 style="font-family: 'Parisienne', cursive;color:white;padding-bottom:10px;"><b>Fastergram</b></h1>
             <p style="color:white;padding:5px 10px;background-color:rgba(20,20,20,0.7);">This is meant for mobile. If you are using a computer, right click, press 'Inspect', then click the small mobile icon in the top corner.</p>
        </div>
        <div class="row">
            <form action="includes/login.php" method="post" >
                <fieldset class="fieldset" style="background-color:rgba(09,58,57,0.5);">
                    <legend>Login</legend>
                    <div class="panel panel-default" style="text-align:left;">
						<div class="panel-body">
                    <div style="text-align:right;">
                        <a type="button" href="signup.php"  style="padding:6px 5px;border:none;color:grey">Sign up <span class="glyphicon glyphicon-arrow-right fs-small" style="font-size:10pt;"> </span></a>
                            </div><br>
                            <fieldset class="fieldset" style="background-color:white;padding:0;">
                                <legend style="border:none;width:auto;">Username</legend>
                                        <input type="text" id="username" name="username" style="border:none;max-width:100%;min-width:100%;margin:0;">
                                  
                            </fieldset>
                            <br>
                            <fieldset class="fieldset" style="background-color:white;padding:0;">
                                <legend style="border:none;width:auto;">Password</legend>
                                        <input type="password" id="key" name="password" style="border:none;max-width:100%;min-width:100%;margin:0;">
                            </fieldset>
                            <br>
                            <input class="btn btn-primary" name="login" type="submit" value="Login" style="float:right;background-color:rgba(09,58,57,1);">
						</div>
					</div>
                    
                </fieldset>
				<div class="clearfix"></div>
            </form>
        </div>
    </div>


        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12" style="text-align:center;position:fixed; bottom:0;width:100%;">
                    <p style="text-align:center;">Copyright &copy; Thomas Fahey 2014</p>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </footer>
    </div>

    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>