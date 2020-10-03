<a href="?source=add_user">New User</a> 
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
                    
                    $query = "SELECT * FROM users";
                    $select_all_users_query = mysqli_query($connection, $query);
                   
                    while($row = mysqli_fetch_assoc($select_all_users_query)) {
                        $user_id = escape($row['user_id']);
                        $username = escape($row['username']);
                        $email = escape($row['email']);
                        $password = escape($row['password']);
                        $user_image = escape($row['user_image']);
                        $user_bio = escape($row['user_bio']);
                        $user_mobile = escape($row['user_mobile']);
                        $role = escape($row['role']);
                         
                    ?>
                    
                                <tr>
                                    <td><a href="users.php?delete=<?php echo $user_id; ?>" class="btn btn-danger" style="padding:0 2px;opacity:0.3;"><span class="fa fa-close"></span></a></td>
                                    <td class="colspan-2"><a href="../users.php?id=<?php echo $user_id; ?>"><img style="width:25%;" class="pictures" src="../images/<?php echo $user_image; ?>"></a></td>
                                    
                                    <td>
                                    <span style="font-size:8pt;padding:5px;"><?php echo $username; ?></span><br>
                                  <?php if($role == "Administrator") { ?>
                                        <span style="font-size:8pt;padding:5px;opacity:0.5;color:red;"><b><?php echo $role; ?></b><a href="users.php?change_role_subscriber=<?php echo $user_id ?>" style="padding:1px 2px;margin:0 2px;border-radius:50%;border:1px solid lightgrey;color:lightgrey"><span class="glyphicon glyphicon-triangle-bottom"></span></a></span><br>
                                      <?php } else { ?>
                                         <span style="font-size:8pt;padding:5px;opacity:0.5;color:blue;"><b>Subscriber</b><a href="users.php?change_role_admin=<?php echo $user_id ?>" style="padding:1px 2px;margin:0 2px;border-radius:50%;border:1px solid lightgrey;color:lightgrey"><span class="glyphicon glyphicon-triangle-top"></span></a></span><br>
                                        <?php } ?>
                                    <span style="font-size:8pt;padding:5px;opacity:0.5;"><?php echo $user_bio; ?></span>
                              
                                    </td>
                                   
                                    <td>
                                    
<!--                                    <input type="hidden" class="form-control" name="user_id" value="<?php echo $hash_id ?>">-->
                                    <a class="btn btn-default" href="?source=edit_user&edit_user=<?php echo $user_id; ?>" style="padding:0 8px;width:100%;opacity:0.5;">Edit</a>
                                    
                                        
                                    </td>
                                    
                                    
                                </tr>
                    <?php } ?>
                                 
                            </tbody>
                        </table>