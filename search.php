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
                <div class="wells">
                    <h4 style="text-align:center;">Search</h4>
                    <div class="input-group" style="padding-bottom:8px;width:100%;max-width:100%;">
                            <input type="text" id="industrySelect" onkeyup="myJobSearchFunction()" placeholder=" Choose a hashtag..." title="Type in a name"
           style="width:100%;padding:2px;border-radius:5px;font-size:10pt;min-width:100%;border:none;display:inline-block;max-width:100%;">
<hr style="margin:0">
    <ul id="mySideIndustryList">
        <?php 
                    $query = "SELECT * FROM hashtags ORDER BY content_count DESC";
                    $select_all_hashtag_query = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($select_all_hashtag_query)) {
                        
                        $hash_id = $row['hash_id'];
                        $hash_title = $row['hash_title'];
                        $content_count = $row['content_count'];
                        if($content_count > -1) {
                    ?>
                    <li>
                        <a id="title<?php echo $hash_id; ?>" onclick="chooseaValue(<?php echo $hash_id; ?>);">
                        <?php 
                        echo $hash_title; 
                        if($content_count == 1) {
                        ?> 
                        - 1 post
                        <?php } else if($content_count > 0) { ?> - <?php
                        echo $content_count; 
                         ?> posts <?php } ?>
                        </a> 
                        
                    </li>
                    <?php } } ?>
        
    </ul>        

                         </div>
                    <div style="padding:3px 8px">
                        <h5 style="font-weight:bold;" id="searchTitle">Most Recent Posts</h5>
                    </div>
                    <!-- /.input-group -->
                </div>
                <div class="post">
                    <div class="container">
                       <div class="row">
                           
                <?php
                    $query = "SELECT * FROM content ORDER BY content_datetime DESC";
                    $select_all_content_query = mysqli_query($connection, $query);
                    $counter = 0;
                    $totalno = 0;
                    while($row = mysqli_fetch_assoc($select_all_content_query)) {
                        $counter++;
                        $content_id = $row['content_id'];
                        $content_type = $row['content_type'];
                        $content_text = $row['content_text'];
                        $content_image = $row['content_image'];
                        $content_datetime = $row['content_datetime'];
                        $content_user_id = $row['content_user_id'];
                        $content_hash_id = $row['content_hash_id'];
                        $content_video = $row['content_video'];
                        $content_comment_count = $row['content_comment_count'];
                        $content_likes_count = $row['content_likes_count'];
                        
                    ?>
                <?php if($counter == 1 || $counter == 28) {
                        
                        ?> 
                           <a class="allContent"  id="content<?php echo $content_hash_id; ?>" href="post.php?id=<?php echo $content_id; ?>">
                                <div class="bigpictures" style="float:left;width:100%;border:1px solid lightgrey;background-image:url('images/<?php echo $content_image; ?>');background-size:cover;">
                               
                            </div></a>
                        <?php
                    } else if($counter == 6 || $counter == 19) {
                       
                     ?> 
                            <a  class="allContent" id="content<?php echo $content_hash_id; ?>" href="post.php?id=<?php echo $content_id; ?>">
                                <div class="mediumpictures" style="float:left;width:50%;border:1px solid lightgrey;background-image:url('images/<?php echo $content_image; ?>');background-size:cover;">
                               
                            </div></a>
                    <?php
                    } else {
                        ?>
                           <a  class="allContent"  id="content<?php echo $content_hash_id; ?>" href="post.php?id=<?php echo $content_id; ?>">
                                <div class="pictures" style="float:left;width:25%;border:1px solid lightgrey;background-image:url('images/<?php echo $content_image; ?>');background-size:cover;">
                               
                            </div></a> 
            <?php } } 
                          
                              ?> <div id="noposts" style="width:100%;text-align:center;"><p></p></div> 
                          
                    </div>
                    </div>
                </div>
            </div>
<script>
    function myJobSearchFunction() {
        document.getElementById('mySideIndustryList').style.display = 'block';
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("industrySelect");
        filter = input.value.toUpperCase();
        ul = document.getElementById("mySideIndustryList");
        ul.style.display = 'block';
        li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
    function chooseaValue(id) {
        document.getElementById('mySideIndustryList').style.display = 'none';
        
        var title = "title" + id;
        title = document.getElementById(title).innerHTML;
        document.getElementById('industrySelect').value = "";
        document.getElementById('searchTitle').innerHTML = "#" + title;
        var x = document.getElementsByClassName("allContent");
        var i;
        var z = 0;
        for (i = 0; i < x.length; i++) {
            if (x[i].id === "content" + id) {
                x[i].style.display = 'block';
                z++;
            } else {
                x[i].style.display = 'none';
            }
        }
            if(z < 1) {
                document.getElementById("noposts").innerHTML = "<br><br>~No posts to display~";
            } else {
                document.getElementById("noposts").innerHTML = "";
            }
    }
</script>
                   
            <script>
                var x = document.getElementsByClassName("pictures");
                var i;
                for (i = 0; i < x.length; i++) {
                  x[i].style.height = ""+(window.screen.width)/4+"px";
                }
                var x = document.getElementsByClassName("bigpictures");
                var i;
                for (i = 0; i < x.length; i++) {
                  x[i].style.height = ""+(window.screen.width)+"px";
                }
                var x = document.getElementsByClassName("mediumpictures");
                var i;
                for (i = 0; i < x.length; i++) {
                  x[i].style.height = ""+(window.screen.width)/2+"px";
                }
            </script>

<?php       
include "includes/sidebar.php"; 
?>
        </div>
<?php      
include "includes/footer.php"; 
?>   