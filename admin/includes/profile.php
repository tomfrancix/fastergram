

            <div class="container-fluid">


                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <ol style="text-align:center;list-style:none;width:100%;padding:0;">
                            <li style="float:left;width:24%;margin:0;padding:0;border:none;border-radius:7px;">
                                 <img src="../images/<?php echo $_SESSION['image']; ?>" style="width:80px;border-radius:50%;margin:0;margin-bottom:10px;"><br>
                                <span style="font-weight:bold;font-size:10pt;margin:0 0 8px 0;">@<?php echo $_SESSION['username']; ?> </span>
                                
                            </li>
                            <li style="float:left;width:24%;margin:1px;padding:10px 10px 10px 20px;border-radius:7px;">
                                <span>27</span><br><i class="fa fa-camera"></i>  <br><a href="index.html" style="font-size:8pt;">Uploads</a>
                            </li>
                            <li style="float:left;width:24%;margin:1px;padding:10px 10px 10px 20px;border-radius:7px;">
                                <span><?php echo $_SESSION['follower']; ?></span><br><i class="fa fa-users"></i>  <br> <a href="index.html" style="font-size:8pt;">Followers</a>
                            </li>
                            <li style="float:left;width:24%;margin:1px;padding:10px 10px 10px 20px;border-radius:7px;">
                                <span><?php echo $_SESSION['following']; ?></span><br><i class="fa fa-users"></i>  <br> <a href="index.html" style="font-size:8pt;">Following</a>
                            </li>
                        </ol>
                       
                        
                    </div>
                </div>
                
               <span style="font-size:9pt"><?php echo $_SESSION['bio']; ?></span><br>
                <div class="row" style="padding:8px 8px 0 8px;">
                <div style="margin-top:5px;text-align:center;width:100%;background-color:rgba(10,10,10,1);border:1px dashed rgba(100,100,100,0.4);" class="btn btn-default">
                    <a href="?source=edit_profile&edit_profile=<?php echo $_SESSION['id']; ?>" style="color:grey;">Edit profile</a>
                </div>
                </div>
                <div class="row" style="padding:0 8px;">
                    <div style="width:33%;float:left;padding:0 3px;">
                        <div style="margin-top:5px;text-align:center;width:100%;background-color:rgba(10,10,10,1);border:1px solid rgba(100,100,100,0.3);" class="btn btn-default">
                            <a href="messages.php" style="color:grey;font-size:10pt;">Messages</a>
                        </div>
                    </div>
                    <div style="width:33%;float:left;padding:0 3px;">
                        <div style="margin-top:5px;text-align:center;width:100%;background-color:rgba(10,10,10,1);border:1px solid rgba(100,100,100,0.3);" class="btn btn-default">
                            <a href="?source=edit_profile&edit_profile=<?php echo $_SESSION['id']; ?>" style="color:grey;font-size:10pt;">Insights</a>
                        </div>
                    </div>
                    <div style="width:33%;float:left;padding:0 3px;">
                        <div style="margin-top:5px;text-align:center;width:100%;background-color:rgba(10,10,10,1);border:1px solid rgba(100,100,100,0.3);" class="btn btn-default">
                            <a href="hashtags.php" style="color:grey;font-size:8pt;">Subscriptions</a>
                        </div>
                    </div>
                
                </div>
                
                

                <hr style="margin:5px 0 2px 0;border-color:rgba(100,100,100,0.3);">
                
                <div class="row">
                    <div style="width:50%;float:left;text-align:center;padding:5px 5px 0px 5px;background-color:rgba()">
                        <span style="color:white;font-size:14pt;" class="glyphicon glyphicon-picture"></span>
                    </div>
                    <div style="width:50%;float:left;text-align:center;padding:5px 5px 0px 5px;border-left:1px solid rgba(100,100,100,0.3);">
                        <span style="color:white;font-size:16pt;" class="glyphicon glyphicon-star"></span>
                    </div>
                </div>
                <hr style="margin:5px 0 2px 0;border-color:rgba(100,100,100,0.2);">
        
            </div>
            <div class="container" style="padding:0; margin:0;">
                           
                <?php
                    $loggedin = $_SESSION['id']; 
                    $query = "SELECT * FROM content WHERE content_user_id = '{$loggedin}'";
                    $select_all_content_query = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($select_all_content_query)) {
                        $content_id = escape($row['content_id']);
                        $content_image = escape($row['content_image']);
                        
                    ?>
                            <a href="../post.php?id=<?php echo $content_id; ?>"><div class="pictures" style="float:left;width:25%;border:1px solid rgba(20,20,20,0.7);background-image:url('../images/<?php echo $content_image; ?>');background-size:cover;">
                               
                            </div></a>
                
            <?php } ?>
                    </div>
            <!-- /.container-fluid -->
<br><br><br>
       
     

            <script>
                var x = document.getElementsByClassName("pictures");
                var i;
                for (i = 0; i < x.length; i++) {
                  x[i].style.height = ""+(window.screen.width)/4+"px";
                }
            </script>