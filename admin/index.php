
<?php 
//include "includes/db.php";
include "includes/header.php";
include "includes/navigation.php"; 

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

        default:
        include "includes/profile.php";
        break;
}
?>

      
   <?php 
include "includes/footer.php";

?>
                    </div>
