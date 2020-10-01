<?php
   edit_profile();
?>
  <div class="container-fluid">


                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
<?php
 
if(isset($_GET['edit_profile'])) {
    $the_user_id = $_GET['edit_profile'];
}
$query = "SELECT * FROM users WHERE user_id = {$the_user_id} ";
$select_users_by_id = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_users_by_id)) {
  
    $username = $row['username'];
    $email = $row['email'];
    $password = $row['password'];
    $user_image = $row['user_image'];
    $user_bio = $row['user_bio'];
    $user_mobile = $row['user_mobile'];
    $role = $row['role'];
}

?>


<img src="../images/<?php echo $user_image ?>" style="width:100%;">


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
    <input class="btn btn-primary" type="submit" name="edit_profile" value="Submit">
</div>
</form>
                        <br>
                        <br>
                        <br>
                        <br>
</div>
</div>
</div>