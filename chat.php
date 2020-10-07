<?php 
include "includes/db.php";
include "includes/header.php";
include "includes/navigation.php"; 
if(!isset($_SESSION['role'])) {
   
        header("Location: login.php");
}
$otheruser = 0;
 if(isset($_GET['id'])) {
    $otheruser = $_GET['id'];
 }
   if(isset($_SESSION['id'])) {
    $sessionid = $_SESSION['id'];

remove_like();
likeincomments();
?>
 <?php
   create_comment();
?>
    <!-- Page Content -->
   
<div class="container" style="padding:0 15px;height:100%;margin:0;width:100%;max-width:100vw;overflow-x:hidden;background-color:rgba(22,22,22,1);">

<div class="row">
    <?php
$auser_id = 0;
$ausername = "";
$aimage = "";
$query_user = "SELECT * FROM users WHERE user_id = $otheruser ";                     

$select_user_query = mysqli_query($connection, $query_user);
while($row = mysqli_fetch_assoc($select_user_query)) {
$user_id = escape($row['user_id']);
$username = escape($row['username']);
$image = escape($row['user_image']);
}
                ?>
<!-- Blog Entries Column -->
<div class="col-md-8" style="padding:0;">
    <div class="post" style="margin-bottom:10px;">
        <div class="container">
            <div class="row" style="text-align:center;padding-top:10px;padding-bottom:5px;width:100%;position:fixed;z-index:2000;background-color:rgba(22,22,22,1);top:0;">
                <?php $urlq = htmlspecialchars($_SERVER['HTTP_REFERER']); ?>
             
                <span style="float:none;padding:3px 10px 2px 10px;display:inline-block;margin-bottom:5px;font-weight:bold;font-size:14pt;">
                    <span><img src="images/<?php echo $image; ?>" style="width:30px;border-radius:50%;">  </span>  
                      <span style="color:white;margin-left:10px;">  @<?php echo $username; ?></span>
                
                </span>
               
            </div>
    <hr style="margin:0;opacity:0.1;" >
            <div class="row" style="padding:5px;padding-bottom:0;">
            <div style="width:100%;">
                <div style="width:20%;text-align:right;padding:8px;float:left;margin:0;display:inline-block;">
                    <img src="images/profile.jpg" style="width:30px;border-radius:50%;">
                </div>    
                <div style="width:80%;float:left;margin:0;display:inline-block;padding:8px;">
                    <div style="border:1px solid rgba(100,100,100,0.5);background-color:rgba(10,10,10,0.7);border-radius:12px;padding:8px;width:100%;">
                        <span style="color:lightgrey;line-height:17pt;">Hey man, you about?</span>
                    </div>
                </div>
            </div>
            </div> 
            
            <div class="row" style="padding:5px;padding-bottom:0;">
            <div style="width:100%;">
                   
                <div style="width:80%;float:left;margin:0;display:inline-block;padding:8px;">
                    <div style="border:1px solid rgba(100,100,100,0.5);background-color:rgba(10,10,10,0.7);border-radius:12px;padding:8px;width:100%;">
                        <span style="color:lightgrey;line-height:17pt;">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose.
</span>
                    </div>
                </div>
                <div style="width:20%;text-align:left;padding:8px;float:left;margin:0;display:inline-block;">
                    <img src="images/person11.jpg" style="width:30px;border-radius:50%;">
                </div> 
            </div>
            </div>
            
            <div class="row" style="padding:5px;padding-bottom:0;">
            <div style="width:100%;">
                <div style="width:20%;text-align:right;padding:8px;float:left;margin:0;display:inline-block;">
                    <img src="images/profile.jpg" style="width:30px;border-radius:50%;">
                </div>    
                <div style="width:80%;float:left;margin:0;display:inline-block;padding:8px;">
                    <div style="border:1px solid rgba(100,100,100,0.5);background-color:rgba(10,10,10,0.7);border-radius:12px;padding:8px;width:100%;">
                        <span style="color:lightgrey;line-height:17pt;">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose.
</span>
                    </div>
                </div>
            </div>
            </div> 
            
            
        </div> 
    </div> 
</div> 
        
            <br><br><br>
    <p style="color:darkgrey; text-align:center;font-size:10pt;">~No more messages~</p>
            <br><br><br>
            <br><br><br>
            <br><br><br>
<div class="container" style="width:100%;position:fixed;bottom:50px;padding:0 10px 15px 10px;background-color:rgba(22,22,22,1);border-top:1px solid rgba(100,100,100,0.4);z-index:100;">

<form action="" method="POST" enctype="multipart/form-data">
     <div class="container" style="padding:8px 10px;">
        <div class="row">
            <div class="w-20" style="width:30px;float:left;">
                <img src="images/profile.JPG" style="width:100%;border-radius:50%;">
            </div>
            <div class="w-80" style="min-width:85%;width:85%;float:left;padding:0 5px 5px 10px;">
                <textarea type="text" style="border:none;width:100%;background-color:rgba(22,22,22,1);color:white;" name="comment_text" id="textboxplace" placeholder="Message..."></textarea>
            </div>
            <input type="hidden" name="comment_content_id" id="contentid" value="<?php echo $content_id; ?>">
            <input type="hidden" name="comment_user_id" id="userid" value="<?php echo $sessionid; ?>">
            <input type="hidden" name="comment_to_user" id="commenttouser" value="<?php echo $content_user_id; ?>">
            <input type="hidden" name="comment_reply_user_id" id="commentreplyuserid" value="0">
            <input type="hidden" name="comment_reply_id" id="commentreplyid" value="0">
        </div>    
    </div>
    <input class="btn btn-primary" style="width:100%;background-color:rgba(10,10,10,0.5);border:1px dashed rgba(49,98,97,0.7);" type="submit" name="create_comment" value="Submit">

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
    </div>
    

<?php     
include "includes/sidebar.php"; 
?>
    
   

    </div>
<div class="bottom-navbar" style="width:100%;text-align:center;position:fixed;bottom:0;background-color:rgba(10,10,10,1);padding-top:5px;z-index:200;">
            <a href="index.php" style="width:25%;text-align:center;float:left;">
                <span class="glyphicon glyphicon-home"></span>
            </a>
            <a href="search.php" style="width:25%;text-align:center;float:left;">
                <span class="glyphicon glyphicon-search"></span>
            </a>
            <a href="camera.php" style="width:25%;text-align:center;float:left;">
               <span class="glyphicon glyphicon-camera"></span>
            </a>
            <a href="admin/index.php" style="width:25%;text-align:center;float:left;">
               <span class="glyphicon glyphicon-user"></span>
            </a>
</div> 
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html><?php

       }
 
?>   
  