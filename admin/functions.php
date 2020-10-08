<?php

function confirmQuery($result) {
    global $connection;
    if(!$result ) {
        die("QUERY FAILED ." . mysqli_error($connection));
    }
}

function escape($string) {
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}
//HASHTAGS
function create_hashtags() {
    global $connection;
    $thestatus = "Subscribed";
if(isset($_POST['submit'])) {

    $hash_title = escape($_POST['hash_title']);
    $sub_user_id = escape($_POST['sub_user_id']);
    
    if($hash_title == "" || empty($hash_title)) {
        echo "<span style='color:red;font-size:10pt;'>Please enter a hashtag...</span>";
    } else {
        
        $query = "INSERT INTO hashtags(hash_title)";
        $query .= "VALUE('{$hash_title}')";

        $create_hashtag_query = mysqli_query($connection, $query);

        if(!$create_hashtag_query) {
            die('QUERY FAILED' . mysqli_error($connection));
        } else {
            
        $queryd = "SELECT * FROM hashtags WHERE hash_title = '$hash_title' ";
        $query_hashid = mysqli_query($connection, $queryd);
        
        while($row = mysqli_fetch_assoc($query_hashid)) {
        $sub_hash_id = escape($row['hash_id']);
        
         
                       
        
        
        $querys = "INSERT INTO subscriptions(sub_hash_id, sub_user_id, status)";
        $querys .= "VALUE('{$sub_hash_id}','{$sub_user_id}','{$thestatus}')";
        }
        $create_sub_query = mysqli_query($connection, $querys);
        
    } }
}
}

function delete_hashtags() {
    global $connection;
if(isset($_GET['delete'])) {
    if(isset($_SESSION['id'])) {
      
    $the_sub_id = escape($_GET['delete']);

    $query = "DELETE FROM subscriptions WHERE sub_id = {$the_sub_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location:hashtags.php");
}
}
}

function unfollow_hashtags() {
    global $connection;
if(isset($_POST['unfollow'])) {
  $sub_id = escape($_POST['sub_id']);
    
    $query = "UPDATE subscriptions SET status='Unsubscribed' WHERE sub_id=$sub_id ";

    $update_query = mysqli_query($connection, $query);
    
    if(!$update_query) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
    header("Location:hashtags.php");
}
}

function follow_hashtags() {
    global $connection;
if(isset($_GET['follow'])) {
  $sub_id = escape($_GET['follow']);
    
    $query = "UPDATE subscriptions SET status = 'Subscribed' WHERE sub_id = $sub_id ";

    $update_query = mysqli_query($connection, $query);
    
//    header("Location:hashtags.php");
}
}
//POSTS
function create_post() {
    global $connection;
if(isset($_POST['create_post'])) {

    $content_text = escape($_POST['content_text']);
    $content_user_id = escape($_POST['content_user_id']);
    $content_hash_id = escape($_POST['content_hash_id']);
    $content_image = $_FILES['content_image']['name'];
    $content_image_temp = $_FILES['content_image']['tmp_name'];        
    $content_datetime = date('d-m-y H-i-s');
        
    move_uploaded_file($content_image_temp, "../images/$content_image" );
    
        $query = "INSERT INTO content(content_text, content_image, content_user_id, content_hash_id, content_datetime)";
        $query .= "VALUES('{$content_text}','{$content_image}','{$content_user_id}','{$content_hash_id}',now())";

        $create_content_query = mysqli_query($connection, $query);

        if(!$create_content_query) {
            die('QUERY FAILED' . mysqli_error($connection));
        } else {
            
     $query = "UPDATE hashtags SET content_count = content_count + 1 ";
    $query .= "WHERE hash_id = $content_hash_id ";
    
    $update_count = mysqli_query($connection, $query);
            
            header("Location:posts.php");
        }
    
}
}

function delete_post() {
    global $connection;
if(isset($_GET['delete'])) {
    if(isset($_SESSION['id'])) {
    $the_post_id = escape($_GET['delete']);

    $query = "DELETE FROM content WHERE content_id = {$the_post_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location:posts.php");
}
}
}

