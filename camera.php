<?php 
include "includes/db.php";
include "includes/header.php";
include "includes/navigation.php"; 

?>

    <!-- Page Content -->
    <div class="container" style="padding:0 15px;;height:100%;width:100%;overflow-x:hidden;">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8" style="padding:0;">
                <div class="post">
                    <div class="container">
                       <div id="container">
                            <video autoplay="true" id="videoElement" style="width:100%;max-width:350px;height:100vh;">

                            </video>
                        </div>

                    </div>
                
                </div>
                <!-- Pager -->
               

            </div>
            <script>
                var video = document.querySelector("#videoElement");

                if (navigator.mediaDevices.getUserMedia) {
                  navigator.mediaDevices.getUserMedia({ video: true })
                    .then(function (stream) {
                      video.srcObject = stream;
                    })
                    .catch(function (err0r) {
                      console.log("Something went wrong!");
                    });
                }
            </script>

<?php      
include "includes/sidebar.php"; 
?>
        </div>
<?php      
include "includes/footer.php"; 
?>  