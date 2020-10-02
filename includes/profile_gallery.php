 <?php
                    if(isset($_GET['id'])) {
                        $uid = $_GET['id'];
                    
                      $queryu = "SELECT * FROM users WHERE user_id = {$uid}";
                    $select_user_query = mysqli_query($connection, $queryu);
                   
                    while($row = mysqli_fetch_assoc($select_user_query)) {
                        $user_id = $row['user_id'];
                        $user_image = $row['user_image'];  
                        $username = $row['username'];  
                        $user_bio = $row['user_bio'];  
                        $user_followers = $row['user_follower_count'];  
                        $user_following = $row['user_following_count'];  
                    ?>
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <ol style="text-align:center;list-style:none;width:100%;padding:0;">
                            <li style="float:left;width:24%;margin:0;padding:0;border:none;border-radius:7px;">
                                 <img src="../images/<?php echo $user_image; ?>" style="width:80px;border-radius:50%;margin:0;margin-bottom:10px;"><br>
                                <span style="font-weight:bold;font-size:10pt;margin:0 0 8px -12px;">@<?php echo $username; ?> </span>
                                
                            </li>
                            <li style="float:left;width:24%;margin:1px;padding:10px;border-radius:7px;">
                                <span style="font-size:10pt;">27</span><br><i class="fa fa-camera"></i>  <br><a href="index.html">Uploads</a>
                            </li>
                            <li style="float:left;width:24%;margin:1px;padding:10px;border-radius:7px;">
                                <span style="font-size:10pt;"><?php echo $user_followers; ?></span><br><i class="fa fa-users"></i>  <br> <a href="index.html">Followers</a>
                            </li>
                            <li style="float:left;width:24%;margin:1px;padding:10px;border-radius:7px;">
                                <span style="font-size:10pt;"><?php echo $user_following; ?></span><br><i class="fa fa-users"></i>  <br> <a href="index.html">Following</a>
                            </li>
                        </ol>
                       
                        
                    </div>
                </div>
                
               <span style="font-size:9pt"><?php echo $user_bio; ?></span><br>
                <div style="margin-top:5px;text-align:center;width:100%;" class="btn btn-default">
                    <a href="?source=edit_profile&edit_profile=<?php echo $_SESSION['id']; ?>">Edit profile</a>
                </div>
                
                

                <hr style="margin:5px 0 2px 0;">
        
            </div>
<?php } ?>
            <div class="container" style="padding:0; margin:0;">
                           
                <?php
                    $query = "SELECT * FROM content WHERE content_user_id = {$uid}";
                    $select_all_content_query = mysqli_query($connection, $query);
                   
                    while($row = mysqli_fetch_assoc($select_all_content_query)) {
                        $content_id = $row['content_id'];
                        $content_image = $row['content_image'];
                    
                    ?>
                            <a href="../post.php?id=<?php echo $content_id; ?>"><div class="pictures" style="float:left;width:25%;border:1px solid lightgrey;background-image:url('../images/<?php echo $content_image; ?>');background-size:cover;">
                               
                            </div></a>
                
            <?php } ?>
                    </div>
            <!-- /.container-fluid -->
<br><br><br>
       <?php } ?>
     

            <script>
                var x = document.getElementsByClassName("pictures");
                var i;
                for (i = 0; i < x.length; i++) {
                  x[i].style.height = ""+(window.screen.width)/4+"px";
                }
            </script>