function edit_post() {
    
    global $connection;
    if(isset($_GET['edit_post'])) {
    
    $content_id = escape($_GET['edit_post']);
    
if(isset($_POST['edit_post'])) {
    
    $content_text = escape($_POST['content_text']);
    $content_hash_id = escape($_POST['content_hash_id']);  
    
    $query = "UPDATE content SET ";
    $query .= "content_id = '{$content_id}', ";
    $query .= "content_text = '{$content_text}', ";
    $query .= "content_hash_id = '{$content_hash_id}' ";
    $query .= "WHERE content_id = '{$content_id}' ";
    
    $update_post_query = mysqli_query($connection, $query);
    confirmQuery($update_post_query);
    header("Location:posts.php");
}
}

if(isset($_POST['edit'])) {
    $content_id = escape($_POST['content_id']);
    $content_text = escape($_POST['content_text']);
    $content_hash_id = escape($_POST['content_hash_id']);  
    $query = "UPDATE content SET status = 'unsubscribed' WHERE content_id = {$content_id} ";

    $update_query = mysqli_query($connection, $query);
    if(!$update_query) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
    header("Location:posts.php");
}
}

function edit_comment() {
    global $connection;
if(isset($_POST['edit_comment'])) {
    $comment_id = escape($_POST['comment_id']);
    $comment_text = escape($_POST['comment_text']);    
    
    $query = "UPDATE comments SET comment_text = '{$comment_text}' WHERE comment_id = {$comment_id} ";

    $update_query = mysqli_query($connection, $query);
    if(!$update_query) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
    header("Location:comments.php?source=view_your_comments");
}
}

function delete_comment() {
    global $connection;
if(isset($_GET['delete'])) {
    if(isset($_SESSION['id'])) {
    $the_comment_id = escape($_GET['delete']);

    $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id} ";
    $delete_comment_query = mysqli_query($connection, $query);
    header("Location:comments.php?source=view_your_comments");
}
}
}

function create_user() {
    global $connection;
if(isset($_POST['create_user'])) {

    $username = escape($_POST['username']);
    $email = escape($_POST['email']);
    $password = escape($_POST['password']);
    $user_image = escape($_FILES['user_image']['name']);
    $user_image_temp = escape($_FILES['user_image']['tmp_name']);   
    $user_bio = escape($_POST['user_bio']);
    $user_mobile = escape($_POST['user_mobile']);
    $role = escape($_POST['role']);
    
        
    move_uploaded_file($user_image_temp, "../images/$user_image" );
    
        $query = "INSERT INTO users(username, email, password, user_image, user_bio,user_mobile, role )";
        $query .= "VALUES('{$username}','{$email}','{$password}','{$user_image}','{$user_bio}','{$user_mobile}','{$role}' )";

        $create_user_query = mysqli_query($connection, $query);

        if(!$create_user_query) {
            die('QUERY FAILED' . mysqli_error($connection));
        } else {
            
            echo "User Created: " . " " . "<a href='users.php'>View Users</a> ";
            
        }
    
}
}

function delete_user() {
    global $connection;
if(isset($_GET['delete'])) {
    if(isset($_SESSION['id'])) {
        if($_SESSION['role'] == "Administrator") {
    $the_user_id = escape($_GET['delete']);

    $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location:users.php");
}
}
}
}

function change_role_admin() {
    global $connection;
    
if(isset($_GET['change_role_admin'])) {
    
    $user_id = escape($_GET['change_role_admin']);
    
    $query = "UPDATE users SET role = 'Administrator' WHERE user_id = {$user_id} ";

    $update_role_query = mysqli_query($connection, $query);
    
    header("Location:users.php");
}
}

function change_role_subscriber() {
    global $connection;
    
if(isset($_GET['change_role_subscriber'])) {
    
    $user_id = escape($_GET['change_role_subscriber']);
    
    $query = "UPDATE users SET role = 'Subscriber' WHERE user_id = {$user_id} ";

    $update_role_query = mysqli_query($connection, $query);
    
    header("Location:users.php");
}
}

