<?php 
//include "includes/db.php";
include "includes/header.php";
include "includes/navigation.php"; 

?>
    

        

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header" style="font-size:12pt;margin-top:15px;">
                            Comments
                        </h1>
                        
                        <?php
                        
                        delete_comment();
                        ?>
                        
                        
<?php

if(isset($_GET['source'])) {
    $source = $_GET['source'];
} else {
    $source = '';
}

switch($source) {
        case 'view_your_comments';
        include "includes/view_your_comments.php";
        break;

        case 'edit_comment';
        include "includes/edit_comment.php";
        break;

        case 'delete_comment';
        include "includes/delete_comment.php";
        break;

        default:
        include "includes/view_all_comments.php";
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

?>