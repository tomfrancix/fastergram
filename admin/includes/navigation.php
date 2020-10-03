<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color:transparent;">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header" style="text-align:center;padding:0 0 0 10px;background-color:rgba(10,10,10,1);">
                <button type="button" onclick="location.href='camera.php'" class="navbar-toggle" style="float:left;padding:5px;border:none;">
                    <span class="glyphicon glyphicon-camera" style="font-size:15pt; color:lightgrey;"></span>
                </button>
<?php if(isset($_SESSION['username'])) {

$dbusername = $_SESSION['username']; ?>
<a   class="navbar-brand" href="index.php" style="font-family: 'Parisienne', cursive;font-size:18pt;text-align:center;color:white;display:inline-block;float:none;">@<?php echo $dbusername; ?></a> <?php
} ?>
              
                 
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse" style="background-color:rgba(10,10,10,1);float:right;border:none;">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- Top Menu Items -->
            
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse" style="padding:40px;margin-top:0px;">
                <ul class="nav navbar-nav side-nav" style="background-color:rgba(20,20,20,0.9);border-radius:20px;text-align:center;padding:10px;margin-top:-20px;">
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Your Profile</a>
                    </li>
                    <li>
                        <a href="posts.php"><i class="fa fa-fw fa-bar-chart-o"></i> Posts</a>
                    </li>
                    <li>
                        <a href="comments.php"><i class="fa fa-comment"></i> Comments</a>
                    </li>
                    <?php if(isset($_SESSION['role'])) {
    if($_SESSION['role'] == "Administrator") {
?> 
                    <li>
                        <a href="users.php"><i class="fa fa-users"></i> Users</a>
                    </li>
                    <?php } } ?>
                    <li style="padding:0;">
                            <a href="edit_profile.php" class="btn btn-warning" style="color:black;margin:0;"><i class="fa fa-fw fa-power-off"></i><b> Settings</b></a>
                        </li>
                        <li style="padding:0;">
                            <a href="../includes/logout.php" class="btn btn-danger" style="color:black;margin:0;"><i class="fa fa-fw fa-power-off"></i><b> Log Out</b></a>
                        </li>
                    <li style="padding:0;">
                        <a href="javascript:;" class="btn btn-info" data-toggle="collapse" data-target="#demo" style="color:black;margin:0;"> <i class="fa fa-info"> </i>  <span>  </span>   <b>About</b> <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="#">Disclaimer</a>
                            </li>
                            <li>
                                <a href="#">Privacy Policy</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>