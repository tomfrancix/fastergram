 <?php
   create_post();

$thisid = $_SESSION['id']; ?>
<form action="" method="POST" enctype="multipart/form-data">
<div class="form-group">
    <label for="content_text">Say something:</label>
    <textarea type="text" class="form-control" name="content_text" rows="5"></textarea>
    <br>
    <label for="content_text">Upload an image...</label>
    <input type="file" class="form-control" name="content_image">
    <input type="hidden" class="form-control" name="content_user_id" value="<?php echo $thisid; ?>">
    <br>
    <label for="content_text">Choose a hashtag...</label>
      <select name="content_hash_id" id="">
        <?php 
    $query = "SELECT * FROM hashtags";
    $select_all_hashtags_query = mysqli_query($connection, $query);
    confirmQuery($select_all_hashtags_query);
    while($row = mysqli_fetch_assoc($select_all_hashtags_query)) {
        $hash_id = $row['hash_id'];
        $hash_title = $row['hash_title'];
        
        echo "<option value='{$hash_id}' style='color:black;'>#{$hash_title}</options>";
    }
    ?>
    </select>
</div>
<div class="form-group">
    <input class="btn btn-success" type="submit" name="create_post" value="Post Image" style="width:100%;">
</div>
</form>