function edit_user() {
    global $connection;
if(isset($_GET['edit_user'])) {
    
    $user_id = escape($_GET['edit_user']);
    
if(isset($_POST['edit_user'])) {
    
    $username = escape($_POST['username']);
    $email = escape($_POST['email']);
    $password = escape($_POST['password']);
    $user_image = escape($_FILES['user_image']['name']);
    $user_image_temp = escape($_FILES['user_image']['tmp_name']);   
    $user_bio = escape($_POST['user_bio']);
    $user_mobile = escape($_POST['user_mobile']);
    $role = escape($_POST['role']);
    
    move_uploaded_file($user_image_temp, "../images/$user_image" );
    
    $query = "UPDATE users SET ";
    $query .= "username = '{$username}', ";
    $query .= "email = '{$email}', ";
    $query .= "password = '{$password}', ";
    $query .= "user_image = '{$user_image}', ";
    $query .= "user_bio = '{$user_bio}', ";
    $query .= "user_mobile = '{$user_mobile}', ";
    $query .= "role = '{$role}' ";
    $query .= "WHERE user_id = '{$user_id}' ";
    
//    if(empty($user_image)) {
//        
//        $query = "SELECT * FROM users WHERE user_id = $user_id ";
//        $select_user_image = mysqli_query($connection, $query);
//    }

    $update_user_query = mysqli_query($connection, $query);
    confirmQuery($update_user_query);
    header("Location:users.php");
}
}
}

function edit_profile() {
    global $connection;
if(isset($_GET['edit_profile'])) {
    if(isset($_SESSION['id'])) {
        
    $user_id = escape($_GET['edit_profile']);
        
    if($_SESSION['id'] == $user_id) {
    
if(isset($_POST['edit_profile'])) {
    
    $username = escape($_POST['username']);
    $email = escape($_POST['email']);
    $password = escape($_POST['password']);
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];   
    $user_bio = escape($_POST['user_bio']);
    $user_mobile = escape($_POST['user_mobile']);
    
    if(empty($user_image) || $user_image == null) {
    } else {
    move_uploaded_file($user_image_temp, "../images/$user_image" );
    }
        
    $query = "SELECT randSalt FROM users";
    $select_randsalt_query = mysqli_query($connection, $query);
    if(!$select_randsalt_query) {
        die("QUERY FAILED." . mysqli_error($connection));
    } else {
    
    $row = mysqli_fetch_array($select_randsalt_query);  
    $salt = escape($row['randSalt']);
    
    $password = crypt($password, $salt);
    
    
    if(empty($user_image) || $user_image == null) {
          
    $query = "UPDATE users SET ";
    $query .= "username = '{$username}', ";
    $query .= "email = '{$email}', ";
    $query .= "password = '{$password}', ";
    $query .= "user_bio = '{$user_bio}', ";
    $query .= "user_mobile = '{$user_mobile}' ";
    $query .= "WHERE user_id = '{$user_id}' ";
       
    
    } else {
      
    $query = "UPDATE users SET ";
    $query .= "username = '{$username}', ";
    $query .= "email = '{$email}', ";
    $query .= "password = '{$password}', ";
    $query .= "user_image = '{$user_image}', ";
    $query .= "user_bio = '{$user_bio}', ";
    $query .= "user_mobile = '{$user_mobile}' ";
    $query .= "WHERE user_id = '{$user_id}' ";
    $_SESSION['image'] = $user_image;
        
    }
    
   

    $update_user_query = mysqli_query($connection, $query);
    confirmQuery($update_user_query);
    
    
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['bio'] = $user_bio;
    
    header("Location:index.php");
    }
}
}
}
}
}

function create_message() {
    global $connection;
if(isset($_POST['create_message'])) {

    $message_to_user_id = escape($_POST['message_to_user_id']);
    $message_from_user_id = escape($_POST['message_from_user_id']);
    $message_content = escape($_POST['message_content']);
    $message_status = escape($_POST['message_status']);
//        $message_image = $_FILES['message_image']['name'];
//        $message_image_temp = $_FILES['message_image']['tmp_name'];        
//    $content_datetime = date('d-m-y H-i-s');
        
//    move_uploaded_file($content_image_temp, "../images/$content_image" );
    
        $query = "INSERT INTO messages(message_to_user_id, message_from_user_id, message_content, message_status)";
        $query .= "VALUES('{$message_to_user_id}','{$message_from_user_id}','{$message_content}','{$message_status}')";

        $create_message_query = mysqli_query($connection, $query);

        if(!$create_message_query) {
            die('QUERY FAILED' . mysqli_error($connection));
        } else {
            
  
            
            header("Location:messages.php?source=chat&id={$message_to_user_id}");
        }
    
}
}
?>