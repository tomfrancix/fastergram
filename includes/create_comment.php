 <?php
   create_comment();
?>

<div class="container">

<form action="" method="POST">
     <div class="container" style="padding:8px 10px;">
        <div class="row">
            <div class="w-20" style="width:30px;float:left;">
                <img src="images/profile.JPG" style="width:100%;border-radius:50%;">
            </div>
            <div class="w-80" style="min-width:85%;width:80%;float:left;padding:5px;">
                <textarea type="text" style="border:none;width:100%;" name="comment_text" placeholder="Add a comment..."></textarea>
            </div>
            <input type="hidden">
        </div>    
    </div>
    <input class="btn btn-primary" style="width:100%;background-color:charcoal" type="submit" name="create_comment" value="Submit">

</form> </div>