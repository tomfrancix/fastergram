<?php if(isset($_GET['id'])) { 
    $profileid = $_GET['id'];
    
$queryQ = "SELECT * FROM users WHERE user_id = {$profileid}";
$select_users_by_idQ = mysqli_query($connection, $queryQ);
$puser_id = 0;
    $pusername = "";
    $puser_image = "";
    $puser_bio = "";
while($row = mysqli_fetch_assoc($select_users_by_idQ)) {
    $puser_id = $row['user_id'];
    $pusername = $row['username'];
    $puser_image = $row['user_image'];
    $puser_bio = $row['user_bio'];
}    ?>

<div class="container-fluid">
    <div class="row">
        <label class="form-control" style="color:black;background-color:transparent;border:none;border-bottom:1px solid rgba(100,100,100,0.5);">People <span>@<?php echo $pusername; ?></span> follows</label>
<?php
        unfollowinguser();
        followinguser();

if(isset($_SESSION['id'])) {
    $sessionid = $_SESSION['id'];
}
$query = "SELECT * FROM following WHERE follow_user_id = {$puser_id} ORDER BY follow_id DESC ";
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
                    <img src="images/<?php echo $user_image; ?>">
                </div>
                </div>
                <div class="list-info-div">
                    <span class="fs-medium">
                        <a href="profile.php?id=<?php echo $user_id; ?>"><b><?php echo $username; ?></b></a>
                    </span><br>
                    <span class="text-fade fs-small" style="color:chartreuse;">
                        Online
                    </span>
                </div>
                <div class="list-message-div">
                        <a  class="btn btn-success list-message-box" href="messages.php?source=chat&id=<?php echo $user_id; ?>" ><span class="glyphicon glyphicon-inbox" style="color:white;" ></span></a>
               </div>
                
<div class="list-follow-div">
            <?php 
    
$uquery = "SELECT * FROM following WHERE follow_user_id = {$sessionid} ";
$follow_query = mysqli_query($connection, $uquery);
$following = false;
while($row = mysqli_fetch_assoc($follow_query)) {
$ufollow_id = escape($row['follow_id']);
$ufollow_to_user_id = escape($row['follow_to_user_id']);
$ufollow_user_id = escape($row['follow_user_id']);

if($ufollow_to_user_id == $user_id) {    $following = true;  ?>
                    
                    <a href="connections.php?source=following&unfollowinguser=<?php echo $ufollow_id; ?>&id=<?php echo $puser_id; ?>" type="submit" name="unfollowuser"  style="text-align:center;width:100%;" class="btn btn-default dark">Unfollow</a>
               
              <?php } 
 }
if(!$following) { ?>
    <form method="post" action="" >
                    <input type="hidden" name="follow_user_id" value="<?php echo $sessionid; ?>">
                    <input type="hidden" name="follow_to_user_id" value="<?php echo $user_id; ?>">
         <input type="hidden" name="user_id" value="<?php echo $puser_id; ?>">
                    <button type="submit" name="followinguser"  style="text-align:center;width:100%;" class="btn btn-primary">Follow</button>
                </form> <?php
}
                ?>
                    
                </div>
            </div>
      <?php } 
 

                ?>


                        <br>
                        <br>
                        <br>
        
    </div>
    <script> 
    document.getElementById('navbar-header').innerHTML = "Following";
    var topleft = document.getElementById('top-left-button');
    topleft.innerHTML = "<a id='top-left-button' type='button' href='profile.php?id=<?php echo $puser_id; ?>' class='navbar-toggle nb-l'><span class='glyphicon glyphicon-arrow-left nb-icon'></span></a>";
</script>
    <?php } ?>
</div>