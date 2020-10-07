<?php 
//include "includes/db.php";
include "includes/header.php";
include "includes/navigation.php"; 
 if(!isset($_SESSION['id'])) {
       Header("Location: ../login.php");
    }
?>
<?php
    $sessionid = $_SESSION['id'];
    $query = "SELECT * FROM users WHERE user_id = {$sessionid} ";
    $select_all_users_query = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_all_users_query)) {
        $role = $row['role'];
    }
    if($role != "Administrator") {
         header("Location: index.php");
    } else {
?>  

        

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header" style="font-size:12pt;margin-top:15px;">
                            Users
                        </h1>
                        
                        <?php
                        
                        delete_user();
                        change_role_admin();
                        change_role_subscriber();
                            
                        ?>
                        
                        
<?php

if(isset($_GET['source'])) {
    $source = $_GET['source'];
} else {
    $source = '';
}

switch($source) {
        case 'add_user';
        include "includes/add_user.php";
        break;

        case 'change_role_subscriber';
        include "includes/change_role_subscriber.php";
        break;
        

        case 'edit_user';
        include "includes/edit_user.php";
        break;

        case 'delete_user';
        include "includes/delete_user.php";
        break;

        default:
        include "includes/view_all_users.php";
        break;
}
?>

                        
                        <script>
                            var x = document.getElementsByClassName("pictures");
                            var i;
                            for (i = 0; i < x.length; i++) {
                              x[i].style.height = ""+(window.screen.width)/4+"px";
                              x[i].style.width = ""+(window.screen.width)/4+"px";
                            }
                        </script>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

   <?php 
include "includes/footer.php";
    }
?>