<?php
   edit_comment();
?><?php
 
if(isset($_GET['id'])) {
    $the_comment_id = $_GET['id'];
}
$query = "SELECT * FROM comments WHERE comment_id = {$the_comment_id} ";
$select_comment_by_id = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_comment_by_id)) {
    $comment_id = $row['comment_id'];
    $comment_text = $row['comment_text'];
}

?>


<form action="" method="POST" enctype="multipart/form-data">
<div class="form-group">
    <input type="hidden" name="comment_id" value="<?php echo $comment_id; ?>" >
    <label for="comment_text" style="margin-top:5px;">Edit Comment</label>
    <textarea type="text" class="form-control" name="comment_text"><?php echo $comment_text ?></textarea>

</div>
<div class="form-group">
    <input class="btn btn-primary" type="submit" name="edit_comment" value="Submit">
</div>
</form>