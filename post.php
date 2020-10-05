<?php 
include "includes/db.php";
include "includes/header.php";
include "includes/navigation.php"; 
if(!isset($_SESSION['role'])) {
   
        header("Location: login.php");
    
}
?>
 <?php
like();
follow_hashtags();
initial_follow_hashtags();
unfollow_hashtags();
   create_comment();
if(isset($_GET['id'])) {
                        $pid = $_GET['id'];
}
?>
    <!-- Page Content -->
    <div class="container" style="padding:0 15px;height:100%;width:100%;overflow-x:hidden;background-color:white;">
<div class="row" style="text-align:center;padding-top:3px;">
                            <span style="float:left;padding:5px 10px;"><a href="javascript:history.back(1)"><span style="font-size:16pt;"class="glyphicon glyphicon-arrow-left"></span></a></span>
                            <span style="float:none;display:inline-block;padding:3px 10px 2px 10px;margin-top:0;font-weight:bold;font-size:16pt;">View Post</span>
                            <span style="float:right;padding:5px 10px;"><span style="font-size:16pt;"class="glyphicon glyphicon-retweet"></span></span>
                        </div>
        <hr style="margin:0;">
        <div class="row">
            

            <!-- Blog Entries Column -->
            <div class="col-md-8" style="padding:0;">

                <?php  
                if(isset($_SESSION['id'])) {
                        $sessionid = $_SESSION['id'];
                    if(isset($_GET['id'])) {
                        $pid = $_GET['id'];
                    $query = "SELECT * FROM content WHERE content_id = {$pid}";
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
                        $ausername = "";
                        $aimage = "";
                        $query_user = "SELECT * FROM users WHERE user_id = {$content_user_id}";                     

                        $select_user_query = mysqli_query($connection, $query_user);
                            while($row = mysqli_fetch_assoc($select_user_query)) {
                            $ausername = $row['username'];
                            $aimage = $row['user_image'];
                            }
                    ?>
                                        

                
                <!-- First Blog Post -->
                <div class="post" style="margin-bottom:10px;">
                    <div class="container">
                        <div class="row" style="padding:5px;">
                            <div class="w-20" style="width:50px;float:left;">
                                <img src="images/<?php echo $aimage ?>" style="width:100%;border-radius:50%;">
                            </div>
                            <div class="w-80" style="width:200px;float:left;padding:5px;">
                                <span class="username"><a href="profile.php?id=<?php echo $content_user_id; ?>"><b><?php echo $ausername; ?></b></a></span><br>
<?php 
$query_hash = "SELECT * FROM hashtags WHERE hash_id = {$content_hash_id}";                     

$select_hash_query = mysqli_query($connection, $query_hash);
while($row = mysqli_fetch_assoc($select_hash_query)) {
$hash_title = $row['hash_title'];
?>  <span class="hashtag" style="font-size:8pt;margin:-5px 0 5px 5px;">#<?php echo $hash_title; ?></span> 
<?php
$query_sub = "SELECT * FROM subscriptions WHERE sub_hash_id = {$content_hash_id}";                     

$select_sub_query = mysqli_query($connection, $query_sub);
$count = 0; 
while($row = mysqli_fetch_assoc($select_sub_query)) {
$sub_id = $row['sub_id'];
$sub_status = $row['status'];
$sub_user_id = $row['sub_user_id'];
    $count++;
if($sub_user_id == $sessionid && $sub_status == "Subscribed") {
   
                                ?><span class="hashtag"><button class="btn btn-danger" style="display:inline-block;font-size:8pt;padding:0 5px;">Subscribed <span style="font-size:7pt;opacity:0.5;"><a href="post.php?unfollow=<?php echo $sub_id; ?>&postid=<?php echo $content_id; ?>">[Undo]</a></span></button></span> <?php
} 
else {
    ?>
                                <span class="hashtag"><a href="post.php?follow=<?php echo $sub_id; ?>&postid=<?php echo $content_id; ?>" class="btn btn-default" style="font-size:8pt;padding:0 5px;">Subscribe </a></span>   <?php
}}
if($count < 1) {
    
    ?>
    <form method="post" action="" style="display:inline;">
                <input type="hidden" name="sub_hash_id" value="<?php echo $content_hash_id; ?>">                
                <input type="hidden" name="sub_user_id" value="<?php echo $sessionid; ?>"> 
             <span class="hashtag"><button type="submit" name="followinit" class="btn btn-default"  style="font-size:8pt;padding:0 5px;">Subscribe</button></span> 
    </form>    
                               

    <?php
}}?>
                            </div>
                        </div>
                        <div class="row">
                            <div>
                                <img src="images/<?php echo $content_image; ?>" style="width:100%;">
                            </div>
                        </div>
                        <div class="row">
                             <?php
               if(isset($_SESSION['id'])) {
        $query_likes = "SELECT * FROM likes WHERE like_content_id = {$content_id}";                     

        $like_query = mysqli_query($connection, $query_likes);
               $count = 0; 

            while($row = mysqli_fetch_assoc($like_query)) {
            $likeid = $row['like_id'];
            $like_user_id = $row['like_user_id'];
            $like_content_id = $row['like_user_id'];

            if($like_user_id == $sessionid) { ?>

                <a href="index.php?delete_like=<?php echo $likeid; ?>"><img src="images/heart.svg"  style="width:45px;float:left;padding:10px 12px;"></a>

                <?php $count++; break; 
                } 

        ?>


            <?php } 
            if($count == 0) { ?>
                 <?php

?>
                <form method="post" action="" style="display:inline;float:left;">
                    <input type="hidden" name="like_user_id" value="<?php echo $sessionid; ?>">
                    <input type="hidden" name="like_content_id" value="<?php echo $content_id; ?>">
                    <button type="submit" name="like" style="padding:0;margin:0;border:none;background-color:white"><img src="images/heart.svg"  style="width:45px;float:left;padding:10px 12px;"></button>
                </form>
              <?php }
               } else { ?>
                    <a href="login.php"><img src="images/heart.svg"  style="width:45px;float:left;padding:10px 12px;"></a>
              <?php }
                ?>

                <a href="comments.php?id=<?php echo $content_id; ?>"><img src="images/comment.svg"  style="width:45px;float:left;padding:10px 12px;"></a>
                        
                            <img src="images/star.svg"  style="width:45px;float:left;padding:10px 12px;">
                        </div>
                        <?php if ($content_likes_count > 0) { ?>
                        <div class="row" style="padding:8px 12px;">
                            <span class="likes" style="font-size:8pt;"><b><?php echo $content_likes_count; ?> likes</b></span>
                        </div>
                        <?php } ?>
                        <div class="row" style="padding:8px 12px;padding-top:0;">
                            <span class="likes" style="font-size:10pt;"><a style="color:black;" href="profile.php?id=<?php echo $content_user_id ?>"><b><?php echo $ausername; ?> </b> </a> <span style="font-size:10pt;"><?php echo $content_text; ?>  </span></span>
                        </div>
                <div class="row" style="padding:0px 10px;">
                            <span class="dater" id="<?php echo $content_datetime; ?>" style="color:grey;font-size:8pt;">asdfa</span>
                        
                        <div class="row" style="padding:8px 12px;padding-top:10px;text-align:center;">
                            <span class="likes" style="font-size:10pt;color:grey;"><a href="comments.php?id=<?php echo $content_id ?>">~View comments~</a></span>
                        </div>
                           
                        </div>
                        

                <!-- Posted Comments -->

                
                    </div>
<div class="container" style="width:100%;position:fixed;bottom:50px;padding:10px;background-color:white;border-top:1px solid lightgrey;z-index:100;">

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
  