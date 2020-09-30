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
                            Your Posts
                        </h1>
                        
                        <?php
                        
                        delete_post();
                        edit_post();
                        ?>
                        
                        
<?php

if(isset($_GET['source'])) {
    $source = $_GET['source'];
} else {
    $source = '';
}

switch($source) {
        case 'add_post';
        include "includes/add_post.php";
        break;

        case 'edit_post';
        include "includes/edit_post.php";
        break;

        case '200';
        echo "NICE 200";
        break;

        default:
        include "includes/view_all_posts.php";
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