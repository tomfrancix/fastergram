 <?php
   create_post();

$thisid = $_SESSION['id']; ?>

        

<div class="row" style="margin-top:-25px;padding:0 0 10px 0;">
    <img id="output" src="../images/load.gif" style="width:100%;margin-bottom:8px;margin-top:10px;">
</div>

<form action="" method="POST" name="uploadForm" enctype="multipart/form-data">
<div class="form-group">
    
    <label for="content_text">Upload an image...</label>
    <input id="upload-Image" type="file" class="form-control" name="content_image"  onchange="loadFile(event)" style="background-color:transparent;">
    <br>
    
    <label for="content_text">Say something:</label>
    <textarea type="text" class="form-control" name="content_text" style="background-color:rgba(10,10,10,1);color:white;border:none;" rows="5"></textarea>
    <br>
    
    <input type="hidden" class="form-control" name="content_user_id" value="<?php echo $thisid; ?>">
    <br>
    <label for="content_text">Choose a hashtag...</label><br>
    <span style="font-size:10pt;color:grey;margin:-3px;">You can create new hashtags <a href="hashtags.php" style="color:deepskyblue;">here!</a></span>
      <select name="content_hash_id" id="" style="background-color:rgba(10,10,10,1);color:white;width:100%;margin-top:8px;">
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
</form><br><br><br><br><br><br>
<script>
   
    var loadFile = function (event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function () {
            URL.revokeObjectURL(output.src) // free memory
        }
    };

</script>
