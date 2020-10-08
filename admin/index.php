
<?php 
//include "includes/db.php";
include "includes/header.php";
include "includes/navigation.php"; 
 if(!isset($_SESSION['id'])) {
       Header("Location: ../login.php");
    }

?>
        <div id="page-wrapper">

           

        <?php

if(isset($_GET['source'])) {
    $source = $_GET['source'];
} else {
    $source = '';
}

switch($source) {
        
        case 'edit_profile';
        include "includes/edit_profile.php";
        break;
        case 'followers';
        include "includes/followers.php";
        break;
        case 'following';
        include "includes/following.php";
        break;

        default:
        include "includes/profile.php";
        break;
}
?>

      
   <?php 
include "includes/footer.php";

?>
                    </div>
