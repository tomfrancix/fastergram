<?php

//Comments
function create_comment() {
    global $connection;

if(isset($_POST['create_comment'])) {

    $comment_text = $_POST['comment_text'];
    $comment_user_id = $_POST['comment_user_id'];
    $comment_to_user = $_POST['comment_to_user'];
    $comment_content_id = $_POST['comment_content_id'];
    $comment_reply_user_id = $_POST['comment_reply_user_id'];       
    $comment_reply_id = $_POST['comment_reply_id'];       
    $comment_datetime = date('d-m-y H-i-s');
    
    
    
        $query = "INSERT INTO comments(comment_text, comment_user_id, comment_to_user, comment_content_id, comment_reply_user_id,comment_reply_id, comment_datetime)";
    
        $query .= "VALUES('{$comment_text}','{$comment_user_id}','{$comment_to_user}','{$comment_content_id}','{$comment_reply_user_id}','{$comment_reply_id}',now() )";

        $create_comment_query = mysqli_query($connection, $query);

        if(!$create_comment_query) {
            die('QUERY FAILED' . mysqli_error($connection));
        } else {
             $query = "UPDATE content SET content_comment_count = content_comment_count + 1 ";
    $query .= "WHERE content_id = $comment_content_id ";
    
    $update_comment_count = mysqli_query($connection, $query);
            header("Location: comments.php?id={$comment_content_id}");
        }
    
   
    
    
}
   
}

function like() {
    global $connection;

if(isset($_POST['like'])) {

    $like_user_id = $_POST['like_user_id'];
    $like_content_id = $_POST['like_content_id'];
    
    
    
        $query = "INSERT INTO likes(like_user_id, like_content_id)";
    
        $query .= "VALUES('{$like_user_id}','{$like_content_id}' )";

        $create_like_query = mysqli_query($connection, $query);

        if(!$create_like_query) {
            die('QUERY FAILED' . mysqli_error($connection));
        } else {
             $queryc = "UPDATE content SET content_likes_count = content_likes_count + 1 ";
    $queryc .= "WHERE content_id = $like_content_id ";
    
    $update_like_count = mysqli_query($connection, $queryc);
            header("Location: index.php#{$like_content_id}");
        }
    
   
    
    
}
   
}

function follow() {
    global $connection;

if(isset($_POST['follow'])) {

    $follow_user_id = $_POST['follow_user_id'];
    $follow_to_user_id = $_POST['follow_to_user_id'];
    
        $query = "INSERT INTO following(follow_user_id, follow_to_user_id)";
    
        $query .= "VALUES('{$follow_user_id}','{$follow_to_user_id}' )";

        $create_follow_query = mysqli_query($connection, $query);

        if(!$create_follow_query) {
            die('QUERY FAILED' . mysqli_error($connection));
        } else {
    $queryc = "UPDATE users SET user_follower_count = user_follower_count + 1 ";
    $queryc .= "WHERE user_id = $follow_to_user_id ";
    $update_follower_count = mysqli_query($connection, $queryc);
            
    $queryd = "UPDATE users SET user_following_count = user_following_count + 1 ";
    $queryd .= "WHERE user_id = $follow_user_id ";
    $update_followerd_count = mysqli_query($connection, $queryd);
            
            header("Location: profile.php?id={$follow_to_user_id}");
        }
}
   
}
function unfollow() {
    global $connection;

if(isset($_GET['unfollow'])) {
    $follow_id = $_GET['unfollow'];

    $query = "SELECT * FROM following WHERE follow_id = {$follow_id} ";
    $unfollow_query = mysqli_query($connection, $query);
    
    while($row = mysqli_fetch_assoc($unfollow_query) ) {
    $follow_to_user_id = $row['follow_to_user_id'];
    $follow_user_id = $row['follow_user_id'];
    }
    
    
    $queryc = "UPDATE users SET user_follower_count = user_follower_count - 1 ";
    $queryc .= "WHERE user_id = $follow_to_user_id ";
    $update_follower_count = mysqli_query($connection, $queryc);
            
    $queryd = "UPDATE users SET user_following_count = user_following_count - 1 ";
    $queryd .= "WHERE user_id = $follow_user_id ";
    $update_followerd_count = mysqli_query($connection, $queryd);
    
     $queryf = "DELETE FROM following WHERE follow_id = {$follow_id} ";
    $delete_follow_query = mysqli_query($connection, $queryf);
            
            header("Location: profile.php?id={$follow_to_user_id}");
        }
}
   

