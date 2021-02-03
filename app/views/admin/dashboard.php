<div class="container home-stats text-center">
        <h1>Dashboard</h1>
        <div class="row stats">
            <div class="col-lg-3 col-md-6">
                <a href=<?php echo URLROOT . '/app/initadmin.php?url=admin/member';?>>
                    <div class="stat st-members">
                        <i class="fas fa-users rounded-circle"></i>
                        <div class="info">
                                Total Members
                                <span><?php echo $data['countAllUser']; ?></span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="<?php echo URLROOT . '/app/initadmin.php?url=admin/member';?>">
                    <div class="stat st-pending">
                        <i class="fas fa-user-plus rounded-circle"></i>
                        <div class="info">    
                            Pending Members
                            <span><?php echo $data['countPendUser']; ?></span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="<?php echo URLROOT . '/app/initadmin.php?url=admin/post';?>">
                    <div class="stat st-posts">
                        <i class="fas fa-tag rounded-circle"></i>
                        <div class="info">    
                            Total posts
                            <span><?php echo $data['countpost']; ?></span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="<?php echo URLROOT . '/app/initadmin.php?url=admin/comment';?>">
                    <div class="stat st-comments">
                        <i class="fas fa-comment rounded-circle"></i>
                        <div class="info">
                            Total Comments
                            <span><?php echo $data['countComment'] ?></span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="container latest">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-users"></i> Latest 5 Registred Users
                        <span class="toggle-info float-right">
                            <i class="fas fa-minus"></i>
                        </span>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled latest-users">
                            <?php
                                foreach($data['LatestUser'] as $us)
                                {
                                    echo '<li>'. $us['Username']; 
                                            echo '<a href="'.URLROOT . '/app/initadmin.php?url=admin/editMember/'.$us["UserId"].'">';
                                                echo '<span class="btn btn-outline-primary float-right">';
                                                    echo '<i class="fa fa-edit"></i> Edit';
                                                echo '</span>';
                                            echo'</a>';
                                            if ($us['RegStatus'] == 0)
                                                echo '<a href="'.URLROOT . '/app/initadmin.php?url=admin/activateMember/'.$us["UserId"].'/dashboard" class="btn btn-outline-success float-right"><i class="fas fa-check"></i> Activate</a>';
                                    echo'</li>';
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-tag"></i> Latest 5 Registred posts
                        <span class="toggle-info float-right">
                            <i class="fas fa-minus"></i>
                        </span>
                    </div>
                    <div class="card-body">
                    <ul class="list-unstyled latest-users">
                            <?php
                                if (!empty($data['Latestpost']))
                                {
                                    foreach($data['Latestpost'] as $it)
                                    {
                                        echo '<li><img style="width:50px;height:50px" src="'.'../uploads/posts/' . $it["Image"]. '">'; 
                                                echo '<a href="'.URLROOT . '/app/initadmin.php?url=admin/editPost/'.$it["PostId"].'">';
                                                    echo '<span class="btn btn-outline-primary float-right">';
                                                        echo '<i class="fa fa-edit"></i> Edit';
                                                    echo '</span>';
                                                echo'</a>';
                                                if ($it['Approve'] == 0)
                                                {
                                                    echo '<a href="'.URLROOT . '/app/initadmin.php?url=admin/approvePost/'.$it["PostId"].'/dashboard" class="btn btn-outline-success float-right"><i class="fas fa-check"></i> Approve</a>';
                                                }
                                        echo'</li>';
                                    }
                                }
                                else
                                    echo "There is No posts";
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>                        
            <!-- Start Latest Comments --> 
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <i class="far fa-comment"></i> Latest 5 Comments
                        <span class="toggle-info float-right">
                            <i class="fas fa-minus"></i>
                        </span>
                    </div>
                    <div class="card-body">
                        <?php
                            foreach($data['LatestComment'] as $r)
                            {
                                echo '<div class="comment-box">';
                                    echo '<span class="member-name">';
                                        echo'<a href="members.php?do=edit&userid=1">'.$r['Username'].'</a>';
                                    echo '</span>';
                                    echo '<a href="comments.php?do=edit&comid=1" class="edit-comment"><p class="member-comment">'.$r['Comment'].'</p></a>';
                                echo '</div>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Latest Comments -->
        
    </div>

