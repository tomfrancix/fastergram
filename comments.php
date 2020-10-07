<?php 
include "includes/db.php";
include "includes/header.php";
if(!isset($_SESSION['role'])) {
   
        header("Location: login.php");
    
}
remove_like();
likeincomments();
likecomment();
deletecomlike();
?>
 <?php
   create_comment();
?>
    <!-- Page Content -->
    <div class="container" style="padding:0 15px;margin-top:10px;height:100%;width:100%;overflow-x:hidden;background-color:white;">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8 p0">
<!--GET THE SPECIFIC POST-->
                <?php
                 if(isset($_SESSION['id'])) {
                        $sessionid = $_SESSION['id'];
                     if(isset($_SESSION['image'])) {
                        $sessionimage = $_SESSION['image'];
                    if(isset($_GET['id'])) {
                        $pid = escape($_GET['id']);
                    $query = "SELECT * FROM content WHERE content_id = '{$pid}'";
                    $select_all_content_query = mysqli_query($connection, $query);
                   
                    while($row = mysqli_fetch_assoc($select_all_content_query)) {
                        $content_id = escape($row['content_id']);
                        $content_text = escape($row['content_text']);
                        $content_datetime = escape($row['content_datetime']);
                        $content_user_id = escape($row['content_user_id']);
                        $content_hash_id = escape($row['content_hash_id']);
                        $content_comment_count = escape($row['content_comment_count']);
                        $content_likes_count = escape($row['content_likes_count']);
                        
                        
                    ?>
                                        

                
<!--DISPLAY THE POST-->
                <div class="post post-index">
                    <div class="container">
                        <div class="row ahn-row">
                           
                            <span class="ahn-row-left">
                                <a href="index.php#<?php echo $content_id; ?>">
                                    <span class="glyphicon glyphicon-arrow-left"></span>
                                </a>
                            </span>
                            <span class="ahn-row-center">Comments</span>
                            
                        </div>
                        <hr class="m0">
                        <div class="row comments-row">
                <?php

                $query_user = "SELECT * FROM users WHERE user_id = {$content_user_id}";                     

                $select_user_query = mysqli_query($connection, $query_user);
                while($row = mysqli_fetch_assoc($select_user_query)) {
                $user_id = escape($row['user_id']);
                $username = escape($row['username']);
                $image = escape($row['user_image']);
                ?>    
                            <div class="post-picture-div" >
                                <img src="images/<?php echo $image; ?>" class="post-picture-div-image">
                            </div>
                            <div class="post-single-info-div">
                                <span class="username c-b">
                                    <a href="profile.php?id=<?php echo $user_id ?>">
                                        <b><?php echo $username; ?>  </b>  
                                    </a>
                                </span>
                                <span class="fs-medium"><?php echo $content_text; ?> <span>more</span> 
                                </span><br>
                                <span class="hashtag fs-small">#freediving</span>
                                <br>
                                <span class="text-fade fs-tiny">11 hours ago</span>
                            </div>
                            <div class="post-single-info-like">
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
                                <span class="hashtag fs-small" ><a href="comments.php?remove_like=<?php echo $likeid; ?>"><span class="glyphicon glyphicon-heart comments-remove-like"></span></a></span>
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
                    <button type="submit" name="likeincomments" class="post-submit-like-button">    
                        <img src="images/heart.svg" class="comment-like-button-img">
                    </button>
                </form>
              <?php }
               } 
                ?>
            </div>
<?php } ?>
        </div>
                        
    <hr class="m0 mb-8">
<!--DISPLAY THE COMMENTS-->
                         <?php
                    if($content_comment_count == 0) {
                        ?> <p class="no-comments">~No comments to show~</p> <?php
                    }
                    $querytwo = "SELECT * FROM comments";
                    $select_all_comments_query = mysqli_query($connection, $querytwo);
                   
                    while($row = mysqli_fetch_assoc($select_all_comments_query)) {
                        $comment_id = escape($row['comment_id']);
                        $comment_content_id = escape($row['comment_content_id']);
                        $comment_text = escape($row['comment_text']);
                        $comment_user_id = escape($row['comment_user_id']);
                        $comment_reply_user_id = escape($row['comment_reply_user_id']);
                        $comment_reply_id = escape($row['comment_reply_user_id']);
                        $comment_like_count = escape($row['com_like_count']);
                 
                        
                    ?>
                        <?php if($comment_content_id == $content_id && $comment_reply_user_id == 0) { ?>
                        <div id="comment<?php echo $comment_id; ?>" class="row comment-row">
                            
               <?php

                $query_cuser = "SELECT * FROM users WHERE user_id = {$comment_user_id}";                     

                $select_cuser_query = mysqli_query($connection, $query_cuser);
                while($row = mysqli_fetch_assoc($select_cuser_query)) {
                $cuser_id = escape($row['user_id']);
                $cusername = escape($row['username']);
                $cimage = escape($row['user_image']);
                ?> 
                            <div class="container comment-row-container" >
                            <div class="comment-picture-div" >
                                <img src="images/<?php echo $cimage; ?>" class="post-picture-div-image">
                            </div>
                            <div class="comment-info-div">
                                <span class="username c-b">
                                    <a  href="profile.php?id=<?php echo $user_id ?>">
                                        <b><?php echo $cusername; ?></b>
                                    </a>
                                </span>
                                <span class="fs-medium"> <?php echo $comment_text; ?> </span><br>
                                <span class="text-fade fs-tiny">11 hours ago</span> |  
                                <?php if($comment_like_count == 1 ) { ?>
                                <span class="hashtag fs-small">
                                    <a href="#">1 likes</a>
                                </span> | 
                                <?php } else if($comment_like_count > 1) { ?> 
                                <span class="hashtag fs-small">
                                    <a href="#"><?php echo $comment_like_count; ?> likes</a>
                                </span> | 
                                <?php } else { ?> 
                                <?php }?>
                                <span class="hashtag fs-small">
                                    <a onclick="replyform(<?php echo $cuser_id; ?>,'<?php echo $cusername ?>',<?php echo $comment_content_id; ?>,<?php echo $comment_id; ?>)">Reply</a>
                                </span> |
                <?php 
                  $query_like = "SELECT * FROM comlikes WHERE comlike_comment_id = $comment_id";
                  $select_users_like_query = mysqli_query($connection, $query_like);
                  $did_user_like = false;
                  while($row = mysqli_fetch_assoc($select_users_like_query)) {
                      $comlike_id = escape($row['comlike_id']);
                      $comlike_user_id = escape($row['comlike_user_id']);
                      $comlike_comment_id = escape($row['comlike_comment_id']);
                  if($comlike_user_id == $sessionid) { ?>
                        <span class="hashtag fs-small"><a href="comments.php?deletecomlike=<?php echo $comlike_id; ?>&postcom=<?php echo $content_id; ?>&commentid=<?php echo $comment_id; ?>"><span class="glyphicon glyphicon-heart comment-remove-like" ></span></a></span>
                               
                  <?php 
                      $did_user_like = true;
                      break; } else {
                      continue;
                  }
                  }
                  if($did_user_like == false) { ?>
            <span class="hashtag fs-small">|  
                 <form method="post" action="" class="subscribe-form">
                    <input type="hidden" name="comlike_user_id" value="<?php echo $sessionid; ?>">
                    <input type="hidden" name="comlike_comment_id" value="<?php echo $comment_id; ?>">
                    <input type="hidden" name="comlike_content_id" value="<?php echo $content_id; ?>">
                    <button type="submit" name="likecomment" class="post-submit-like-button ml-10"> 
                        <img src="images/heart.svg" class="comment-submit-like-img"></button>
                </form>
            </span>
                 <?php }
                ?>   
                </div>
            </div>
                            <?php }
                                $secondquery = "SELECT * FROM comments WHERE comment_content_id = {$content_id}";
                                $select_all_replies_query = mysqli_query($connection, $secondquery);                            
                                while($row = mysqli_fetch_assoc($select_all_replies_query)) {
                                    $replying_id = escape($row['comment_id']);
                                    $reply_text = escape($row['comment_text']);
                                    $reply_user_id = escape($row['comment_user_id']);
                                    $reply_uid = escape($row['comment_reply_user_id']);
                                    $reply_id = escape($row['comment_reply_id']);
                                    $reply_like_count = escape($row['com_like_count']);
                                    $reply_content_id = escape($row['comment_content_id']);
                                   
                                if($reply_uid == $comment_user_id && $reply_id == $comment_id) {
                            ?>
<!--                            NESTED COMMENTS-->
                            <div  id="comment<?php echo $replying_id; ?>" class="container reply-container" >
                                <div class="container">
                                <div class="row">
                                    <?php

                $query_ruser = "SELECT * FROM users WHERE user_id = {$reply_user_id}";                     

                $select_ruser_query = mysqli_query($connection, $query_ruser);
                while($row = mysqli_fetch_assoc($select_ruser_query)) {
                $ruser_id = escape($row['user_id']);
                $rusername = escape($row['username']);
                $rimage = escape($row['user_image']);
                ?> 
                                    <div class="reply-picture-div">
                                        <img src="images/<?php echo $rimage; ?>" class="post-picture-div-image">
                                    </div>
                                    <div class="reply-info-div" >
                                        <span class="username c-b"><a href="profile.php?id=<?php echo $user_id; ?>"><b><?php echo $rusername; ?></b></a></span>
                                        
                                        <span class="allreplies fs-medium">
                                        
                                        <?php echo $reply_text; ?> </span>
                                        <br>
                                        <span class="text-fade fs-tiny">11 hours ago</span> | 
                                        <?php if($reply_like_count == 1 ) { ?>
                                        <span class="hashtag fs-small" ><a href="#">1 like</a></span> | 
                                        <?php } else if($reply_like_count > 1) { ?> 
                                        <span class="hashtag fs-small"><a href="#"><?php echo $reply_like_count; ?> likes</a></span> | 
                                        <?php } else { ?> 
                                        <?php } ?> 
                                        <span class="hashtag fs-small"><a onclick="replyform(<?php echo $ruser_id; ?>,'<?php echo $rusername ?>',<?php echo $reply_content_id; ?>,<?php echo $reply_id; ?>)">Reply</a></span> | 
                                        
                                        <?php 
                  $query_like = "SELECT * FROM comlikes WHERE comlike_comment_id = $replying_id";
                  $rselect_users_like_query = mysqli_query($connection, $query_like);
                  $did_users_like = false;
                  while($row = mysqli_fetch_assoc($rselect_users_like_query)) {
                      $rcomlike_id = escape($row['comlike_id']);
                      $rcomlike_user_id = escape($row['comlike_user_id']);
                      $rcomlike_comment_id = escape($row['comlike_comment_id']);
                  if($rcomlike_user_id == $sessionid) { ?>
                        <span class="hashtag fs-small"><a href="comments.php?deletecomlike=<?php echo $rcomlike_id; ?>&postcom=<?php echo $reply_content_id; ?>&commentid=<?php echo $replying_id; ?>"><span class="glyphicon glyphicon-heart comment-remove-like"></span></a></span>
                                      
                               
                  <?php 
                      $did_users_like = true;
                      break; } else { 
                      continue;
                  }
                  }
                  if($did_users_like == false) { ?>
                                <span class="hashtag fs-small">  
                 <form method="post" action="" class="subscribe-form">
                    <input type="hidden" name="comlike_user_id" value="<?php echo $sessionid; ?>">
                    <input type="hidden" name="comlike_comment_id" value="<?php echo $replying_id; ?>">
                    <input type="hidden" name="comlike_content_id" value="<?php echo $content_id; ?>">
                    <button type="submit" name="likecomment" class="post-submit-like-button"> <img src="images/heart.svg" class="comment-submit-like-img"></button>
                                    </form></span>
                 <?php }
                    
                ?>
                                    </div>
                                    <?php } ?>
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
            <?php } } ?>

                <br><br><br><br>

            </div>
            <div class="container input-container">

<form action="" method="POST" enctype="multipart/form-data">
     <div class="container input-form-container">
        <div class="row">
            <div class="input-picture-div">
                <img src="images/<?php echo $sessionimage; ?>" class="post-picture-div-image">
            </div>
            <div class="input-text-box">
                <textarea type="text" name="comment_text" id="textboxplace" placeholder="Add a comment..."></textarea>
            </div>
            <input type="hidden" name="comment_content_id" id="contentid" value="<?php echo $content_id; ?>">
            <input type="hidden" name="comment_user_id" id="userid" value="<?php echo $sessionid; ?>">
            <input type="hidden" name="comment_to_user" id="commenttouser" value="<?php echo $content_user_id; ?>">
            <input type="hidden" name="comment_reply_user_id" id="commentreplyuserid" value="0">
            <input type="hidden" name="comment_reply_id" id="commentreplyid" value="0">
        </div>    
    </div>
    <input class="btn btn-primary input-submit-button" type="submit" name="create_comment" value="Submit">

</form>

            </div>
            <script>
                function replyform(id,name,content,comment) {
                    var contentid = document.getElementById('contentid');
                    var commenttouser = document.getElementById('commenttouser');
                    var commentreplyid = document.getElementById('commentreplyid');
                    var commentreplyuserid = document.getElementById('commentreplyuserid');
                    var textboxplace = document.getElementById('textboxplace');
                   
                    contentid.value = content;
                    commenttouser.value = id;
                    commentreplyid.value = comment;
                    commentreplyuserid.value = id;
                    textboxplace.value = "@" + name + " ";
                    console.log(id,name,content,comment);
                }
                var x = document.getElementsByClassName("allreplies");
                var i;
                for (i = 0; i < x.length; i++) {

                    var str = x[i].innerText;
                    var firstword = str.split(" ")[0];
                    var username = firstword.substring(1,firstword.length);
                    str = str.substring(firstword.length, str.length);
                    x[i].innerHTML = "<span><a href='profile.php?username="+username+"' style='color:deepskyblue'>"+firstword+" </a>"+str+"</span>";
                    console.log(firstword);
//                    firstword.style.color = 'red';
                }
            </script>

<?php    }  
?>
        </div>
<hr>

<!-- Footer -->
    
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

  