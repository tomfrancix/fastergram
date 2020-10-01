<a href="?source=add_post">New Post</a> 
<table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                    <?php
                    
                    $query = "SELECT * FROM content";
                    $select_all_content_query = mysqli_query($connection, $query);
                   
                    while($row = mysqli_fetch_assoc($select_all_content_query)) {
                        $content_id = $row['content_id'];
                        $content_text = $row['content_text'];
                        $content_image = $row['content_image'];
                        $content_hash_id = $row['content_hash_id'];
                        
                      
                    $hashquery = "SELECT * FROM hashtags WHERE hash_id = {$content_hash_id} ";
                    $select_all_hashcontent_query = mysqli_query($connection, $hashquery);
                    $hash_title = "";
                    while($row = mysqli_fetch_assoc($select_all_hashcontent_query)) {
                        $hash_title = $row['hash_title'];
                        
                    }
                        
                    ?>
                    
                                <tr>
                                    <td><a href="posts.php?delete=<?php echo $content_id; ?>" class="btn btn-danger" style="padding:0 2px;opacity:0.3;"><span class="fa fa-close"></span></a></td>
                                    <td class="colspan-2"><a href="../post.php?id=<?php echo $content_id; ?>"><img style="width:25%;" class="pictures" src="../images/<?php echo $content_image; ?>"></a></td>
                                    
                                    <td>
                                    <span style="font-size:8pt;padding:5px;"><?php echo $content_text; ?></span><br>
                                    <?php if($hash_title != "" ) { ?>
                                    <span style="font-size:8pt;padding:5px;opacity:0.5;">#<?php echo $hash_title; ?></span>
                                <?php } ?>
                                    </td>
                                   
                                    <td>
                                    
                                    <input type="hidden" class="form-control" name="content_id" value="<?php echo $hash_id ?>">
                                    <a class="btn btn-default" href="?source=edit_post&edit_post=<?php echo $content_id; ?>" style="padding:0 8px;width:100%;opacity:0.5;">Edit</a>
                                    
                                        
                                    </td>
                                    
                                    
                                </tr>
                    <?php } ?>
                                 
                            </tbody>
                        </table>