<?php ob_start();  ?>
<?php session_start();  
include "../includes/db.php"; 
if(isset($_SESSION['username'])) {
   
        $dbusername = $_SESSION['username'];
    
} ?>

<?php include "functions.php"; ?>
<?php 

if(!isset($_SESSION['role'])) {
   
        header("Location: ../login.php");
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Vortex</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="css/sb-adminstyle.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div id="wrapper" style="max-width:560px;">
          <?php  
    
    $query = "SELECT * FROM users WHERE username = '{$_SESSION['username']}' ";
    $select_user_query = mysqli_query($connection, $query);
    
    if(!$select_user_query) {
        die("QUERY FAILED ." . mysqli_error($connection));
    }
    
    while($row = mysqli_fetch_array($select_user_query)) {
       $db_bio = $row['user_bio'];
       $db_image = $row['user_image'];
       $db_following = $row['user_following_count'];
       $db_follower = $row['user_follower_count'];
       $db_uploads = $row['upload_count'];
    }
        $_SESSION['bio'] = $db_bio;
        $_SESSION['image'] = $db_image;
        $_SESSION['following'] = $db_following;
        $_SESSION['follower'] = $db_follower;
        $_SESSION['uploads'] = $db_uploads;
    ?>
        