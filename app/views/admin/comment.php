<h1 class="text-center">Manage Comments</h1>
<div class="container">
    <div class="table-responsive">
        <table class="main-table text-center table table-bordered">
            <tr>
                <td>#ID</td>
                <td>Comment</td>
                <td>post Image</td>
                <td>Username</td>
                <td>Added Date</td>
                <td>Control</td>
            </tr>
            <?php
                foreach($data as $row)
                {
                    echo"<tr>";
                    echo '<td>' .$row["CommentId"]. '</td>';
                    echo '<td>' .$row["Comment"]. '</td>';
                    echo '<td><img src=uploads/posts/' . $row["postImage"]. '</td>';
                    echo '<td>' .$row["UserComment"]. '</td>';
                    echo '<td>' .$row["Date"]. '</td>';
                    echo '<td>
                        <a href="comments.php?do=edit&comid=1" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
                        <a href="comments.php?do=delete&comid=1" class="btn btn-danger confirm"><i class="fas fa-times"></i> Delete</a>';
                        if ($row['Status'] == 0)
                            echo '<a href="comments.php?do=approve&comid=1" class="btn btn-primary activate-btn"><i class="fas fa-check"></i> Approve</a>';
                    echo '</td>';
                    echo '</tr>';
                }
            ?>
        </table>
    </div>
</div>