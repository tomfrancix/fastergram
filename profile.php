<?php 
include "includes/db.php";
include "includes/header.php";
include "includes/navigation.php"; 
delete_like();
unfollow();
follow();
like();
 if(!isset($_SESSION['id'])) {
       Header("Location: login.php");
    }
 if(isset($_GET['id']) || isset($_GET['username'])) {
    
     if(isset($_GET['id'])) {
$uid = escape($_GET['id']);
     $user= "";
     }
     else if(isset($_GET['username'])) {
         $uid = 0;
        $user = escape($_GET['username']);
          $qquery = "SELECT * FROM users WHERE username = '$user'";
                    $select_quser_query = mysqli_query($connection, $qquery);
          while($row = mysqli_fetch_assoc($select_quser_query)) {
                        $uid = escape($row['user_id']);
          }
     }
 ?>

    <!-- Page Content -->
    <div class="container" style="padding:0 15px;height:100%;width:100%;overflow-x:hidden;">
      <div class="row">
          
<?php
                    if(isset($_GET['id']) || isset($_GET['username'])) {
                        if(isset($_GET['id'])) {
                        $uid = escape($_GET['id']);
                             
                    
                      $queryu = "SELECT * FROM users WHERE user_id = {$uid}";
                    $select_user_query = mysqli_query($connection, $queryu);
                   }
                             else if(isset($_GET['username'])){
                                $user = escape($_GET['username']); 
                      $queryu = "SELECT * FROM users WHERE username = '$user'";
                    $select_user_query = mysqli_query($connection, $queryu);
                             }
                    while($row = mysqli_fetch_assoc($select_user_query)) {
                        $user_id = escape($row['user_id']);
                        $user_image = escape($row['user_image']);  
                        $username = escape($row['username']);  
                        $user_bio = escape($row['user_bio']);  
                        $user_followers = escape($row['user_follower_count']);  
                        $user_following = escape($row['user_following_count']);  
                        $first_name = escape($row['first_name']);  
                        $last_name = escape($row['last_name']);  
                    ?>
          
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row" style="text-align:center;padding-top:5px;">
                             <?php $url = htmlspecialchars($_SERVER['HTTP_REFERER']); ?>
                            <span style="float:left;padding:5px 10px;"><a href="<?php echo $url; ?>"><span style="font-size:16pt;"class="glyphicon glyphicon-arrow-left"></span></a></span>
                            <span style="float:none;display:inline-block;margin-top:2px;padding:0;font-weight:bold;font-size:16pt;"><?php echo $first_name; ?> <?php echo $last_name; ?></span>
                            <span style="float:right;padding:5px 10px;"><span style="font-size:16pt;"class="glyphicon glyphicon-retweet"></span></span>
                        </div>
                        <hr style="margin:5px 0 8px 0;">
                        <ol style="text-align:center;list-style:none;width:100%;padding:0;">
                            <li style="float:left;width:24%;margin:0;padding:0;border:none;border-radius:7px;">
                                 <img src="images/<?php echo $user_image; ?>" style="width:80px;border-radius:50%;margin:0;margin-bottom:10px;"><br>
                                <span style="font-weight:bold;font-size:10pt;margin:0 0 8px -12px;">@<?php echo $username; ?> </span>
                                
                            </li>
                            <li style="float:left;width:24%;margin:1px;padding:10px;border-radius:7px;">
                                <span style="font-size:10pt;">27</span><br><i class="glyphicon glyphicon-camera"></i>  <br><a href="index.html">Uploads</a>
                            </li>
                            <li style="float:left;width:24%;margin:1px;padding:10px;border-radius:7px;">
                                <span style="font-size:10pt;color:black;"><?php echo $user_followers; ?></span><br><i class="fa fa-users"></i>  <br> <a href="connections.php?source=followers&id=<?php echo $user_id; ?>">Followers</a>
                            </li>
                            <li style="float:left;width:24%;margin:1px;padding:10px;border-radius:7px;">
                                <span style="font-size:10pt;"><?php echo $user_following; ?></span><br><i class="fa fa-users"></i>  <br> <a href="connections.php?source=following&id=<?php echo $user_id; ?>">Following</a>
                            </li>
                        </ol>
                       
                        
                    </div>
                </div>
                
               <span style="font-size:9pt"><?php echo $user_bio; ?></span><br>
<?php
if(isset($_SESSION['id'])) {

$dbuserid = $_SESSION['id'];

    if($dbuserid == $uid) { ?>
        <div style="margin-top:5px;text-align:center;width:100%;" class="btn btn-default">
                    <a href="?source=edit_profile&edit_profile=<?php echo $_SESSION['id']; ?>">Edit profile</a>
                </div>
   <?php } else { ?>
    <div class="container" style="padding-bottom:1px;text-align:center;width:105%;margin:0 -10px 0 -10px;padding:0;">
        <div style="text-align:center;padding:0 2px;margin-top:5px;width:33%;float:left;">
        <?php
                 $query_follow = "SELECT * FROM following WHERE follow_user_id = {$dbuserid}";                     

        $follow_query = mysqli_query($connection, $query_follow);
            $follow = false;
           $followc = 0;
            while($row = mysqli_fetch_assoc($follow_query)) {
            $follow_id = escape($row['follow_id']);
            $follow_to_user_id = escape($row['follow_to_user_id']);
            $followc++;
            if($follow_to_user_id == $user_id) {
                $follow = true;
            }
            }
        if ($followc > 0) {
        if ($follow == true) {
          ?>
              
                    <a href="profile.php?unfollow=<?php echo $follow_id; ?>" type="submit" name="unfollow"  style="text-align:center;width:100%;" class="btn btn-warning">Unfollow</a>
               
              <?php } else {
            ?> 
                <form method="post" action="" >
                    <input type="hidden" name="follow_user_id" value="<?php echo $dbuserid; ?>">
                    <input type="hidden" name="follow_to_user_id" value="<?php echo $user_id; ?>">
                    <button type="submit" name="follow"  style="text-align:center;width:100%;" class="btn btn-primary">Follow</button>
                </form>
            <?php
            }  
        } else { ?>
                <form method="post" action="" >
                    <input type="hidden" name="follow_user_id" value="<?php echo $dbuserid; ?>">
                    <input type="hidden" name="follow_to_user_id" value="<?php echo $user_id; ?>">
                    <button type="submit" name="follow"  style="text-align:center;width:100%;" class="btn btn-primary">Follow</button>
                </form>
             <?php }  ?>
        </div>
        <div style="text-align:center;padding:0 2px;margin-top:5px;width:33%;float:left;">
            <div style="text-align:center;width:100%;" class="btn btn-default">
                <a href="admin/messages.php?source=chat&id=<?php echo $user_id; ?>">Message</a>
            </div>
        </div>
        <div style="text-align:center;padding:0 2px;margin-top:5px;width:33%;float:left;">
            <div style="text-align:center;width:100%;" class="btn btn-default">
                <a href="?source=edit_profile&edit_profile=<?php echo $_SESSION['id']; ?>">Favourites</a>
            </div>
        </div>
        </div>
   <?php }
} 
?>
                
                
                

                <hr style="margin:5px 0 2px 0;">
        
            </div>
<?php } ?>
            <div class="container" style="padding:0; margin:0;">
                           
                <?php
                    $query = "SELECT * FROM content WHERE content_user_id = {$uid}";
                    $select_all_content_query = mysqli_query($connection, $query);
                   
                    while($row = mysqli_fetch_assoc($select_all_content_query)) {
                        $content_id = escape($row['content_id']);
                        $content_image = escape($row['content_image']);
                    
                    ?>
                            <a href="profile_gallery.php?id=<?php echo $uid; ?>#<?php echo $content_id; ?>">
<!--                 <a href="post.php?id=<?php echo $content_id; ?>">-->
                                <div class="pictures" style="float:left;width:25%;border:1px solid lightgrey;background-image:url('images/<?php echo $content_image; ?>');background-size:cover;">
                               
                            </div></a>
                
            <?php } ?>
                    </div>
            <!-- /.container-fluid -->
<br><br><br>
       <?php }  ?>
     

            <script>
                var x = document.getElementsByClassName("pictures");
                var i;
                for (i = 0; i < x.length; i++) {
                  x[i].style.height = ""+(window.screen.width)/4+"px";
                }
            </script>
                   
                    </div> <?php } ?>
<?php      
include "includes/footer.php"; 
        ?>   </div>