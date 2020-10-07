<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color:transparent;">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header" style="text-align:center;padding:0 0 0 10px;background-color:rgba(10,10,10,1);">
                <a type="button" href="index.php" class="navbar-toggle" style="float:left;padding:3px 3px 0 3px;border:none;">
                    <span class="glyphicon glyphicon-arrow-left" style="font-size:15pt; color:lightgrey;"></span>
                </a>
<?php if(isset($_SESSION['username'])) {

$dbusername = $_SESSION['username']; ?>
<a   class="navbar-brand" href="index.php" style="font-family: 'Parisienne', cursive;font-size:18pt;text-align:center;color:white;display:inline-block;float:none;">Messages</a> <?php
} ?>
              
                 
                <a type="button" href="#" class="navbar-toggle" style="float:right;padding:3px 3px 0 3px;border:none;">
                    <span class="glyphicon glyphicon-comment" style="font-size:15pt; color:rgba(40,40,40,1);"></span>
                </a>
            </div>
        </nav>    
<div id="page-wrapper">
    <div class="container" style="padding:0 15px;height:100%;width:100%;overflow-x:hidden;background-color:rgba(22,22,22,1);">
        <div class="row">
            <div class="col-md-8" style="padding:0;">
                <div class="post">
                        <hr style="margin:0;">
                <?php
                 if(isset($_SESSION['id'])) {
                        $sessionid = $_SESSION['id'];
                    $query = "SELECT * FROM messages WHERE message_to_user_id = '{$sessionid}' OR message_from_user_id = '{$sessionid}' ORDER BY message_id DESC";
                    $select_all_messages_query = mysqli_query($connection, $query);
                    $countnotifications = 0;
                     $contacts = array("me"); 
                     while($row = mysqli_fetch_assoc($select_all_messages_query)) {
                        $message_id = $row['message_id'];
                        $message_to_user_id = $row['message_to_user_id'];
                        $message_from_user_id = $row['message_from_user_id'];
                        $message_content = $row['message_content'];
                        $message_image = $row['message_image'];
                        $message_status = $row['message_status'];
                        
                if($message_from_user_id == $sessionid) {
                    if($message_status == "Unchecked") {
                        
                         ?>
                <!-- First Blog Post -->
                
                <?php

                $query_user = "SELECT * FROM users WHERE user_id = {$message_to_user_id}";                     
                
                $select_user_query = mysqli_query($connection, $query_user);
                while($row = mysqli_fetch_assoc($select_user_query)) {
                $user_id = $row['user_id'];
                $username = $row['username'];
                $image = $row['user_image'];
                    if(in_array($username, $contacts) == FALSE) {
                array_push($contacts, $username);
                ?>    
                    <div class="container">
                            <div class="row" style="padding:8px; border-bottom:1px solid lightgrey;">
                            <div class="w-10" style="width:10%;float:left;padding-top:7px;">
                                <img src="../images/<?php echo $image; ?>" style="width:100%;border-radius:50%;">
                            </div>
                            <div class="w-75" style="width:75%;float:left;padding:5px;">
                                <span class="username"><a style="color:white;" href="profile.php?id=<?php echo $user_id ?>">
                               
                                    
                                <b><?php echo $username; ?>  </b>  </a><br></span>
                                
                                <a href="messages.php?source=chat&id=<?php echo $user_id; ?>">
                                <span style="font-size:10pt;color:lightgrey;"><span style="font-size:10pt;color:chartreuse;">You said: </span><?php echo $message_content; ?>  </span><br>
                                </a>
                            </div>
                            <div class="w-10" style="width:10%;float:left;padding:12px 8px 5px 0;">
                                <a href="messages.php?source=chat&id=<?php echo $user_id; ?>">
                                <div class="btn btn-warning" style="padding:2px 5px;" >Sent</div>
                                </a>    </div>
                            </div>
                         
                </div>
                           <?php } } ?>
               
            <?php
                    } 
                    else if($message_status == "Checked") {
                
                $query_user = "SELECT * FROM users WHERE user_id = {$message_to_user_id}";                     
                
                $select_user_query = mysqli_query($connection, $query_user);
                while($row = mysqli_fetch_assoc($select_user_query)) {
                $user_id = $row['user_id'];
                $username = $row['username'];
                $image = $row['user_image'];
                     if(in_array($username, $contacts) == FALSE ) {
                       
                         
                         
                array_push($contacts, $username);
                ?>     
                    <div class="container">
                            <div class="row" style="padding:8px; border-bottom:1px solid lightgrey;">
                            <div class="w-10" style="width:10%;float:left;padding-top:7px;">
                                <img src="../images/<?php echo $image; ?>" style="width:100%;border-radius:50%;">
                            </div>
                            <div class="w-75" style="width:75%;float:left;padding:5px;">
                                <span class="username"><a style="color:white;" href="profile.php?id=<?php echo $user_id ?>">
                               
                                    
                                <b><?php echo $username; ?>  </b>  </a><br></span>
                                
                                <a href="messages.php?source=chat&id=<?php echo $user_id; ?>">
                                <span style="font-size:10pt;color:lightgrey;"><span style="font-size:10pt;color:chartreuse;">You said: </span><?php echo $message_content; ?></span><br>
                                </a>
                            </div>
                            <div class="w-10" style="width:10%;float:left;padding:12px 8px 5px 0;">
                                <a href="messages.php?source=chat&id=<?php echo $user_id; ?>">
                                <div class="btn btn-success" style="padding:2px 5px;" >Seen</div>
                                </a>    </div>
                            </div>
                            </div>
                           <?php } } ?>
               
            <?php
                    }
                } 
                else {
                if($message_status == "Unchecked") {
                    ?>
            
                <?php

                $query_user = "SELECT * FROM users WHERE user_id = {$message_from_user_id}";                     
                
                $select_user_query = mysqli_query($connection, $query_user);
                while($row = mysqli_fetch_assoc($select_user_query)) {
                $user_id = $row['user_id'];
                $username = $row['username'];
                $image = $row['user_image'];
                     if(in_array($username, $contacts) == FALSE) {
                array_push($contacts, $username);
                   
                ?>    
                    <div class="container">
                            <div class="row" style="padding:8px; border-bottom:1px solid lightgrey;">
                            <div class="w-10" style="width:10%;float:left;padding-top:7px;">
                                <img src="../images/<?php echo $image; ?>" style="width:100%;border-radius:50%;">
                            </div>
                            <div class="w-75" style="width:75%;float:left;padding:5px;">
                                <span class="username"><a style="color:white;" href="profile.php?id=<?php echo $user_id ?>">
                               
                                    
                                <b><?php echo $username; ?>  </b>  </a><br></span>
                                
                                <a href="messages.php?source=chat&id=<?php echo $user_id; ?>">
                                <span style="font-size:10pt;color:lightgrey;"><?php echo $message_content; ?>  </span><br>
                                </a>
                            </div>
                            <div class="w-10" style="width:10%;float:left;padding:12px 8px 5px 0;">
                                <a href="messages.php?source=chat&id=<?php echo $user_id; ?>">
                                <div class="btn btn-info" style="padding:2px 5px;" >Reply</div>
                                </a>    </div>
                            </div>
                            </div>
                           <?php } } ?>
                
               
            <?php } 
                else if($message_status == "Checked" && $countnotifications < 10 ) {
                    ?>
            
                <?php

                $query_user = "SELECT * FROM users WHERE user_id = {$message_from_user_id}";                     
                
                $select_user_query = mysqli_query($connection, $query_user);
                while($row = mysqli_fetch_assoc($select_user_query)) {
                $user_id = $row['user_id'];
                $username = $row['username'];
                $image = $row['user_image'];
                 if(in_array($username, $contacts) == FALSE) {
                array_push($contacts, $username);
                   
                ?>     
                    <div class="container">
                           <div class="row" style="padding:8px; border-bottom:1px solid lightgrey;">
                            <div class="w-10" style="width:10%;float:left;padding-top:7px;">
                                <img src="../images/<?php echo $image; ?>" style="width:100%;border-radius:50%;">
                            </div>
                            <div class="w-75" style="width:75%;float:left;padding:5px;">
                                <span class="username"><a style="color:white;" href="profile.php?id=<?php echo $user_id ?>">
                               
                                    
                                <b><?php echo $username; ?>  </b>  </a><br></span>
                                
                                <a href="messages.php?source=chat&id=<?php echo $user_id; ?>">
                                <span style="font-size:10pt;color:lightgrey;"><?php echo $message_content; ?>  </span><br>
                                </a>
                            </div>
                            <div class="w-10" style="width:10%;float:left;padding:12px 8px 5px 0;">
                                <a href="messages.php?source=chat&id=<?php echo $user_id; ?>">
                                <div class="btn btn-default" style="background-color:rgba(10,10,10,1);color:grey;border:none;padding:5px 8px;" href="notifications.php?check=<?php echo $note_id; ?>"  >Seen</div>
                                   </a> </div>
                            </div>
                            </div>
                       
                           <?php  $countnotifications++; }  }?>
               
            <?php }  
                } 
                } 
                }?> 

                

            </div>
            </div>
            </div>
    </div></div>
       <?php 
include "includes/footer.php";

?>