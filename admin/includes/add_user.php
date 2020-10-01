 <?php
   create_user();
?>

<form action="" method="POST" enctype="multipart/form-data">
<div class="form-group">
    <label for="email">Email</label>
    <input type="text" class="form-control" name="email">
</div>
<div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="username">
</div>
<div class="form-group">
    <label for="password">Password</label>
    <input type="text" class="form-control" name="password">
</div>
<div class="form-group">
    <label for="user_mobile">Mobile</label>
    <input type="text" class="form-control" name="user_mobile">
</div>
<div class="form-group">
    <label for="user_image">Profile Picture</label>
    <input type="file" name="user_image">
</div>
<div class="form-group">
    <label for="user_bio">Bio</label>
    <input type="text" class="form-control" name="user_bio">
</div>
<div class="form-group">
    <label for="role">Role</label>
    <select name="role" id="role">
        
       <option value="Normal" selected>Normal User</option>
       <option value="Administrator">Administrator</option>
    
    </select>
</div>
      
<div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_user" value="Submit">
</div>
</form>