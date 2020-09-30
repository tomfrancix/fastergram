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
                <div class="post">
                    <div class="container">
                       <div class="row">
                           
                <?php
                    
                    $query = "SELECT * FROM content";
                    $select_all_content_query = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($select_all_content_query)) {
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
                
                        
                            <div class="pictures" style="float:left;width:25%;border:1px solid lightgrey;">
                                <img src="images/artdog.jpg" style="min-width:100%;min-height:100%;max-width:100%;">
                            </div>
                       
                        
                    
                
            <?php } ?>
                    </div>
                    </div>
                
                </div>
                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>
            <script>
                var x = document.getElementsByClassName("pictures");
                var i;
                for (i = 0; i < x.length; i++) {
                  x[i].style.height = ""+(window.screen.width)/4+"px";
                }
            </script>

<?php      
include "includes/sidebar.php"; 
?>
        </div>
<?php      
include "includes/footer.php"; 
?>   