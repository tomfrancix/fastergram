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