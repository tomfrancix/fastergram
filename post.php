<?php 
include "includes/db.php";
include "includes/header.php";
if(!isset($_SESSION['role'])) {
   
        header("Location: login.php");
    
}
?>
 <?php
likeinpost();
delete_post_like();
follow_hashtags();
initial_follow_hashtags();
unfollow_hashtags();
   create_comment();
if(isset($_GET['id'])) {
                        $pid = escape($_GET['id']);
}
?>
    <!-- PAGE CONTENT -->
<div class="container page-content">
    <div class="row ahn-row">
        <span class="ahn-row-left">
            <a href="index.php#<?php echo $pid; ?>">
                <span class="glyphicon glyphicon-arrow-left"></span>
            </a>
        </span>
        <span class="ahn-row-center">View Post</span>
    </div>
    <hr style="margin:0;">
    <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8" style="padding:0;">

<?php  
if(isset($_SESSION['id'])) {
$sessionid = $_SESSION['id'];
if(isset($_GET['id'])) {
$pid = escape($_GET['id']);
$query = "SELECT * FROM content WHERE content_id = {$pid}";
$select_all_content_query = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_all_content_query)) {
$content_id = escape($row['content_id']);
$content_type = escape($row['content_type']);
$content_text = escape($row['content_text']);
$content_image = escape($row['content_image']);
$content_datetime = escape($row['content_datetime']);
$content_user_id = escape($row['content_user_id']);
$content_hash_id = escape($row['content_hash_id']);
$content_video = escape($row['content_video']);
$content_comment_count = escape($row['content_comment_count']);
$content_likes_count = escape($row['content_likes_count']);
$ausername = "";
$aimage = "";
$query_user = "SELECT * FROM users WHERE user_id = {$content_user_id}";                     

$select_user_query = mysqli_query($connection, $query_user);
while($row = mysqli_fetch_assoc($select_user_query)) {
$ausername = escape($row['username']);
$aimage = escape($row['user_image']);
}
?>
                <!-- THE POST -->
                <div class="post post-index">
                    <div class="container">
                        <div class="row post-row">
                            <div class="post-picture-div">
                                <img src="images/<?php echo $aimage ?>" class="post-picture-div-image">
                            </div>
                            <div class="post-info-div">
                                <span class="username"><a href="profile.php?id=<?php echo $content_user_id; ?>"><b><?php echo $ausername; ?></b></a>
                                </span><br>
<?php 
$query_hash = "SELECT * FROM hashtags WHERE hash_id = {$content_hash_id}";                     

$select_hash_query = mysqli_query($connection, $query_hash);
while($row = mysqli_fetch_assoc($select_hash_query)) {
$hash_title = escape($row['hash_title']);
?>  <span class="hashtag" style="font-size:8pt;margin:-5px 0 5px 5px;">#<?php echo $hash_title; ?></span> 
<?php
$query_sub = "SELECT * FROM subscriptions WHERE sub_hash_id = {$content_hash_id}";                     

$select_sub_query = mysqli_query($connection, $query_sub);
$count = 0; 
while($row = mysqli_fetch_assoc($select_sub_query)) {
$sub_id = escape($row['sub_id']);
$sub_status = escape($row['status']);
$sub_user_id = escape($row['sub_user_id']);
    $count++;
if($sub_user_id == $sessionid && $sub_status == "Subscribed") {
   
                                ?><span class="hashtag">
                                    <button class="btn btn-danger subscribed-button">Subscribed 
                                        <span class="undo-subscription">
                                            <a href="post.php?unfollow=<?php echo $sub_id; ?>&postid=<?php echo $content_id; ?>">[Undo]</a>
                                        </span>
                                    </button>
                                </span> 
<?php
} 
else if($sub_user_id == $sessionid && $sub_status == "Unsubscribed") {
?>
                                <span class="hashtag">
                                    <a href="post.php?follow=<?php echo $sub_id; ?>&postid=<?php echo $content_id; ?>" class="btn btn-default subscribe-button">Subscribe</a>
                                </span>   
<?php
}
   
}
if($count < 2) {
    
    ?>
    <form method="post" action="" class="subscribe-form">
                <input type="hidden" name="sub_hash_id" value="<?php echo $content_hash_id; ?>">                
                <input type="hidden" name="sub_user_id" value="<?php echo $sessionid; ?>"> 
             <span class="hashtag"><button type="submit" name="followinit" class="btn btn-default sf-button"  >Subscribe</button></span> 
    </form>   
    <?php
}}?>
                </div>
            </div>
                        <div class="row">
                            <div>
                                <img src="images/<?php echo $content_image; ?>" class="post-image">
                            </div>
                        </div>
                        <div class="row">
                             <?php
               if(isset($_SESSION['id'])) {
        $query_likes = "SELECT * FROM likes WHERE like_content_id = {$content_id}";                     

        $like_query = mysqli_query($connection, $query_likes);
               $count = 0; 

            while($row = mysqli_fetch_assoc($like_query)) {
            $likeid = escape($row['like_id']);
            $like_user_id = escape($row['like_user_id']);
            $like_content_id = escape($row['like_user_id']);

            if($like_user_id == $sessionid) { ?>
            
<a href="post.php?delete_post_like=<?php echo $likeid; ?>"><span class="glyphicon glyphicon-heart post-delete-like"></span></a>
                <?php $count++; break; 
                } 

        ?>


            <?php } 
            if($count == 0) { ?>
                 <?php

?>
                            
                <form method="post" action="" class="post-submit-like-form">
                    <input type="hidden" name="like_user_id" value="<?php echo $sessionid; ?>">
                    <input type="hidden" name="like_content_id" value="<?php echo $content_id; ?>">
                    <input type="hidden" name="content_user_id" value="<?php echo $content_user_id; ?>">
                    <button type="submit" name="likeinpost" class="post-submit-like-button"><img src="images/heart.svg"  class="post-button-img"></button>
                </form>
              <?php }
               } else { ?>
                    <a href="login.php"><img src="images/heart.svg"  class="post-button-img"></a>
              <?php }
                ?>

                <a href="comments.php?id=<?php echo $content_id; ?>"><img src="images/comment.svg" class="post-button-img"></a>
                        
                <img src="images/star.svg"  class="post-button-img">
                        </div>
                        <?php if ($content_likes_count > 0) { ?>
                        <div class="row" style="padding:8px 12px;">
                            <span class="likes fs-small"><b><?php echo $content_likes_count; ?> likes</b></span>
                        </div>
                        <?php } ?>
                        <div class="row post-text-row">
                            <span class="likes fs-medium">
                                <a class="c-b" href="profile.php?id=<?php echo $content_user_id ?>">
                                    <b><?php echo $ausername; ?> </b> 
                                </a> 
                                <span class="fs-medium"><?php echo $content_text; ?>  </span>
                            </span>
                        </div>
                    <div class="row post-dater-row" >
                        
                        <span class="dater post-dater-span" id="<?php echo $content_datetime; ?>"></span>
                        
                        <div class="row post-view-comments-div">
                            <span class="likes post-view-comments-span">
                                <a href="comments.php?id=<?php echo $content_id ?>">
                                    ~View comments~
                                </a>
                            </span>
                        </div>
                    </div>  
                </div>

                        
                    
                
                </div>
            <?php } } } ?>
            </div>

<?php      
include "includes/sidebar.php"; 
?>
        </div>
<?php      
include "includes/footer.php"; 
?>   
  