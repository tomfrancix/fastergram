 </div>
    <!-- /#wrapper -->
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
<div class="bottom-navbar" style="width:100%;text-align:center;position:fixed;bottom:0;background-color:rgba(10,10,10,1);padding-top:0;padding-bottom:0;z-index:200;">
         
          <a href="../index.php" style="width:20%;text-align:center;float:left;padding:18px;">
                <span class="glyphicon glyphicon-home"></span>
            </a>
            <a href="../search.php" style="width:20%;text-align:center;float:left;padding:18px;">
                <span class="glyphicon glyphicon-search"></span>
            </a>
            <a href="posts.php?source=add_post" style="width:20%;text-align:center;float:left;padding:18px;">
               <span class="glyphicon glyphicon-camera"></span>
            </a>
    
            <a href="../notifications.php" style="width:20%;text-align:center;float:left;padding:18px;">
              <?php if(isset($_SESSION['id'])) {
                        $sessionid = $_SESSION['id'];
                    $query = "SELECT * FROM notifications WHERE note_to_user_id = '{$sessionid}' ORDER BY note_id DESC";
                    $select_all_notificationsa_query = mysqli_query($connection, $query);
                    $countnotificationsa = 0;
                    while($row = mysqli_fetch_assoc($select_all_notificationsa_query)) {
                        $note_status = $row['note_status'];
                    $note_from_user_id = $row['note_from_user_id'];
                    if($note_status == "Unchecked" && $note_from_user_id !== $sessionid) {
                        $countnotificationsa++;
                    }
                    }
                    if($countnotificationsa > 0) { ?>
                        <span class="glyphicon glyphicon-heart"></span><br>
        <span style="display:inline-block;position:fixed;width:5px;height:5px;border-radius:50%;background-color:red;margin:0 2px -25px -1px;padding:0;"></span>
                   <?php } else { ?>
                  <span class="glyphicon glyphicon-heart"></span>
                   <?php } } ?>
            </a>
    <?php if(isset($_SESSION['image'])) {
    ?>
    <a href="index.php" style="width:20%;text-align:center;float:left;background-color:transparent;padding-top:10px;">
               <span style="display:inline-block;border-radius:50%;border:1px solid white;"><img src="../images/<?php echo $_SESSION['image']; ?>" style="width:30px;height:30px;border-radius:50%;border:1px solid black;"></span><br>
        <span style="display:inline-block;position:fixed;width:5px;height:5px;border-radius:50%;background-color:red;margin:0 2px -35px -2px;padding:0;"></span>
            </a>
    <?php
} ?>
</div> 
 
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>