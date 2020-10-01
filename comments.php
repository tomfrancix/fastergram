<?php 
include "includes/db.php";
include "includes/header.php";
include "includes/navigation.php"; 
if(!isset($_SESSION['role'])) {
   
        header("Location: login.php");
    
}
?>
 <?php
   create_comment();
?>
    <!-- Page Content -->
    <div class="container" style="padding:0 15px;;height:100%;width:100%;overflow-x:hidden;">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8" style="padding:0;">

                <?php
                    if(isset($_GET['id'])) {
                        $pid = $_GET['id'];
                    $query = "SELECT * FROM content WHERE content_id = '{$pid}'";
                    $select_all_content_query = mysqli_query($connection, $query);
                   
                    while($row = mysqli_fetch_assoc($select_all_content_query)) {
                        $content_id = $row['content_id'];
                        $content_text = $row['content_text'];
                        $content_datetime = $row['content_datetime'];
                        $content_user_id = $row['content_user_id'];
                        $content_hash_id = $row['content_hash_id'];
                        $content_comment_count = $row['content_comment_count'];
                        $content_likes_count = $row['content_likes_count'];
                        
                    ?>
                                        

                
                <!-- First Blog Post -->
                <div class="post" style="margin-bottom:10px;">
                    <div class="container">
                        <div class="row" style="text-align:center;">
                            <span style="float:left;padding:5px 10px;"><a href="post.php?id=<?php echo $content_id; ?>"><span style="font-size:16pt;"class="glyphicon glyphicon-arrow-left"></span></a></span>
                            <span style="float:none;padding:8px 10px 2px 10px;margin-bottom:-5px;font-weight:bold;font-size:16pt;">Comments</span>
                            <span style="float:right;padding:5px 10px;"><span style="font-size:16pt;"class="glyphicon glyphicon-retweet"></span></span>
                        </div>
                        <hr style="margin:0;">
                        <div class="row" style="padding:5px;padding-bottom:0;">
                            <div class="w-20" style="width:40px;float:left;">
                                <img src="images/profile.JPG" style="width:100%;border-radius:50%;">
                            </div>
                            <div class="w-80" style="width:82%;float:left;padding:5px;">
                                <span class="username"><a style="color:black;" href="user.php?id=<?php echo $user_id ?>"><b>tomfrancix  </b>  </a></span><span style="font-size:10pt;"><?php echo $content_text; ?> <span>more</span> </span><br>
                                <span class="hashtag" style="font-size:8pt;">#freediving</span><br>
                                <span style="color:grey;font-size:7pt;">11 hours ago</span>
                            </div>
                            <div class="w-20" style="width:20px;float:right;padding-top:20px;">
                                <span class="hashtag" style="font-size:8pt;"><a href="#"><span style="color:grey;" class="glyphicon glyphicon-heart"></span></a></span>
                            </div>
                        </div>
                        
                       <hr style="margin:0;margin-bottom:8px;">
<!--                        COMMENT-->
                         <?php
                    
//                    $query = "SELECT * FROM comments WHERE comment_content_id = {$content_id}";
                    $querytwo = "SELECT * FROM comments";
                    $select_all_comments_query = mysqli_query($connection, $querytwo);
                   
                    while($row = mysqli_fetch_assoc($select_all_comments_query)) {
                        $comment_id = $row['comment_id'];
                        $comment_content_id = $row['comment_content_id'];
                        $comment_text = $row['comment_text'];
                        $comment_user_id = $row['comment_user_id'];
                        $comment_reply_user_id = $row['comment_reply_user_id'];
                        $comment_reply_id = $row['comment_reply_user_id'];
                        
                      
//                    $contentquery = "SELECT * FROM content WHERE hash_id = {$content_hash_id} ";
//                    $select_all_hashcontent_query = mysqli_query($connection, $hashquery);
//                    $hash_title = "";
//                    while($row = mysqli_fetch_assoc($select_all_hashcontent_query)) {
//                        $hash_title = $row['hash_title'];
//                        
//                    }
                        
                    ?>
                        <?php if($comment_content_id == $content_id && $comment_reply_user_id == 0) { ?>
                        <div class="row" style="padding:5px;padding-bottom:0;">
                            <div class="container" style="padding:0;">
                            <div class="w-20" style="width:40px;float:left;">
                                <img src="images/profile.JPG" style="width:100%;border-radius:50%;">
                            </div>
                            <div class="w-80" style="width:85%;float:left;padding:5px;">
                                <span class="username"><a style="color:black;" href="user.php?id=<?php echo $user_id ?>"><b>redfoxcareer</b></a></span><span style="font-size:10pt;"><?php echo $comment_text; ?> </span><br>
                                <span style="color:grey;font-size:7pt;">11 hours ago</span> | 
                                <span class="hashtag" style="font-size:8pt;"><a href="#">5 likes</a></span> | 
                                <span class="hashtag" style="font-size:8pt;"><a href="#">Reply</a></span> | 
                                <span class="hashtag" style="font-size:8pt;"><a href="#"><span style="color:grey;" class="glyphicon glyphicon-heart"></span></a></span>
                            </div>
                            </div>
                            <?php 
                                   $secondquery = "SELECT * FROM comments WHERE comment_content_id = {$content_id}";
                                $select_all_replies_query = mysqli_query($connection, $secondquery);                            
                                while($row = mysqli_fetch_assoc($select_all_replies_query)) {
                                    $reply_id = $row['comment_id'];
                                    $reply_text = $row['comment_text'];
                                    $reply_user_id = $row['comment_user_id'];
                                    $reply_uid = $row['comment_reply_user_id'];
                                    $reply_id = $row['comment_reply_id'];
                                   
                                if($reply_uid == $comment_user_id && $reply_id == $comment_id) {
                            ?>
<!--                            NESTED COMMENTS-->
                            <div class="container" style="padding-left:50px;">
                                <div class="container" style="border-left:1px solid lightgrey;">
                                <div class="row" style="padding:5px;padding-bottom:0;border-left:2px solid lightgrey;">
                                    <div class="w-20" style="width:20px;float:left;">
                                        <img src="images/profile.JPG" style="width:100%;border-radius:50%;">
                                    </div>
                                    <div class="w-80" style="width:85%;float:left;padding:5px;PADDING-TOP:0;">
                                        <span class="username"><a style="color:black;" href="user.php?id=<?php echo $user_id; ?>"><b>redfoxcareer</b></a></span><span style="font-size:10pt;">
                                        
                                    <span style="color:deepskyblue">@redfoxcarer</span>
                                        
                                        <?php echo $reply_text; ?> </span><br>
                                        <span style="color:grey;font-size:7pt;">11 hours ago</span> | 
                                        <span class="hashtag" style="font-size:8pt;"><a href="#">5 likes</a></span> | 
                                        <span class="hashtag" style="font-size:8pt;"><a href="#">Reply</a></span> | 
                                        <span class="hashtag" style="font-size:8pt;"><a href="#"><span style="color:grey;" class="glyphicon glyphicon-heart"></span></a></span>
                                    </div>
                                </div>
                                </div>
                                
                            </div>
                            <?php } else {continue;} }}  else { continue; }?>
                        </div>
                        
                        
                            
                       <?php } ?>
                                                              



                                                          <?php  } ?>
                        

                <!-- Posted Comments -->

                
                    </div>
                
                </div>
                <hr style="margin:0;">
            <?php }  ?>

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
            <div class="container" style="width:100%;position:fixed;bottom:50px;padding:10px;background-color:white;border-top:1px solid lightgrey;z-index:100;">

<form action="" method="POST" enctype="multipart/form-data">
     <div class="container" style="padding:8px 10px;">
        <div class="row">
            <div class="w-20" style="width:30px;float:left;">
                <img src="images/profile.JPG" style="width:100%;border-radius:50%;">
            </div>
            <div class="w-80" style="min-width:85%;width:80%;float:left;padding:5px;">
                <textarea type="text" style="border:none;width:100%;" name="comment_text" placeholder="Add a comment..."></textarea>
            </div>
            <input type="hidden" name="comment_content_id" value="<?php echo $content_id; ?>">
            <input type="hidden" name="comment_user_id" value="<?php echo $content_user_id; ?>">
            <input type="hidden" name="comment_reply_user_id" value="0">
        </div>    
    </div>
    <input class="btn btn-primary" style="width:100%;background-color:charcoal" type="submit" name="create_comment" value="Submit">

</form> </div>

<?php      
include "includes/sidebar.php"; 
?>
        </div>
<?php      
include "includes/footer.php"; 
?>   
  