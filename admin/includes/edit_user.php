 <?php
   edit_user();
?><?php
 
if(isset($_GET['edit_user'])) {
    $the_user_id = escape($_GET['edit_user']);
}
$query = "SELECT * FROM users WHERE user_id = {$the_user_id} ";
$select_users_by_id = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_users_by_id)) {
  
    $username = escape($row['username']);
    $email = escape($row['email']);
    $password = escape($row['password']);
    $user_image = escape($row['user_image']);
    $user_bio = escape($row['user_bio']);
    $user_mobile = escape($row['user_mobile']);
    $role = escape($row['role']);
}

?>


<img src="../images/<?php echo $user_image ?>" style="width:100%;margin-top:10px;border-radius:50%;">


<form action="" method="POST" enctype="multipart/form-data">
<div class="form-group">
    <label for="email">Email</label>
    <input type="text" class="form-control" name="email" value="<?php echo $email ?>">
</div>
<div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="username" value="<?php echo $username ?>">
</div>
<div class="form-group">
    <label for="password">Password</label>
    <input type="text" class="form-control" name="password" value="<?php echo $password ?>">
</div>
<div class="form-group">
    <label for="user_mobile">Mobile</label>
    <input type="text" class="form-control" name="password" value="<?php echo $user_mobile ?>">
</div>
<div class="form-group">
    <label for="user_image">Profile Picture</label>
    <input type="file" name="user_image">
</div>
<div class="form-group">
    <label for="user_bio">Bio</label>
    <input type="text" class="form-control" name="user_bio" value="<?php echo $user_bio ?>">
</div>
<div class="form-group">
    <label for="role">Role</label>
    <select name="role" id="role">
        
       <option value="Normal" selected>Normal User</option>
       <option value="Administrator">Administrator</option>
    
    </select>
</div>
      
<div class="form-group">
    <input class="btn btn-primary" type="submit" name="edit_user" value="Submit">
</div>
</form>