<?php 
//MAKE SESSION AVAILABLE
session_start();
?>

<?php


        //CANCEL SESSION
        $_SESSION['id'] = null;
        $_SESSION['username'] = null;
        $_SESSION['email'] = null;
        $_SESSION['bio'] = null;
        $_SESSION['image'] = null;
        $_SESSION['role'] = null;
        $_SESSION['following'] = null;
        $_SESSION['follower'] = null;

header("Location: ../login.php");


?>