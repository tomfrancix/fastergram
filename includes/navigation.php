 <div class="nav-wrapper" style="height:10px;width:100%;margin:0;margin-bottom:-2px;">
     <nav class="navbar navbar-inverse navbar-fixed-top" style="position:fixed;top:0;width:100%;margin:0;background-color:rgba(09,58,57,1);">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" onclick="location.href='camera.php'" class="navbar-toggle" style="padding:5px;border:none;">
                    <span class="glyphicon glyphicon-camera" style="font-size:15pt; color:lightgrey;"></span>
                    
                </button>
                <a class="navbar-brand" href="index.php">Vortex</a>
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