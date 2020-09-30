<?php
include "includes/db.php";

if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($_GET['id']);
    $query = mysqli_query("SELECT * FROM content WHERE 'content_id'='$id'");
                   
        while($row = mysqli_fetch_assoc($query)) {
            $content_image = $row["content_image"];
        }
        header("content-type :image/jpeg");
        echo $content_image;
}
else
{
    echo "ERROR";
}
?>