 <?php
   create_post();

$thisid = $_SESSION['id']; ?>
<form action="" method="POST" name="uploadForm" enctype="multipart/form-data">
<div class="form-group">
    <br>
    <label for="content_text">Upload an image...</label>
    <input id="upload-Image" type="file" class="form-control" name="content_image" onchange="loadImageFile();">
    <br>
    <img id="upload-Preview" style="width:100%;"/>
    <br>
    <label for="content_text">Say something:</label>
    <textarea type="text" class="form-control" name="content_text" style="background-color:rgba(10,10,10,1);color:white;border:none;" rows="5"></textarea>
    <br>
    
    <input type="hidden" class="form-control" name="content_user_id" value="<?php echo $thisid; ?>">
    <br>
    <label for="content_text">Choose a hashtag...</label><br>
    <span style="font-size:10pt;color:grey;margin-top:-3px;">You can create new hashtags <a href="hashtags.php" style="color:deepskyblue;">here!</a></span>
      <select name="content_hash_id" id="" style="background-color:rgba(10,10,10,1);color:white;width:100%;">
        <?php 
    $query = "SELECT * FROM hashtags";
    $select_all_hashtags_query = mysqli_query($connection, $query);
    confirmQuery($select_all_hashtags_query);
    while($row = mysqli_fetch_assoc($select_all_hashtags_query)) {
        $hash_id = $row['hash_id'];
        $hash_title = $row['hash_title'];
        
        echo "<option value='{$hash_id}' style='color:white;'>#{$hash_title}</options>";
    }
    ?>
    </select>
</div>
<div class="form-group">
    <input class="btn btn-success" type="submit" name="create_post" value="Post Image" style="width:100%;">
</div>
</form>
<script>
   
</script>