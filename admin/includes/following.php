<div class="container-fluid">
    <div class="row" style="margin-top:-10px;">
        <label class="form-control" style="color:white;background-color:transparent;border:none;border-bottom:1px solid rgba(100,100,100,0.5);">People you follow</label>
<?php
        unfollowinguser();

if(isset($_SESSION['id'])) {
    $sessionid = $_SESSION['id'];
}
$query = "SELECT * FROM following WHERE follow_user_id = {$sessionid} ORDER BY follow_id DESC ";
$select_users_by_id = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_users_by_id)) {
    $follow_to_user_id = $row['follow_to_user_id'];
    $follow_to_user_id = $row['follow_to_user_id'];
    $follow_id = $row['follow_id'];
    

$queryQ = "SELECT * FROM users WHERE user_id = {$follow_to_user_id}";
$select_users_by_idQ = mysqli_query($connection, $queryQ);
$user_id = 0;
    $username = "";
    $user_image = "";
    $user_bio = "";
while($row = mysqli_fetch_assoc($select_users_by_idQ)) {
    $user_id = $row['user_id'];
    $username = $row['username'];
    $user_image = $row['user_image'];
    $user_bio = $row['user_bio'];
}    ?>


         
        <div class="row" style="width:100%;height:45px;padding:0 5px 5px 5px;margin:3px 0;border-bottom:1px solid rgba(100,100,100,0.3);">
                <div class="list-picture-div">
                <div class="list-picture-box">
                    <img src="../images/<?php echo $user_image; ?>">
                </div>
                </div>
                <div class="list-info-div">
                    <span class="fs-medium">
                        <a href="../profile.php?id=<?php echo $user_id; ?>"><b><?php echo $username; ?></b></a>
                    </span><br>
                    <span class="text-fade fs-small" style="color:chartreuse;">
                        Online
                    </span>
                </div>
                <div class="list-message-div">
                        <a  class="btn btn-success list-message-box" href="messages.php?source=chat&id=<?php echo $user_id; ?>" ><span class="glyphicon glyphicon-inbox" style="color:white;" ></span></a>
               </div>
                
<div class="list-follow-div">
          
                    
                    <a href="index.php?source=following&unfollowinguser=<?php echo $follow_id; ?>" type="submit" name="unfollowinguser"  style="text-align:center;width:100%;" class="btn btn-default dark">Unfollow</a>
               
            
                    
                </div>
            </div>
      <?php } 
 

                ?>


                        <br>
                        <br>
                        <br>
        
    </div>
</div>
<script> document.getElementById('navbar-header').innerHTML = "Following";</script>