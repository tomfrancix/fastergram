<?php 
include "db.php";

//MAKE SESSION AVAILABLE
session_start();
?>

<?php

if(isset($_POST['login'])) {
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $username = mysqli_real_escape_string($connection, $username);
    
    $password = mysqli_real_escape_string($connection, $password);
    
    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_query = mysqli_query($connection, $query);
    
    if(!$select_user_query) {
        die("QUERY FAILED ." . mysqli_error($connection));
    }
    
    while($row = mysqli_fetch_array($select_user_query)) {
       $db_id = $row['user_id'];
       $db_username = $row['username'];
       $db_email = $row['email'];
       $db_bio = $row['user_bio'];
       $db_password = $row['password'];
       $db_image = $row['user_image'];
       $db_following = $row['user_following_count'];
       $db_follower = $row['user_follower_count'];
       $db_role = $row['role'];
       $db_uploads = $row['upload_count'];
        
        
    }
    
    $hash_password = crypt($password, $db_password);
    
    if($username !== $db_username && $hash_password !== $db_password ) {
        header("Location: ../login.php");
    } 
    else if ($username == $db_username && $hash_password == $db_password) 
    {
        //ASSIGN USER TO A UNIQUE SESSION
        $_SESSION['id'] = $db_id;
        $_SESSION['username'] = $db_username;
        
        if ($db_email) {
        $_SESSION['email'] = $db_email;
        }
        $_SESSION['bio'] = $db_bio;
        $_SESSION['image'] = $db_image;
        $_SESSION['role'] = $db_role;
        $_SESSION['following'] = $db_following;
        $_SESSION['follower'] = $db_follower;
        $_SESSION['uploads'] = $db_uploads;
        
        
        header("Location: ../admin/index.php?source=edit_profile&edit_profile={$_SESSION['id']}");
    } else {
        header("Location: ../login.php");
    }
}

?>
