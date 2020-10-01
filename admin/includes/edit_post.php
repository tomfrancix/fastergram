 <?php
   edit_post();
?><?php
 
if(isset($_GET['edit_post'])) {
    $the_post_id = $_GET['edit_post'];
}
$query = "SELECT * FROM content WHERE content_id = {$the_post_id} ";
$select_content_by_id = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_content_by_id)) {
    $content_id = $row['content_id'];
    $content_text = $row['content_text'];
    $content_image = $row['content_image'];
    $content_hash_id = $row['content_hash_id'];
}

?>


<img src="../images/<?php echo $content_image ?>" style="width:100%;">

<form action="" method="POST" enctype="multipart/form-data">
<div class="form-group">
    <label for="content_text" style="margin-top:5px;">Edit Post</label>
    <textarea type="text" class="form-control" name="content_text"><?php echo $content_text ?></textarea>
<!--    <input type="file" class="form-control" name="content_image" >-->
    <select name="" id="">
        <?php 
    $query = "SELECT * FROM hashtags";
    $select_all_hashtags_query = mysqli_query($connection, $query);
    confirmQuery($select_all_hashtags_query);
    while($row = mysqli_fetch_assoc($select_all_hashtags_query)) {
        $hash_id = $row['hash_id'];
        $hash_title = $row['hash_title'];
        $hash_status = $row['status'];
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
    <input class="btn btn-primary" type="submit" name="edit_post" value="Submit">
</div>
</form>