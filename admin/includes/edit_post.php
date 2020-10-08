 <?php
   edit_post();
?><?php
 
if(isset($_GET['edit_post'])) {
    $the_post_id = $_GET['edit_post'];
}
$query = "SELECT * FROM content WHERE content_id = {$the_post_id} ";
$select_content_by_id = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_content_by_id)) {
    $content_id = escape($row['content_id']);
    $content_text = escape($row['content_text']);
    $content_image = escape($row['content_image']);
    $content_hash_id = escape($row['content_hash_id']);
}

?>

<img src="../images/<?php echo $content_image ?>" style="width:100%;">

<form action="" method="POST" enctype="multipart/form-data">
<div class="form-group"><br>
    <label for="content_text" style="margin-top:5px;">Edit Post</label>
    <textarea type="text" rows="5" class="form-control" name="content_text" style="background-color:rgba(10,10,10,1);color:white;border:none;"><?php echo $content_text ?></textarea><br>
<!--    <input type="file" class="form-control" name="content_image" >-->
    <label for="content_text" style="margin-top:5px;">Select a hashtag</label>
    <select name="" id="" style="background-color:rgba(10,10,10,1);color:white;width:100%;">
        <?php 
    $query = "SELECT * FROM hashtags ORDER BY content_count DESC";
    $select_all_hashtags_query = mysqli_query($connection, $query);
    confirmQuery($select_all_hashtags_query);
    while($row = mysqli_fetch_assoc($select_all_hashtags_query)) {
        $hash_id = escape($row['hash_id']);
        $hash_title = escape($row['hash_title']);
        if($hash_id == $content_hash_id) {
        echo "<option value='{$hash_id}' selected>#{$hash_title}</options>";
        } else {
        echo "<option value='{$hash_id}' >#{$hash_title}</options>";
        }
    }
    ?>
    </select>
</div>
<div class="form-group">
    <input class="btn btn-success" style="width:100%;" type="submit" name="edit_post" value="Submit">
</div>
</form>