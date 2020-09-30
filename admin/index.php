
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
                        <h1 class="page-header ta-c" style="margin-bottom:0;">
                            Thomas Fahey
                            <img src="../images/profile2.jpg" style="width:80px;border-radius:50%;margin:8px;">
                        </h1>
                        
                        <ol style="text-align:center;list-style:none;width:100%;padding:0;">
                            <li style="float:left;width:24%;margin:1px;padding:10px;border:1px solid grey;border-radius:7px;">
                                <i class="fa fa-camera"></i>  <br><a href="index.html">Upload</a>
                            </li>
                            <li style="float:left;width:24%;margin:1px;padding:10px;border:1px solid grey;border-radius:7px;">
                                <i class="fa fa-users"></i>  <br> <a href="index.html">Followers</a>
                            </li>
                            <li style="float:left;width:24%;margin:1px;padding:10px;border:1px solid grey;border-radius:7px;">
                                <i class="fa fa-users"></i>  <br> <a href="index.html">Following</a>
                            </li>
                            <li style="float:left;width:24%;margin:1px;padding:10px;border:1px solid grey;border-radius:7px;">
                                <i class="fa fa-users"></i>  <br> <a href="index.html">Hashtags</a>
                            </li>
                        </ol>
                       
                        
                    </div>
                </div>
                <hr style="margin:5px 0;">
                <br>
                <ul>
                    <li><span> You have posted <b>114</b> gallery images</span> <span style="opacity:0.5;">View all</span></li>
                    <li><span> You have <b>238</b> followers</span> <span style="opacity:0.5;">View all</span></li>
                    <li><span> You have subscribed to <b>752</b> users</span> <span style="opacity:0.5;">View all</span></li>
                    <li><span> You follow <b>15</b> hashtags </span> <span style="opacity:0.5;">View all</span></li>
                </ul>
                

                <hr style="margin:5px 0;">
        
            </div>
            <div class="container" style="padding:0; margin:0;">
                           
                <?php
                    
                    $query = "SELECT * FROM content";
                    $select_all_content_query = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($select_all_content_query)) {
                        $content_id = $row['content_id'];
                        $content_image = $row['content_image'];
                        
                    ?>
                            <a href="../post.php?id=<?php echo $content_id; ?>"><div class="pictures" style="float:left;width:25%;border:1px solid lightgrey;background-image:url('../images/<?php echo $content_image; ?>');background-size:cover;">
                               
                            </div></a>
                
            <?php } ?>
                    </div>
            <!-- /.container-fluid -->
<br><br><br>
        </div>
        <!-- /#page-wrapper -->

            <script>
                var x = document.getElementsByClassName("pictures");
                var i;
                for (i = 0; i < x.length; i++) {
                  x[i].style.height = ""+(window.screen.width)/4+"px";
                }
            </script>
   <?php 
include "includes/footer.php";

?>

