<?php 
include "includes/db.php";
include "includes/header.php";
include "includes/navigation.php"; 

?>

    <!-- Page Content -->
    <div class="container" style="padding:0 15px;;height:100%;width:100%;overflow-x:hidden;">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8" style="padding:0;">
                <div class="wells">
                    <h4 style="text-align:center;">Search</h4>
                    <div class="input-group" style="padding-bottom:8px;">
                        <input type="text" class="form-control" placeholder="Enter a hashtag...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    <div style="padding:3px 8px">
                        <h5>Most Recent Posts</h5>
                    </div>
                    <!-- /.input-group -->
                </div>
                <div class="post">
                    <div class="container">
                       <div class="row">
                           
                <?php
                    
                    $query = "SELECT * FROM content ORDER BY content_datetime DESC";
                    $select_all_content_query = mysqli_query($connection, $query);
                    $counter = 0;
                    while($row = mysqli_fetch_assoc($select_all_content_query)) {
                        $counter++;
                        $content_id = $row['content_id'];
                        $content_type = $row['content_type'];
                        $content_text = $row['content_text'];
                        $content_image = $row['content_image'];
                        $content_datetime = $row['content_datetime'];
                        $content_user_id = $row['content_user_id'];
                        $content_hash_id = $row['content_hash_id'];
                        $content_video = $row['content_video'];
                        $content_comment_count = $row['content_comment_count'];
                        $content_likes_count = $row['content_likes_count'];
                        
                    ?>
                
                
                <!-- First Blog Post -->
                <?php if($counter == 1 || $counter == 28) {
                        ?> 
                           <a href="post.php?id=<?php echo $content_id; ?>">
                                <div class="bigpictures" style="float:left;width:100%;border:1px solid lightgrey;background-image:url('images/<?php echo $content_image; ?>');background-size:cover;">
                               
                            </div></a>
                        <?php
                    } else if($counter == 6 || $counter == 19) {
                     ?> 
                            <a href="post.php?id=<?php echo $content_id; ?>">
                                <div class="mediumpictures" style="float:left;width:50%;border:1px solid lightgrey;background-image:url('images/<?php echo $content_image; ?>');background-size:cover;">
                               
                            </div></a>
                    <?php
                    } else {
                        ?>
                           <a href="post.php?id=<?php echo $content_id; ?>">
                                <div class="pictures" style="float:left;width:25%;border:1px solid lightgrey;background-image:url('images/<?php echo $content_image; ?>');background-size:cover;">
                               
                            </div></a> 
                   
                        
                           
                       
                        
                    
                
            <?php } } ?>
                    </div>
                    </div>
                
                </div>
                <!-- Pager -->
               

            </div>
            <script>
                var x = document.getElementsByClassName("pictures");
                var i;
                for (i = 0; i < x.length; i++) {
                  x[i].style.height = ""+(window.screen.width)/4+"px";
                }
                var x = document.getElementsByClassName("bigpictures");
                var i;
                for (i = 0; i < x.length; i++) {
                  x[i].style.height = ""+(window.screen.width)+"px";
                }
                var x = document.getElementsByClassName("mediumpictures");
                var i;
                for (i = 0; i < x.length; i++) {
                  x[i].style.height = ""+(window.screen.width)/2+"px";
                }
            </script>

<?php      
include "includes/sidebar.php"; 
?>
        </div>
<?php      
include "includes/footer.php"; 
?>   