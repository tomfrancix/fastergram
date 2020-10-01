<?php  include "includes/db.php"; ?>
<?php include "functions.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Vortex</title>

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

<body style="height:100vh;overflow:hidden;width:100vw;overflow-x:hidden;margin-top:0;margin-bottom:0;background-image:url('images/loginbackground.jpg');background-size:cover;background-position:center;background-repeat:no-repeat;">
     <div class="nav-wrapper" style="height:20px;width:100%;margin:0;">
     <nav class="navbar navbar-inverse navbar-fixed-top" style="position:fixed;top:0;width:100%;margin:0;background-color:rgba(09,58,57,1);">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a type="button" onclick="location.href='login.php'" class="navbar-toggle" style="padding:6px 5px;border:none;color:grey">
                    Login
                    
                </a>
                <a class="navbar-brand" href="index.php">Vortex</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    
                    <?php
                    
                    $query = "SELECT * FROM sections";
                    $select_all_sections_query = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($select_all_sections_query)) {
                        $section_title = $row['section_title'];
                        
                        echo "<li><a href='#'>{$section_title}</a></li>";
                    }
                    
                    ?>
                    
                    <li>
                        <a href="#">Profile</a>
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
         
<?php 
         
if(isset($_POST['submit'])) {
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if(!empty($username) && !empty($email) && !empty($password)) {
    
    $username = mysqli_real_escape_string($connection, $username);
    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);
    
        
    $query = "SELECT randSalt FROM users";
    $select_randsalt_query = mysqli_query($connection, $query);
    if(!$select_randsalt_query) {
        die("QUERY FAILED." . mysqli_error($connection));
    } else {
    
    $row = mysqli_fetch_array($select_randsalt_query);  
    $salt = $row['randSalt'];
    
    $password = crypt($password, $salt);
        
      $query = "INSERT INTO users (username, email, password, role) ";
      $query .= "VALUES('{$username}','{$email}','{$password}','Subscriber' )";
      $register_user_query = mysqli_query($connection, $query);
      if(!$register_user_query) {
          die("QUERY FAILED." . mysqli_error($connection) . ' ' . mysqli_errno($connection));
      }
        
    $message = $password . "Your Registration has been submitted";
    }
        
    } else {
         $message = "You must enter your details to proceed";
    }
} else {
    $message = "";
}
         
         ?>

    <div class="container" style="text-align:center;">
         <div class="row" style="margin-top:10vh;margin-bottom:10vh;">
            <h1 STYLE="COLOR:RGBA(09,58,57,1);"><b>VORTEX</b></h1>
        </div>
        <div class="row">
            <form role="form" action="signup.php" method="post" id="login-form" autocomplete="off" >
                <fieldset class="fieldset" style="background-color:rgba(255,54,0,0.5);">
                    <legend>Register</legend>
                    <div class="panel panel-default" style="text-align:left;">
						<div class="panel-body">
                            <div style="text-align:center;"><span style="color:orangered;font-weight:bold;font-size:10pt;"><?php echo $message; ?> </span></div>
                            
                            <fieldset class="fieldset" style="background-color:white;padding:0;">
                                <legend style="border:none;width:auto;">Email</legend>
                                        <input type="email" id="email" name="email" style="border:none;max-width:100%;min-width:100%;margin:0;">
                                  
                            </fieldset>
                            <br>
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
                            <input class="btn btn-primary" id="btn-login" name="submit" type="submit" value="Sign Up" style="float:right;background-color:rgba(09,58,57,1);">
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