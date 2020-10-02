<?php

//Comments
function create_comment() {
    global $connection;

if(isset($_POST['create_comment'])) {

    $comment_text = $_POST['comment_text'];
    $comment_user_id = $_POST['comment_user_id'];
    $comment_content_id = $_POST['comment_content_id'];
    $comment_reply_user_id = $_POST['comment_reply_user_id'];       
    $comment_datetime = date('d-m-y H-i-s');
    
    
    
        $query = "INSERT INTO comments(comment_text, comment_user_id, comment_content_id, comment_reply_user_id, comment_datetime)";
    
        $query .= "VALUES('{$comment_text}','{$comment_user_id}','{$comment_content_id}','{$comment_reply_user_id}',now() )";

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
             $queryc = "UPDATE content SET content_like_count = content_like_count + 1 ";
    $queryc .= "WHERE content_id = $like_content_id ";
    
    $update_like_count = mysqli_query($connection, $queryc);
            header("Location: index.php#{$like_content_id}");
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

    $query = "DELETE FROM likes WHERE like_id = {$the_like_id} ";
    $delete_like_query = mysqli_query($connection, $query);
    header("Location:index.php#{$the_like_id}");
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