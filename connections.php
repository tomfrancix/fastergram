
<!------------------------------------------>
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
if(isset($_GET['source'])) {
    $source = $_GET['source'];
} else {
    $source = '';
}

switch($source) {
        
        case 'followers';
        include "includes/followers.php";
        break;
        case 'following';
        include "includes/following.php";
        break;
} ?>    
          
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
                   
                    </div> 
   <?php 
include "includes/footer.php";

?>



<!------------------------------>

 
