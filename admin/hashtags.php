<?php 
//include "includes/db.php";
include "includes/header.php";
include "includes/navigation.php"; 

?>
    

        

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Your Hashtags
                            <small> hashtags.</small>
                        </h1>
                        
                        <?php
                        create_hashtags();
                        delete_hashtags();
                        unfollow_hashtags();
                        follow_hashtags();
                        ?>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="hash_title">Create a new hashtag</label>
                                <input type="text" class="form-control" name="hash_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Hashtag">
                            </div>
                        </form>
                        <hr>
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Your Hashtags</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                    <?php
                    
                    $query = "SELECT * FROM hashtags";
                    $select_all_hashtags_query = mysqli_query($connection, $query);
                   
                    while($row = mysqli_fetch_assoc($select_all_hashtags_query)) {
                        $hash_id = $row['hash_id'];
                        $hash_title = $row['hash_title'];
                        $hash_status = $row['status'];
                        
                        
                    ?>
                                <tr>
                                    <td><a href="hashtags.php?delete=<?php echo $hash_id; ?>" class="btn btn-danger" style="padding:0 2px;"><span class="fa fa-close"></span></a></td>
                                    <td class="colspan-2">#<?php echo $hash_title; ?></td>
                                    <?php if($hash_status == "following") { ?>
                                    <td><div class="btn btn-success" style="padding:0 2px;width:100%;opacity:0.5">Following</div></td>
                                    <td>
                                    <form action="" method="POST">
                                    <input type="hidden" class="form-control" name="hash_id" value="<?php echo $hash_id ?>">
                                    <input class="btn btn-default" type="submit" name="unfollow" style="padding:0 2px;width:100%;" value="Unfollow">
                                    </form></td>
                                    <?php } else { ?>
                                    <td><div class="btn btn-default" style="padding:0 2px;width:100%;border:none;"><span style="color:lightgrey;font-size:8pt;">Unsubscribed</span></div></td>
                                    <td>
                                    <form action="" method="POST">
                                    <input type="hidden" class="form-control" name="hash_id" value="<?php echo $hash_id ?>">
                                    <input class="btn btn-info" type="submit" name="follow" style="padding:0 8px;width:100%;" value="Follow">
                                    </form>
                                        
                                    </td>
                                    <?php } ?>
                                    
                                </tr>
                    <?php } ?>
                                 
                            </tbody>
                        </table>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

   <?php 
include "includes/footer.php";

?>

