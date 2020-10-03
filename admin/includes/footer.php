 </div>
    <!-- /#wrapper -->

<div class="bottom-navbar" style="width:100%;text-align:center;" style="position:fixed;bottom:0;width:100%;background-color:rgba(10,10,10,1);">
            <div class="bottom-navbar" style="width:100%;text-align:center;position:fixed;bottom:0;background-color:rgba(10,10,10,1);padding-top:5px;">
            <a href="../index.php" style="width:25%;text-align:center;float:left;padding-top:18px;">
                <span class="glyphicon glyphicon-home"></span>
            </a>
            <a href="../search.php" style="width:25%;text-align:center;float:left;padding-top:18px;">
                <span class="glyphicon glyphicon-search"></span>
            </a>
            <a href="../camera.php" style="width:25%;text-align:center;float:left;padding-top:18px;">
               <span class="glyphicon glyphicon-camera"></span>
            </a>
              <?php if(isset($_SESSION['image'])) {
    ?>
    <a href="index.php" style="width:25%;text-align:center;float:left;background-color:transparent;padding-top:10px;">
               <span style="display:inline-block;border-radius:50%;border:1px solid white;"><img src="../images/profile.jpg" style="width:30px;border-radius:50%;border:1px solid black;"></span><br>
        <span style="display:inline-block;position:fixed;width:5px;height:5px;border-radius:50%;background-color:red;margin:0 2px -35px -2px;padding:0;"></span>
            </a>
    <?php
} ?>
</div> 
</div> 
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>