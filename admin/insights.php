
<?php 
//include "includes/db.php";
include "includes/header.php";
include "includes/navigation.php"; 
 if(!isset($_SESSION['id'])) {
       Header("Location: ../login.php");
    }
else {
       $sessionid = $_SESSION['id'];
  
?>
<div id="page-wrapper">
<div style="width:100%;padding:30px;text-align:center;">
    <span class="text-fade fs-medium">LAST 7 DAYS</span><br><br>
    <span class="glyphicon glyphicon-stats c-white fs-large"></span><br><br>
    <span class="fs-medium c-white;"><b>Welcome to your insights</b></span><br><br>
    <span class="fs-medium text-fade">Take a deeper look at how your account and content are performing on Fastergram in the last 7 days.</span>
</div>
    <hr class="hrm0">
<div class="container" >
<label>Overview</label>  
    <br><br>
<div class="row w100 p0 m0">
    <div class="w50 fl tl">
        <span>1</span><br>
        <span class="text-fade">Account reached</span>
    </div>
    <div class="w50 fl tr pt8">
        <span class="text-fade">0%</span>
        <span class="glyphicon glyphicon-arrow-right text-fade"></span>
    </div>
</div>
    <br>
    <div class="row w100 p0 m0 mt5">
    <div class="w50 fl tl">
        <span>0</span><br>
        <span class="text-fade">Content Interactions</span>
    </div>
    <div class="w50 fl tr pt8">
        <span class="text-fade">0%</span>
        <span class="glyphicon glyphicon-arrow-right text-fade"></span>
    </div>
</div>
    <br>
    <div class="row w100 p0 m0 mt5">
    <div class="w50 fl tl">
        <span>0</span><br>
        <span class="text-fade">Total Followers</span>
    </div>
    <div class="w50 fl tr pt8">
        <span class="text-fade">0%</span>
        <span class="glyphicon glyphicon-arrow-right text-fade"></span>
    </div>
</div>
</div>
    <br>
    <hr class="hrm0">
   <div class="container" >
<label>Content You Shared</label>  
    <br><br>
       <div class="row w100 p0 m0">
            <div class="w85 fl tl">
                <span class="text-fade">Post photos or videos to see new insights.</span><br>
                <br>
                <a href="#" style="color:deepskyblue;"><b>Create Post</b></a>
            </div>
            <div class="w15 fl tr">
                <span class="glyphicon glyphicon-arrow-right text-fade">              </span>
            </div>
       </div>
</div>
<!--
   <br>
    <hr class="hrm0">
   <div class="container" >
       <div class="row w100 p0 m0">
            <div class="w85 fl tl">
                <span class="text-fade">Post photos or videos to see new insights.</span><br>
                <br>
                <a href="#" style="color:deepskyblue;"><b>Create Post</b></a>
            </div>
            <div class="w15 fl tr">
                <span class="glyphicon glyphicon-arrow-right text-fade">              </span>
            </div>
       </div>
</div>
-->
    <br> 
    <br> 
    <br> 
    <br> 
    <br> 
    <br> 
    <br> 
    <br> 

</div>  
<?php } ?>
<script> window.onload = function() { document.getElementById('navbar-header').innerHTML = "Insights"; } </script>
<?php 
include "includes/footer.php";
  ?>


