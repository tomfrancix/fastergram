<?php

function confirmQuery($result) {
    global $connection;
    if(!$result ) {
        die("QUERY FAILED ." . mysqli_error($connection));
    }
}

//HASHTAGS
function create_hashtags() {
    global $connection;
if(isset($_POST['submit'])) {

    $hash_title = $_POST['hash_title'];
    if($hash_title == "" || empty($hash_title)) {
        echo "<span style='color:red;font-size:10pt;'>Please enter a hashtag...</span>";
    } else {
        $query = "INSERT INTO hashtags(hash_title)";
        $query .= "VALUE('{$hash_title}')";

        $create_hashtag_query = mysqli_query($connection, $query);

        if(!$create_hashtag_query) {
            die('QUERY FAILED' . mysqli_error($connection));
        }
    }
}
}

function delete_hashtags() {
    global $connection;
if(isset($_GET['delete'])) {
    $the_hash_id = $_GET['delete'];

    $query = "DELETE FROM hashtags WHERE hash_id = {$the_hash_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location:hashtags.php");
}
}

function unfollow_hashtags() {
    global $connection;
if(isset($_POST['unfollow'])) {
  $hash_id = $_POST['hash_id'];
    $query = "UPDATE hashtags SET status = 'unsubscribed' WHERE hash_id = {$hash_id} ";

    $update_query = mysqli_query($connection, $query);
    if(!$update_query) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
    header("Location:hashtags.php");
}
}

function follow_hashtags() {
    global $connection;
if(isset($_POST['follow'])) {
  $hash_id = $_POST['hash_id'];
    $query = "UPDATE hashtags SET status = 'following' WHERE hash_id = {$hash_id} ";

    $update_query = mysqli_query($connection, $query);
    if(!$update_query) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
    header("Location:hashtags.php");
}
}

//POSTS
function create_post() {
    global $connection;
if(isset($_POST['create_post'])) {

    $content_text = $_POST['content_text'];
    $content_user_id = $_POST['content_user_id'];
    $content_hash_id = $_POST['content_hash_id'];
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
            header("Location:posts.php");
        }
    
}
}

function delete_post() {
    global $connection;
if(isset($_GET['delete'])) {
    $the_post_id = $_GET['delete'];

    $query = "DELETE FROM content WHERE content_id = {$the_post_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location:posts.php");
}
}

function edit_post() {
    global $connection;
if(isset($_POST['edit'])) {
    $content_id = $_POST['content_id'];
    $content_text = $_POST['content_text'];
    $content_user_id = $_POST['content_user_id'];
    $content_hash_id = $_POST['content_hash_id'];
    $content_image = $_FILES['content_image']['name'];
    $content_image_temp = $_FILES['content_image']['tmp_name'];        
    $content_datetime = date('d-m-y H-i-s');
    $query = "UPDATE content SET status = 'unsubscribed' WHERE content_id = {$content_id} ";

    $update_query = mysqli_query($connection, $query);
    if(!$update_query) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
    header("Location:posts.php");
}
}
?>