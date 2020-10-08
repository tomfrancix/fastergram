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
    $salt = $row['randSalt'];
    
    if($user_image == null || $user_image == "") { ?>
        <div class="row" style="margin-top:-5px;padding:0 0 10px 0;">
<img id="output" src="../images/load.gif" style="width:100%;margin-bottom:8px;margin-top:10px;">
</div>
   <?php } else { ?>
        <div class="row" style="margin-top:-5px;padding:0 0 10px 0;">
<img id="output" src="../images/<?php echo $user_image; ?>" style="width:100%;margin-bottom:8px;margin-top:10px;">
</div>                
<?php }
}
$password = crypt($salt, $password)                     
    
?>




<form action="" method="POST" enctype="multipart/form-data">
<div class="form-group">
    <label for="user_image">Profile Picture</label>
    <input type="file" name="user_image"  onchange="loadFile(event)" style="background-color:transparent;">
</div>
<div class="form-group">
    <label for="email">Email</label>
    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
</div>
<div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
</div>
<div class="form-group">
    <label for="user_mobile">Mobile</label>
    <input type="text" class="form-control" name="mobile" value="<?php echo $user_mobile; ?>">
</div>
<div class="form-group">
    <label for="user_bio">Bio</label>
    <input type="text" class="form-control" name="user_bio" value="<?php echo $user_bio; ?>">
</div>
<div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="key" name="password" placeholder="Enter your password to continue...">
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
<script>
   
    var loadFile = function (event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function () {
            URL.revokeObjectURL(output.src) // free memory
        }
    };

//    var loadFileC = function (event) {
//        document.getElementById('Cimageuploaderbutton').style.display = 'none';
//        document.getElementById('Cimageviewer').style.display = 'block';
//        var output = document.getElementById('Coutput');
//        output.src = URL.createObjectURL(event.target.files[0]);
//        output.onload = function () {
//            URL.revokeObjectURL(output.src) // free memory
//        }
//    };
</script>
