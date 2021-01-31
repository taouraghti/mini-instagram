<h1 class="text-center">Manage Members</h1>
        <div class="container">
            <div class="table-responsive">
                <table class="main-table text-center table table-bordered">
                    <tr>
                        <td>#ID</td>
                        <td>Avatar</td>
                        <td>Username</td>
                        <td>Email</td>
                        <td>Full Name</td>
                        <td>Registred Date</td>
                        <td>Control</td>
                    </tr>
                    <?php
                        foreach($data as $row)
                        {
                            echo"<tr>";
                            echo '<td>' .$row["UserId"]. '</td>';
                            echo '<td> <img src="../uploads/avatars/' .$row["Avatar"]. '"></td>';
                            echo '<td>' .$row["Username"]. '</td>';
                            echo '<td>' .$row["Email"]. '</td>';
                            echo '<td>' .$row["FullName"]. '</td>';
                            echo '<td>' .$row["Date"]. '</td>';
                            echo '<td>
                                <a href="'. URLROOT . '/app/initadmin.php?url=admin/editMember/'. $row["UserId"].'" class="btn btn-outline-success"><i class="fa fa-edit"></i> Edit</a>
                                <a href="'. URLROOT . '/app/initadmin.php?url=admin/deleteMember/'. $row["UserId"].'" class="btn btn-outline-danger confirm"><i class="fas fa-times"></i> Delete</a>';
                                if ($row['RegStatus'] == 0)
                                    echo '<a href="'. URLROOT . '/app/initadmin.php?url=admin/activateMember/'. $row["UserId"].'/member" class="btn btn-outline-primary activate-btn"><i class="fas fa-check"></i> Activate</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    ?>
                </table>
            </div>
            <a href="<?php echo URLROOT . '/app/initadmin.php?url=admin/addMember';?>" class="btn btn-primary"><i class="fa fa-plus"></i> New Member</a>
        </div>