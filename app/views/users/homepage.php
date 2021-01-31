<div class="container">
    <div class="row row-cols-1 row-cols-lg-4 row-cols-md-3" style="margin-top: 50px;">
        <?php
            foreach($data as $it)
            {
                //echo "<div class='col-sm-6 col-md-4 col-lg-3'>";
                echo '<div class="col mb-3">';
                    echo '<div class="card post-box">';
                        echo "<span class='price'>".$it['Price']."</span>";
                        echo '<img src="admin/uploads/posts/'.$it['Image'].'" class="card-img-top" alt="..." style="height:250px;">';
                        echo '<div class="card-body">';
                            echo '<h5 class="card-title"><a href="posts.php?postid='.$it['postID'].'">'.$it['Name'].'</a></h5>';
                            echo '<p class="card-text">'.$it['Description'].'</p>';
                            echo '<div class="date">'.$it['AddDate'].'</div>';
                        echo '</div>';
                    echo '</div>';
                echo "</div>";
            }    
        ?>
    </div>
</div>