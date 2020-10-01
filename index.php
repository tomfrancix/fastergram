<?php 
include "includes/db.php";
include "includes/header.php";
include "includes/navigation.php"; 

?>

    <!-- Page Content -->
    <div class="container" style="padding:0 15px;;height:100%;width:100%;overflow-x:hidden;">
<a href="login.php">login</a>
        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8" style="padding:0;">

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
                <div class="post" style="margin-bottom:10px;">
                    <div class="container">
                        <div class="row" style="padding:5px;">
                            <div class="w-20" style="width:50px;float:left;">
                                <img src="images/profile.JPG" style="width:100%;border-radius:50%;">
                            </div>
                            <div class="w-80" style="width:200px;float:left;padding:5px;">
                                <span class="username"><b>tomfrancix</b></span><br>
                                <span class="hashtag" style="font-size:7pt;">@freediving</span>
                            </div>
                        </div>
                        <div class="row">
                            <div>
                                <img src="images/<?php echo $content_image; ?>" style="width:100%;">
                            </div>
                        </div>
                        <div class="row">
                            <span class="glyphicon glyphicon-heart" style="font-size:15pt;float:left;padding:10px 12px;"></span>
                            <a href="post.php?id=<?php echo $content_id; ?>"><span class="glyphicon glyphicon-comment" style="font-size:15pt;float:left;padding:10px 12px;"></span></a>
                            <span class="glyphicon glyphicon-retweet" style="font-size:15pt;float:left;padding:10px 12px;"></span>
                        </div>
                        <?php if ($content_likes_count > 0) { ?>
                        <div class="row" style="padding:4px 12px;">
                            <span class="likes" style="font-size:8pt;"><b><?php echo $content_likes_count; ?> likes</b></span>
                        </div>
                        <?php } ?>
                        <div class="row" style="padding:8px 12px;padding-top:0;">
                            <span class="likes" style="font-size:10pt;"><b>tomfrancix  </b><span style="font-size:10pt;"><?php echo $content_text; ?> <span>more</span> </span></span>
                        </div>
                        <div class="row" style="padding:8px 12px;padding-top:0;">
                            <span class="likes" style="font-size:8pt;color:grey;"><a href="comments.php?id=<?php echo $content_id; ?>"> View all <?php echo $content_comment_count; ?> comments</a></span>
                        </div>
                        <section class="comments">
                        <div class="container" style="padding:0 10px;">
                            <div class="row">
                                <span class="likes" style="font-size:10pt;">
                                    <b>tomfrancix  </b>
                                    <span style="color:deepskyblue">@redfoxcareer</span>
                                    <span style="font-size:10pt;">Have you tried one of these instead of using a speader for adhesive... <span>more</span> </span></span>
                            </div>    
                        </div>
                        </section>
                        <div class="row" style="padding:4px 10px;">
                            <span style="color:grey;font-size:8pt;">11 hours ago</span>
                        </div>
                    </div>
                
                </div>
                <hr style="margin:0;">
            <?php } ?>

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

<?php      
include "includes/sidebar.php"; 
?>
        </div>
<?php      
include "includes/footer.php"; 
?>   