<h1 class="text-center">Manage posts</h1>
        <div class="container">
            <div class="table-responsive">
                <table class="main-table text-center table table-bordered">
                    <tr>
                        <td>#ID</td>
                        <td>Image</td>
                        <td>Description</td>
                        <td>Number of likes</td>
                        <td>Username</td>
                        <td>Adding Date</td>
                        <td>Control</td>
                    </tr>
                    <?php
                        foreach($data as $row)
                        {
                            echo"<tr>";
                            echo '<td>' .$row["postId"]. '</td>';
                            echo '<td><img src="../uploads/posts/' . $row["image"]. '"></td>';
                            echo '<td>' .$row["Description"]. '</td>';
                            echo '<td>' .$row["NomberLikes"]. '</td>';
                            echo '<td>' .$row["Username"]. '</td>';
                            echo '<td>' .$row["Date"]. '</td>';
                            echo '<td>
                                <a href="'.URLROOT . '/app/initadmin.php?url=admin/editPost/'.$row["postId"].'" class="btn btn-outline-success"><i class="fa fa-edit"></i> Edit</a>
                                <a href="'.URLROOT . '/app/initadmin.php?url=admin/deletePost/'.$row["postId"].'" class="btn btn-outline-danger confirm"><i class="fas fa-times"></i> Delete</a>';
                                if($row['Approve'] == 0)
                                    echo '<a href="'.URLROOT . '/app/initadmin.php?url=admin/approvePost/'.$row["postId"].'/post" class="btn btn-outline-primary activate-btn"><i class="fas fa-check"></i>Approve</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    ?>
                </table>
            </div>
            <a href="<?php echo URLROOT . "/app/initadmin.php?url=admin/addPost"?>" class="btn btn-primary"><i class="fa fa-plus"></i> New posts</a>
        </div>