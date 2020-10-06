<?php
create_message();
$otheruser = 0;
 if(isset($_GET['id'])) {
    $otheruser = $_GET['id'];
 }
   if(isset($_SESSION['id'])) {
    $sessionid = $_SESSION['id'];
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color:transparent;">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header" style="text-align:center;padding:0 0 0 10px;background-color:rgba(10,10,10,1);">
                <a type="button" href="messages.php" class="navbar-toggle" style="float:left;padding:3px 3px 0 3px;border:none;">
                    <span class="glyphicon glyphicon-inbox" style="font-size:15pt; color:lightgrey;"></span>
                </a>
<?php if(isset($_SESSION['username'])) {

$dbusername = $_SESSION['username']; ?>
                    <?php
$user_id = 0;
$username = "";
$image = "";
$query_user = "SELECT * FROM users WHERE user_id = $otheruser ";                     

$select_user_query = mysqli_query($connection, $query_user);
while($row = mysqli_fetch_assoc($select_user_query)) {
$user_id = $row['user_id'];
$username = $row['username'];
$image = $row['user_image'];
}
                ?>
<a   class="navbar-brand" href="index.php" style="font-family: 'Parisienne', cursive;font-size:18pt;text-align:center;color:white;display:inline-block;float:none;"><?php echo $username; ?></a> <?php
} ?>
                <div class="navbar-toggle" style="float:right;padding:3px 3px 0 3px;border:none;visibility:hidden;">
                    <span class="glyphicon glyphicon-comment" style="font-size:15pt; color:lightgrey;"></span>
                </div>
            </div>
        </nav>    
<div id="page-wrapper">
<div class="container" id="messagecontainer"  style="padding:0 15px;height:100%;margin:0;width:100%;max-width:100vw;overflow-x:hidden;background-color:rgba(22,22,22,1);">

<div class="row">

<!-- Blog Entries Column -->
<div class="col-md-8" style="padding:0;">
    <div class="post" style="margin-bottom:10px;">
        <div class="container">
           
    <hr style="margin:0;opacity:0.1;" >
       <?php $query_messages = "SELECT * FROM messages WHERE message_to_user_id = $sessionid AND message_from_user_id = $otheruser OR message_to_user_id = $otheruser AND message_from_user_id = $sessionid";                     

$select_messages_query = mysqli_query($connection, $query_messages);
       $lastmessage = "";
while($row = mysqli_fetch_assoc($select_messages_query)) {
$message_id = $row['message_id'];
$message_to_user_id = $row['message_to_user_id'];
$message_from_user_id = $row['message_from_user_id'];
$message_content = $row['message_content'];
$message_status = $row['message_status'];

$query_user = "SELECT * FROM users WHERE user_id = $message_from_user_id ";                     

$select_user_query = mysqli_query($connection, $query_user);
while($row = mysqli_fetch_assoc($select_user_query)) {
$mimage = $row['user_image'];
  
   
            
if($message_to_user_id == $otheruser) {  
            
     $lastmessage = "sent";
            
            ?>
            <div class="row" style="padding:5px;padding-bottom:0;">
            <div style="width:100%;">
                <div style="width:20%;text-align:right;padding:8px;float:left;margin:0;display:inline-block;">
                    <img src="../images/<?php echo $mimage; ?>" style="width:30px;height:30px;border-radius:50%;">
                </div>    
                <div style="width:80%;float:left;margin:0;display:inline-block;padding:8px;">
                    <div style="border:1px solid rgba(100,100,100,0.5);background-color:rgba(10,10,10,0.7);border-radius:12px;padding:8px;width:100%;">
                        
                        <span style="color:chartreuse;line-height:17pt;"><?php echo $message_content; ?></span>
                    </div>
                </div>
            </div>
            </div>
            <?php } else if($message_to_user_id == $sessionid) { 
            
            $lastmessage = "Received"; ?>
            <div class="row" style="padding:5px;padding-bottom:0;">
            <div style="width:100%;">
                   
                <div style="width:80%;float:left;margin:0;display:inline-block;padding:8px;">
                    <div style="border:1px solid rgba(100,100,100,0.5);background-color:rgba(10,10,10,0.7);border-radius:12px;padding:8px;width:100%;">
                        <span style="color:lightgrey;line-height:17pt;"><?php echo $message_content; ?>
</span>
                    </div>
                </div>
                <div style="width:20%;text-align:left;padding:8px;float:left;margin:0;display:inline-block;">
                    <img src="../images/<?php echo $mimage; ?>" style="width:30px;height:30px;border-radius:50%;">
                </div> 
            </div>
            </div>
            <?php
            if($lastmessage == "Received") {
            $queryq = "UPDATE messages SET message_status = 'Checked' WHERE message_id = {$message_id} ";
            $update_messages_query = mysqli_query($connection, $queryq);
            }
 } } } 
            
            
            
            
            ?>


            
            
        </div> 
    </div> 
</div> 
        
            <br><br><br>
    <p style="color:darkgrey; text-align:center;font-size:10pt;">~No more messages~</p>
            <br><br><br>
            <br><br><br>
            <br><br><br>
<div class="container" style="width:100%;position:fixed;bottom:0;padding:0 10px 15px 10px;background-color:rgba(22,22,22,1);border-top:1px solid rgba(100,100,100,0.4);z-index:100;">

<form action="" method="POST" enctype="multipart/form-data">
     <div class="container" style="padding:8px 10px;">
        <div class="row">
            <div class="w-20" style="width:30px;height:30px;float:left;">
                <img src="../images/<?php echo $_SESSION['image']; ?>" style="width:100%;height:100%;border-radius:50%;">
            </div>
            <div class="w-80" style="min-width:85%;width:85%;float:left;padding:0 5px 5px 10px;">
                <textarea type="text" style="border:none;width:100%;background-color:rgba(22,22,22,1);color:white;" name="message_content" placeholder="Message..."></textarea>
            </div>
            <input type="hidden" name="message_to_user_id" value="<?php echo $user_id; ?>">
            <input type="hidden" name="message_from_user_id" value="<?php echo $sessionid; ?>">
            <input type="hidden" name="message_status"  value="Unchecked">
            <input type="hidden" name="message_image" value="">
        </div>    
    </div>
    <input class="btn btn-primary" style="width:100%;background-color:rgba(10,10,10,0.5);border:1px dashed rgba(49,98,97,0.7);" type="submit" name="create_message" value="Submit">

</form>

            </div>
          
    </div>
    </div>

    
   <?php } ?>

    </div>
<script>
    var el1 = parseInt(document.body.scrollHeight) - screen.height - 100;
    var el2 = parseInt(document.documentElement.scrollHeight) - screen.height - 100 ;
    console.log(el1);
    window.scrollTo(0, el1 || el2);
    
</script>
  