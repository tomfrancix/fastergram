<?php 
if(isset($_SESSION['id'])) {
$sessionid = $_SESSION['id'];
} ?>
<div class="nav-wrapper" style="max-width:560px;">
     <nav class="navbar navbar-inverse navbar-fixed-top" style="max-width:560px;">
        <div class="container" style="max-width:560px;">
            <div class="navbar-header" style="max-width:560px;">
                
<!--
                <button type="button" onclick="location.href='camera.php'" class="navbar-toggle nb-l">
                    <span class="glyphicon glyphicon-camera nb-icon"></span>
                </button>
-->
                <button type="button" onclick="location.href='admin/posts.php?source=add_post'" class="navbar-toggle nb-l">
                    <span class="glyphicon glyphicon-camera nb-icon"></span>
                </button>
                <a   class="navbar-brand" href="index.php">Fastergram</a>
             <?php $query = "SELECT * FROM messages WHERE message_to_user_id = '{$sessionid}' AND message_status = 'Unchecked' ";
                $select_all_messages_query = mysqli_query($connection, $query);
                $countmessages = 0; 
                while($row = mysqli_fetch_assoc($select_all_messages_query)) {
                   $countmessages++;
                }
                if($countmessages > 0) { ?>
                <a href="admin/messages.php" class="navbar-toggle nb-r">
                    <span class="fa fa-paper-plane nb-icon"></span>
                    <span><div style="margin-left:6px;background-color:orangered;width:6px;height:6px;border-radius:50%;"></div></span>
                </a>
                <?php } else { ?>
                    <a href="admin/messages.php" class="navbar-toggle nb-r">
                    <span class="fa fa-paper-plane nb-icon"></span>
                </a><?php
                } ?>
            </div>
        </div>
    </nav>
</div>