function likeincomments() {
    global $connection;

if(isset($_POST['likeincomments'])) {

    $like_user_id = $_POST['like_user_id'];
    $like_content_id = $_POST['like_content_id'];
    
    
    
        $query = "INSERT INTO likes(like_user_id, like_content_id)";
    
        $query .= "VALUES('{$like_user_id}','{$like_content_id}' )";

        $create_like_query = mysqli_query($connection, $query);

        if(!$create_like_query) {
            die('QUERY FAILED' . mysqli_error($connection));
        } else {
             $queryc = "UPDATE content SET content_likes_count = content_likes_count + 1 ";
    $queryc .= "WHERE content_id = $like_content_id ";
    
    $update_like_count = mysqli_query($connection, $queryc);
            header("Location: comments.php?id={$like_content_id}");
        }
    
   
    
    
}
   
}
function delete_comment() {
    global $connection;
if(isset($_GET['delete_comment'])) {
    $the_comment_id = $_GET['delete_comment'];

    $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id} ";
    $delete_comment_query = mysqli_query($connection, $query);
    header("Location:index.php");
}
}
function delete_like() {
    global $connection;
if(isset($_GET['delete_like'])) {
    $the_like_id = $_GET['delete_like'];

    $query = "SELECT * FROM likes WHERE like_id = {$the_like_id} ";
    $get_post_query = mysqli_query($connection, $query);
    
    while($row = mysqli_fetch_assoc($get_post_query) ) {
    $like_content_id = $row['like_content_id'];
    }
    
    $queryc = "UPDATE content SET content_likes_count = content_likes_count - 1 ";
    $queryc .= "WHERE content_id = $like_content_id ";
    
    $update_like_count = mysqli_query($connection, $queryc);
    
    $query = "DELETE FROM likes WHERE like_id = {$the_like_id} ";
    $delete_like_query = mysqli_query($connection, $query);
    
    
    header("Location:index.php#{$the_like_id}");
}
}
function remove_like() {
    global $connection;
if(isset($_GET['remove_like'])) {
    $the_like_id = $_GET['remove_like'];
   
    $query = "SELECT * FROM likes WHERE like_id = {$the_like_id} ";
    $get_post_query = mysqli_query($connection, $query);
    
    while($row = mysqli_fetch_assoc($get_post_query) ) {
    $like_content_id = $row['like_content_id'];
    }
    
    $queryc = "UPDATE content SET content_likes_count = content_likes_count - 1 ";
    $queryc .= "WHERE content_id = $like_content_id ";
    
    $update_like_count = mysqli_query($connection, $queryc);
    
    $query = "DELETE FROM likes WHERE like_id = {$the_like_id} ";
    $delete_like_query = mysqli_query($connection, $query);
    header("Location:comments.php?id={$like_content_id}");
}
}

function edit_comment() {
    global $connection;
if(isset($_POST['edit_comment'])) {
     $comment_id = $_POST['$comment_id'];       
     $comment_text = $_POST['$comment_text']; 
    
    $query = "UPDATE comments SET comment_text = '{$comment_text}' WHERE comment_id = {$comment_id} ";
    

    $update_query = mysqli_query($connection, $query);
    if(!$update_query) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
    header("Location:post.php?id={$comment_content_id}");
}
}
?>