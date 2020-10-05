<?php 
include "includes/db.php";

?>

<?php include "functions.php"; ?>
<?php session_start();  ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="admin/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <title>Fastergram</title>

    <!-- Bootstrap Core CSS -->
<!--    <link href="./css/bootstrap.min.css" rel="stylesheet">-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link href="./css/blog-home.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<style>
    .btn.btn-primary {
        background-color:rgba(09,58,57,1);
        color:white;
    }
    body {
        background-color:white;
    }
    .btn.btn-primary a {
        color:white;
    }
    </style>
</head>

<body id="top" style="height:100vh;width:100vw;max-width:100vw;overflow-x:hidden;margin-top:0;">
    <?php
    delete_like();
like();
if(isset($_GET['id'])) {
$uid = $_GET['id'];
    $query_user = "SELECT * FROM users WHERE user_id = {$uid}";                     
         $ausername = "";           
                    $select_user_query = mysqli_query($connection, $query_user);
                        while($row = mysqli_fetch_assoc($select_user_query)) {
                        $ausername = $row['username'];
                        }
 ?>
 <div class="nav-wrapper" style="height:20px;width:100%;margin:0;margin-bottom:-40px;">
     <nav class="navbar navbar-inverse navbar-fixed-top" style="position:fixed;top:0;width:100%;margin:0;background-color:rgba(09,58,57,1);">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header" style="text-align:center;padding:0 0 0 10px;">
                <a type="button" href="profile.php?id=<?php echo $uid; ?>" class="navbar-toggle" style="float:left;padding:5px;border:none;">
                    <span class="glyphicon glyphicon-arrow-left" style="font-size:15pt; color:lightgrey;"></span>
                    
                </a>
                <a   class="navbar-brand" href="index.php" style="font-family: 'Parisienne', cursive;font-size:18pt;text-align:center;color:white;display:inline-block;float:none;"><?php  echo $ausername;  ?></a>
                 <button type="button" onclick="location.href='camera.php'" class="navbar-toggle" style="float:right;padding:5px;border:none;">
                    <span class="fa fa-paper-plane" style="font-size:15pt; color:lightgrey;"></span>
                    
                </button>
                <script>
$(window).scroll(function() {
    var height = $(window).scrollTop();
    if (height > 100) {
        $('#back2Top').fadeIn();
    } else {
        $('#back2Top').fadeOut();
    }
});
$(document).ready(function() {
    $("#back2Top").click(function(event) {
        event.preventDefault();
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    });

});
</script>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    
                    <?php
                    
                    $query = "SELECT * FROM sections";
                    $select_all_sections_query = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($select_all_sections_query)) {
                        $section_title = $row['section_title'];
                        
                        echo "<li><a href='#'>{$section_title}</a></li>";
                    }
                    
                    ?>
                    
                    <li>
                        <a href="#">Profile</a>
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
     </div>

    <!-- Page Content -->
    <div class="container" style="padding:0 15px;margin:0;height:105%;width:100%;overflow-x:hidden;">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8" style="padding:0;">

                <?php
                
                    $thisid = $_SESSION['id'];
//                        $query = "SELECT * FROM content WHERE content_user_id = {$thisid} limit 27";
                   
                   
                    $query = "SELECT * FROM content WHERE content_user_id = {$uid} limit 27";
                    
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
                        
                    
                   $query_user = "SELECT * FROM users WHERE user_id = {$uid}";                     
                    
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
                                <span class="hashtag" style="font-size:7pt;">@freediving</span>
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
                            <span class="likes" style="font-size:10pt;"><a href="profile.php?id=<?php echo $content_user_id; ?>"><b><?php echo $ausername; ?> </b></a><span style="font-size:10pt;"><?php echo $content_text; ?> <span>more</span> </span></span>
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
                            <span class="dater" id="<?php echo $content_datetime; ?>" style="color:grey;font-size:8pt;"></span>
                        </div>
                    </div>
                
                </div>
                <hr style="margin:0;">
            <?php }} ?>

               

            </div>

<?php    }  
include "includes/sidebar.php"; 
?>
        </div>
<script>
    
    function timeSince(date) {
  var seconds = Math.floor((new Date() - date) / 1000);

  var interval = seconds / 31536000;

  if (interval > 1) {
    return Math.floor(interval) + " years ago";
  }
  interval = seconds / 2592000;
  if (interval > 1) {
    return Math.floor(interval) + " months ago";
  }
  interval = seconds / 86400;
  if (interval > 1) {
    return Math.floor(interval) + " days ago";
  }
  interval = seconds / 3600;
  if (interval > 1) {
    return Math.floor(interval) + " hours ago";
  }
  interval = seconds / 60;
  if (interval > 1) {
    return Math.floor(interval) + " minutes ago";
  }
  return Math.floor(seconds) + " seconds ago";
}
    var x = document.getElementsByClassName("dater");
    var i;
    for (i = 0; i < x.length; i++) {
    var jsdate = new Date(x[i].id); 
    jsdate = timeSince(jsdate);
    x[i].innerHTML = jsdate;
    }
</script>


     

    </div>

    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html> 