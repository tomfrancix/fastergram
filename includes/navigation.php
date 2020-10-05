 <div class="nav-wrapper" style="height:10px;width:100vw;max-width:100%;margin:0;margin-bottom:-2px;">
     <nav class="navbar navbar-inverse navbar-fixed-top" style="position:fixed;top:0;width:100%;margin:0;background-color:rgba(09,58,57,1);">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header" style="text-align:center;padding:0 0 0 10px;">
                <button type="button" onclick="location.href='camera.php'" class="navbar-toggle" style="float:left;padding:5px;border:none;">
                    <span class="glyphicon glyphicon-camera" style="font-size:15pt; color:lightgrey;"></span>
                    
                </button>
                <a   class="navbar-brand" href="index.php" style="font-family: 'Parisienne', cursive;font-size:18pt;text-align:center;color:white;display:inline-block;float:none;">Fastergram</a>
                 <a href="admin/messages.php" class="navbar-toggle" style="float:right;padding:5px;border:none;">
                    <span class="fa fa-paper-plane" style="font-size:15pt; color:lightgrey;"></span>
                    
                </a>
                <script>
$(window).scroll(function() {
    var height = $(window).scrollTop();
    if (height > 100) {
        $('#back2Top').fadeIn();
    } else {
        $('#back2Top').fadeOut();
    }
});
$(document).ready(function() {
    $("#back2Top").click(function(event) {
        event.preventDefault();
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    });

});
</script>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    
                    <?php
                    
                    $query = "SELECT * FROM sections";
                    $select_all_sections_query = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($select_all_sections_query)) {
                        $section_title = $row['section_title'];
                        
                        echo "<li><a href='#'>{$section_title}</a></li>";
                    }
                    
                    ?>
                    
                    <li>
                        <a href="#">Profile</a>
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
     </div>