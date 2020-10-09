
<?php 
//include "includes/db.php";
include "includes/header.php";
include "includes/navigation.php"; 
 if(!isset($_SESSION['id'])) {
       Header("Location: ../login.php");
    }
else {
       $sessionid = $_SESSION['id'];
  
?>
<div id="page-wrapper">
<div style="width:100%;padding:30px;text-align:center;">
    <span class="text-fade fs-medium">LAST 7 DAYS</span><br><br>
    <span class="glyphicon glyphicon-stats c-white fs-large"></span><br><br>
    <span class="fs-medium c-white;"><b>Welcome to your insights</b></span><br><br>
    <span class="fs-medium text-fade">Take a deeper look at how your account and content are performing on Fastergram in the last 7 days.</span>
</div>
    <hr class="hrm0">
<div class="container" >
<label>Overview</label>  
    <br><br>
<div class="row w100 p0 m0">
    <div class="w50 fl tl">
        <?php
    $query = "SELECT * FROM content WHERE content_user_id = '{$sessionid}' ";
    $get_content_query = mysqli_query($connection, $query);
    $hashtags = array("me");
    $number = 0;
    while($row = mysqli_fetch_assoc($get_content_query)) {
        $content_hash_id = escape($row['content_hash_id']);
        $query_hash = "SELECT * FROM hashtags WHERE hash_id = '{$content_hash_id}' ";
        $find_hashtag_query = mysqli_query($connection, $query_hash);
        while($row = mysqli_fetch_assoc($find_hashtag_query)) {
            $hash_id = escape($row['hash_id']);
            $subscription_count = escape($row['subscription_count']);
             if(in_array($hash_id, $hashtags) == FALSE) {
                array_push($hashtags, $hash_id);
                $number = $number + $subscription_count;
             }
        }
    }
    $query_follows = "SELECT * FROM following WHERE follow_user_id = '{$sessionid}' ";
    $find_all_query = mysqli_query($connection, $query_follows);
    while($row = mysqli_fetch_assoc($find_all_query)) {
        $number++;
    }
    
    ?>
        <span style="color:chartreuse;"><?php echo $number; ?></span><br>
        <span class="text-fade">Accounts Reached</span>
    </div>
    <div class="w50 fl tr pt8">
        
        <span class="text-fade">0%</span>
        <span class="glyphicon glyphicon-arrow-right text-fade"></span>
    </div>
</div>
    <br>
    <div class="row w100 p0 m0 mt5">
    <div class="w50 fl tl">
         <?php
    $queryc = "SELECT * FROM content WHERE content_user_id = '{$sessionid}' ";
    $get_content_query = mysqli_query($connection, $queryc);
    $interactions = 0;
    while($row = mysqli_fetch_assoc($get_content_query)) {
        $content_comment_count = escape($row['content_comment_count']);
        $content_likes_count = escape($row['content_likes_count']);
        
        $interactions = $interactions + $content_comment_count + $content_likes_count;
        
    }
    
    ?>
        <span style="color:chartreuse;"><?php echo $interactions; ?></span><br>
        <span class="text-fade">Content Interactions</span>
    </div>
    <div class="w50 fl tr pt8">
        <span class="text-fade">0%</span>
        <span class="glyphicon glyphicon-arrow-right text-fade"></span>
    </div>
</div>
    <br>
    <div class="row w100 p0 m0 mt5">
    <div class="w50 fl tl">
         <?php
    $queryu = "SELECT * FROM users WHERE user_id = '{$sessionid}' ";
    $get_user_query = mysqli_query($connection, $queryu);
    $followers = 0;
    while($row = mysqli_fetch_assoc($get_user_query)) {
        $user_follower_count = escape($row['user_follower_count']);
        
        $followers = $followers + $user_follower_count;
        
    }
    
    ?>
        <span style="color:chartreuse;"><?php echo $followers; ?></span><br>
        <span class="text-fade">Total Followers</span>
    </div>
    <div class="w50 fl tr pt8">
        <span class="text-fade">0%</span>
        <span class="glyphicon glyphicon-arrow-right text-fade"></span>
    </div>
</div>
</div>
    <br>
    <hr class="hrm0">
   <div class="container" >
<label>Content You Shared</label>  
    <br><br>
       <div class="row w100 p0 m0">
            <div class="w85 fl tl">
                <span class="text-fade">Post photos or videos to see new insights.</span><br>
                <br>
                <a href="posts.php?source=add_post" style="color:deepskyblue;"><b>Create Post</b></a>
            </div>
            <div class="w15 fl tr">
                <a href="posts.php?source=add_post">
                <span class="glyphicon glyphicon-arrow-right text-fade">              </span>
                </a>
            </div>
       </div>
</div>
<!--
   <br>
    <hr class="hrm0">
   <div class="container" >
       <div class="row w100 p0 m0">
            <div class="w85 fl tl">
                <span class="text-fade">Post photos or videos to see new insights.</span><br>
                <br>
                <a href="#" style="color:deepskyblue;"><b>Create Post</b></a>
            </div>
            <div class="w15 fl tr">
                <span class="glyphicon glyphicon-arrow-right text-fade">              </span>
            </div>
       </div>
</div>
-->
    <br> 
    <br> 
    <br> 
    <br> 
    <br> 
    <br> 
    <br> 
    <br> 

</div>  
<?php } ?>
<script> window.onload = function() { document.getElementById('navbar-header').innerHTML = "Insights"; } </script>
<?php 
include "includes/footer.php";
  ?>


