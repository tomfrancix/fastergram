<?php 
//include "includes/db.php";
include "includes/header.php";


?>


           

        <?php

if(isset($_GET['source'])) {
    $source = $_GET['source'];
} else {
    $source = '';
}

switch($source) {
        
        case 'chat';
        include "includes/chat.php";
        break;

        default:
        include "includes/conversations.php";
        break;
}
?>

      

                    </div>
