<?php 
include "includes/db.php";
include "includes/header.php";
include "includes/navigation.php"; 
delete_like();
like();
unfollow_hashtags();
?>

<!-- Page Content -->
<div class="container" style="padding:0 15px;;height:100%;width:100%;overflow-x:hidden;background-color:white;">

<div class="row">

<!-- Blog Entries Column -->
<div class="col-md-8" style="padding:0;">

    <?php
    if(isset($_SESSION['id'])) {
        $thisid = $_SESSION['id'];
    }
 $total = 0;
      $allowed = array();        
      $allowedf = array();        
           $query = "SELECT * FROM subscriptions WHERE sub_user_id = $thisid ";
$select_all_subscriptions_query = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_all_subscriptions_query)) {
            $sub_hash_id = $row['sub_hash_id'];
            $status = $row['status'];
            if($status == "Subscribed") {
            array_push($allowed,$sub_hash_id);
            }
        }
          $query = "SELECT * FROM following WHERE follow_user_id = $thisid ";
$select_all_following_query = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_all_following_query)) {
            $follow_to_user_id = $row['follow_to_user_id']; 
            array_push($allowedf,$follow_to_user_id); 
            
        }
//    echo implode(', ', $allowed);
//    echo "<br>";
//    echo implode(', ', $allowedf);
         
        
        $select_all_content_query = mysqli_query($connection, $query);
        $query = "SELECT * FROM content ORDER BY content_datetime DESC";

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
                
            $pass = false;
            $passf = false;
            $content_text = substr($content_text, 0, 90);
    foreach($allowed as $item) {
            if($item == $content_hash_id) {
            $pass = true;
            }
    }
        foreach($allowedf as $item) {
            if($item == $content_user_id) {
                $passf = true;
            }
        }
        if($pass == true || $passf == true) {
            if($total < 27) {
            $total++;
       $query_user = "SELECT * FROM users WHERE user_id = {$content_user_id}";                     

        $select_user_query = mysqli_query($connection, $query_user);
            while($row = mysqli_fetch_assoc($select_user_query)) {
            $auser_id = $row['user_id'];
            $ausername = $row['username'];
            $aimage = $row['user_image'];
    ?>
    <!-- First Blog Post -->
    <div class="post" id="<?php echo $content_id; ?>" style="margin-bottom:10px;">
        <div class="container">
            <div class="row" style="padding:5px;">
                <div class="w-20" style="width:50px;float:left;">
                    <img src="images/<?php echo $aimage; ?>" style="width:100%;border-radius:50%;">
                </div>
                <div class="w-80" style="width:200px;float:left;padding:5px;">
                    <span class="username"><a href="profile.php?id=<?php echo $content_user_id; ?>"><b><?php echo $ausername; ?></b></a></span><br>
               <?php 
$query_hash = "SELECT * FROM hashtags WHERE hash_id = {$content_hash_id}";                     

$select_hash_query = mysqli_query($connection, $query_hash);
while($row = mysqli_fetch_assoc($select_hash_query)) {
$hash_id = $row['hash_id'];
$hash_title = $row['hash_title'];
?>  <span class="hashtag" style="font-size:8pt;margin:-5px 0 5px 5px;"><a href="search.php?hashtag=<?php echo $hash_id; ?>" >#<?php echo $hash_title; ?></a></span> 
<?php
$query_sub = "SELECT * FROM subscriptions WHERE sub_hash_id = {$content_hash_id}";                     

$select_sub_query = mysqli_query($connection, $query_sub);
$count = 0; 
while($row = mysqli_fetch_assoc($select_sub_query)) {
$sub_id = $row['sub_id'];
$sub_status = $row['status'];
$sub_user_id = $row['sub_user_id'];
    $count++;
if($sub_user_id == $thisid && $sub_status == "Subscribed") {
   
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
            <div class="row" style="background-color:white;">
                <?php
               if(isset($_SESSION['id'])) {
        $query_likes = "SELECT * FROM likes WHERE like_content_id = {$content_id}";                     

        $like_query = mysqli_query($connection, $query_likes);
               $count = 0; 

            while($row = mysqli_fetch_assoc($like_query)) {
            $likeid = $row['like_id'];
            $like_user_id = $row['like_user_id'];
            $like_content_id = $row['like_user_id'];

            if($like_user_id == $thisid) { ?>

                <a href="index.php?delete_like=<?php echo $likeid; ?>"><span class="glyphicon glyphicon-heart" style="font-size:16pt;float:left;padding:10px 12px;color:orangered;"></span></a>

                <?php $count++; break; 
                } 

        ?>


            <?php } 
            if($count == 0) { ?>
                 <?php

?>
                <form method="post" action="" style="display:inline;float:left;">
                    <input type="hidden" name="content_user_id" value="<?php echo $auser_id; ?>">
                    <input type="hidden" name="like_user_id" value="<?php echo $thisid; ?>">
                    <input type="hidden" name="like_content_id" value="<?php echo $content_id; ?>">
                    <button type="submit" name="like" style="padding:0;margin:0;border:none;background-color:white"><img src="images/heart.svg"  style="width:45px;float:left;padding:10px 12px;"></button>
                </form>
              <?php }
               } else { ?>
                    <a href="login.php"><img src="images/heart.svg"  style="width:45px;float:left;padding:10px 12px;"></span></a>
              <?php }
                ?>

                <a href="comments.php?id=<?php echo $content_id; ?>"><img src="images/comment.svg"  style="width:45px;float:left;padding:10px 12px;"></a>
                <a href="comments.php?id=<?php echo $content_id; ?>"><img src="images/star.svg"  style="width:45px;float:left;padding:10px 12px;"></a>
            </div>
            <?php if ($content_likes_count > 0) { ?>
            <div class="row" style="padding:4px 12px;">
                <span class="likes" style="font-size:8pt;"><b><?php echo $content_likes_count; ?> likes</b></span>
            </div>
            <?php } ?>
            <div class="row" style="padding:8px 12px;padding-top:0;">
                <span class="likes" style="font-size:10pt;"><a href="profile.php?id=<?php echo $content_user_id; ?>"><b><?php echo $ausername; ?> </b></a><span style="font-size:10pt;"><?php echo $content_text; ?>... <span><a href="post.php?id=<?php echo $content_id; ?>">more</a></span> </span></span>
            </div>
            <div class="row" style="padding:8px 12px;padding-top:0;">
                <span class="likes" style="font-size:8pt;color:grey;"><a href="comments.php?id=<?php echo $content_id; ?>"> View all <?php echo $content_comment_count; ?> comments</a></span>
            </div>
            <?php
             $query_comment = "SELECT * FROM comments WHERE comment_content_id = {$content_id}  ORDER BY comment_id DESC limit 2";                     

        $select_comment_query = mysqli_query($connection, $query_comment);
            while($row = mysqli_fetch_assoc($select_comment_query)) {
            $comment_id = $row['comment_id'];
            $comment_text = $row['comment_text'];
            $comment_user_id = $row['comment_user_id'];
            $comment_reply_user_id = $row['comment_reply_user_id'];

        $query_comment_user = "SELECT * FROM users WHERE user_id = {$comment_user_id} ";                     

        $select_comment_user_query = mysqli_query($connection, $query_comment_user);
            while($row = mysqli_fetch_assoc($select_comment_user_query)) {
            $buser_id = $row['user_id'];
            $busername = $row['username'];

    ?>

            <section class="comments">
            <div class="container" style="padding:0 10px;">
                <div class="row">
                    <span class="likes" style="font-size:10pt;">
                        <a href="profile.php?id=<?php echo $buser_id; ?>"><b><?php echo $busername; ?>   </b></a>
                         <?php if($comment_reply_user_id) {
             $query_rcomment_user = "SELECT * FROM users WHERE user_id = {$comment_reply_user_id} ";                    
                $select_rcomment_user_query = mysqli_query($connection, $query_rcomment_user);
                    while($row = mysqli_fetch_assoc($select_rcomment_user_query)) {
                    $cuser_id = $row['user_id'];
                    $cusername = $row['username'];
        } ?>
                        <span><a href="profile.php?id=<?php echo $cuser_id; ?>" style="color:deepskyblue">@<?php echo $cusername; ?> </a></span>
                        <?php } ?>
                        <span style="font-size:10pt;"><?php echo $comment_text; ?> <span>more</span> </span></span>
                </div>    
            </div>
            </section>
            <?php } }?>
            <div class="row" style="padding:4px 10px;">
                <span class="dater" id="<?php echo $content_datetime; ?>" style="color:grey;font-size:8pt;">asdfa</span>
            
                   
            </div>
        </div>

    </div>
    <hr style="margin:0;">
<?php }
        }
        }

   }
        
     ?>

</div>

<?php      
include "includes/sidebar.php"; 
?>
</div>
<?php      
include "includes/footer.php"; 
?>   