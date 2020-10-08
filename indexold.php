<?php 
include "includes/db.php";
include "includes/header.php";
include "includes/navigation.php"; 

//CHECK FOR SESSION
if(!isset($_SESSION['id'])) {
    Header("Location: login.php");
} 

//FUNCTIONS REQUIRED
delete_like();
like();
unfollow_hashtags();
initial_follow_hashtags();
?>

<!-- PAGE CONTENT -->
<div class="container page-content">
<div class="row">
<div class="col-md-8 p0">

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

        $select_all_content_query = mysqli_query($connection, $query);
        $query = "SELECT * FROM content ORDER BY content_datetime DESC";

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
        if($pass == true || $passf == true || $content_user_id == $thisid) {
            if($total < 27) {
            $total++;
       $query_user = "SELECT * FROM users WHERE user_id = {$content_user_id}";                     

        $select_user_query = mysqli_query($connection, $query_user);
            while($row = mysqli_fetch_assoc($select_user_query)) {
            $auser_id = escape($row['user_id']);
            $ausername = escape($row['username']);
            $aimage = escape($row['user_image']);
    ?>
    <!-- ITEMS-->
    <div class="post post-index" id="<?php echo $content_id; ?>">
        <div class="container post-container">
            <div class="row post-row">
                <div class="post-picture-div">
                    <img src="images/<?php echo $aimage; ?>" class="post-picture-div-image">
                </div>
                <div class="post-info-div">
                    <span class="username">
                        <a href="profile.php?id=<?php echo $content_user_id; ?>"><b><?php echo $ausername; ?></b></a>
                    </span>
                    <br>

<?php 
$query_hash = "SELECT * FROM hashtags WHERE hash_id = {$content_hash_id}";                     

$select_hash_query = mysqli_query($connection, $query_hash);
while($row = mysqli_fetch_assoc($select_hash_query)) {
$hash_id = escape($row['hash_id']);
$hash_title = escape($row['hash_title']);
?>  <span class="hashtag" style="font-size:8pt;margin:-5px 0 5px 5px;"><a href="search.php?hashtag=<?php echo $hash_id; ?>" >#<?php echo $hash_title; ?></a></span> 
<?php
$query_sub = "SELECT * FROM subscriptions WHERE sub_hash_id = {$content_hash_id} AND sub_user_id = {$thisid}";                     

$select_sub_query = mysqli_query($connection, $query_sub);
$count = 0; 
while($row = mysqli_fetch_assoc($select_sub_query)) {
$sub_id = escape($row['sub_id']);
$sub_status = escape($row['status']);
$sub_user_id = escape($row['sub_user_id']);
    $count++;
if($sub_user_id == $thisid && $sub_status == "Subscribed") {
   
?>
            <span class="hashtag">
                <button class="btn btn-danger subscribed-button">Subscribed 
                    <span class="undo-subscription">
                        <a href="post.php?unfollow=<?php echo $sub_id; ?>&postid=<?php echo $content_id; ?>">[Undo]</a>
                    </span>
                </button>
            </span>
<?php
} 
else 
{
?>
            <span class="hashtag">
                <a href="post.php?follow=<?php echo $sub_id; ?>&postid=<?php echo $content_id; ?>" class="btn btn-default subscribe-button">Subscribe
                </a>
            </span>   
<?php
}}
if($count < 1) {
    ?>
    <form method="post" action="" class="subscribe-form">
        <input type="hidden" name="sub_hash_id" value="<?php echo $content_hash_id; ?>">                
        <input type="hidden" name="sub_user_id" value="<?php echo $thisid; ?>"> 
        <span class="hashtag">
            <button type="submit" name="followinit" class="btn btn-default sf-button">Subscribe</button>
        </span> 
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

if($like_user_id == $thisid) { ?>
        <a href="index.php?delete_like=<?php echo $likeid; ?>">         <span class="glyphicon glyphicon-heart post-delete-like"></span>
        </a>
<?php $count++; break; 
} 
?>
<?php } 
if($count == 0) { ?>
<?php
?>
                
                
        <button id="refresh" onclick="likepost(<?php echo $content_id; ?>, <?php echo $thisid; ?>)" name="like" class="post-submit-like-button" ><img src="images/heart.svg" class="post-button-img"></button>   
                
    <script>
        function likepost(post,user) {
        
            $.ajax({
                
                url:"/VortexPHPVersion/VortexApp2/index.php?content_id="+post,
                type: 'post',
                data: {
                    liked: 1,
                    'content_id': post,
                    'user_id': user
                }
                
            });
        
            
        }
        </script>

   
<?php }
} else { ?>
        <a href="login.php">
            <img src="images/heart.svg" class="post-button-img">
        </a>
<?php }
?>
        <a href="comments.php?id=<?php echo $content_id; ?>">
            <img src="images/comment.svg" class="post-button-img">
        </a>
        <a href="comments.php?id=<?php echo $content_id; ?>">
            <img src="images/star.svg" class="post-button-img">
        </a>
    </div>
<?php if ($content_likes_count > 0) { ?>
    <div class="row post-like-count">
        <span class="likes fs-small"><b><?php echo $content_likes_count; ?> likes</b></span>
    </div>
            <?php } ?>
            <div class="row post-text-row">
                <span class="likes fs-medium">
                    <a href="profile.php?id=<?php echo $content_user_id; ?>">
                        <b><?php echo $ausername; ?> </b>
                    </a>
                    <span><?php echo $content_text; ?>... 
                        <span>
                            <a href="post.php?id=<?php echo $content_id; ?>">more</a>
                        </span> 
                    </span>
                </span>
            </div>
            
            <div class="row" style="padding:8px 12px;padding-top:0;">
                <span class="likes fs-small text-fade">
                    <a href="comments.php?id=<?php echo $content_id; ?>"> View all <?php echo $content_comment_count; ?> comments</a>
                </span>
            </div>
<?php
 $query_comment = "SELECT * FROM comments WHERE comment_content_id = {$content_id}  ORDER BY comment_id DESC limit 2";                     

$select_comment_query = mysqli_query($connection, $query_comment);
while($row = mysqli_fetch_assoc($select_comment_query)) {
$comment_id = escape($row['comment_id']);
$comment_text = escape($row['comment_text']);
$comment_user_id = escape($row['comment_user_id']);
$comment_reply_user_id = escape($row['comment_reply_user_id']);

$query_comment_user = "SELECT * FROM users WHERE user_id = {$comment_user_id} ";                     

$select_comment_user_query = mysqli_query($connection, $query_comment_user);
while($row = mysqli_fetch_assoc($select_comment_user_query)) {
$buser_id = escape($row['user_id']);
$busername = escape($row['username']);

?>

        <section class="comments">
            <div class="container post-comments-container">
                <div class="row">
                    <span class="likes fs-medium">
                        <a href="profile.php?id=<?php echo $buser_id; ?>">
                            <b><?php echo $busername; ?>   </b>
                        </a>
                        
<?php if($comment_reply_user_id) {
$query_rcomment_user = "SELECT * FROM users WHERE user_id = {$comment_reply_user_id} ";                    
$select_rcomment_user_query = mysqli_query($connection, $query_rcomment_user);
while($row = mysqli_fetch_assoc($select_rcomment_user_query)) {
$cuser_id = escape($row['user_id']);
$cusername = escape($row['username']);
} ?>
                        <span>
                            <a href="profile.php?id=<?php echo $cuser_id; ?>" class="post-comment-reply-link">@<?php echo $cusername; ?> 
                            </a>
                        </span>
                        <?php } ?>
                        <span class="commentContent fs-medium"><?php echo $comment_text; ?> </span>
                    </span>
                </div>    
            </div>
        </section>
<?php } }?>
        <div class="row post-dater-row">
            <span class="dater post-dater-span" id="<?php echo $content_datetime; ?>">asdfa</span>
            </div>
        </div>
    </div>
    <hr class="m0">
<?php }
}
}

}

?>
</div>
<script>
    window.onload = function() {
        var arr = document.getElementsByClassName('commentContent');
        
        for (var z=0;z<arr.length;z++)
        {
            
            var firstWord = "";
            var firstLetter = "";
            var str = arr[z].innerHTML.toString();
              var words = str.split(" ");
              firstWord = words[0];
            firstLetter = firstWord.toString().substring(0,1);
            if(firstLetter == "@") {
                var newstr = str.replace(firstWord, "");
                arr[z].innerHTML = newstr;
            } else {
                 arr[z].innerHTML = str;
            }
            
        }
    }
   
</script>
<?php      
include "includes/sidebar.php"; 
?>
</div>
<?php      
include "includes/footer.php"; 
?>   