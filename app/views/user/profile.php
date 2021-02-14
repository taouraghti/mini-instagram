<?php
   $av = isset($data['user']['Avatar']) ? $data['user']['Avatar'] : $_SESSION['avatar'];
?>
<div class="container profil-container">
    
    <div class="row">
        <div class="col-6" style="text-align: center;">
            <img 
                class="rounded-circle img-thumbnail"
                style="width:200px;height:200px"
                src="<?php echo URLROOT . "/uploads/avatars/" . $av ?>"
                alt="...">
        </div>
        <div class="col-6" style="font-size:18px">
            <span style="font-size:30px">
            <?php
                    echo $data['user']['Username'] . '</span>';
                    if($data['user']['Username'] == $_SESSION['username'])
                        echo '<a href="' . URLROOT . '/app/init.php?url=user/editProfil" class="btn btn-outline-dark prof-setting"><i class="fas fa-user-cog"></i></a>';          
            ?> 
            <br>
            <div style="margin-top:20px"><span style="font-weight:bold"><?php echo sizeof($data['posts'])?></span> Publications</div>
            <br>
            <div style="font-size:30px">
                <?php
                    if(isset($data['user']['FullName']))
                        echo $data['user']['FullName'];
                    else
                        echo $_SESSION['fullname'];
                ?>
            </div>
        </div>
    </div>
    <hr style="margin: 70px 0;">
</div>
<div class="container">
    <div class="row">
        <?php 
            if(!empty($data['posts']))
            {
                foreach($data['posts'] as $d)
                { ?>
                    
                    <div class="col-sm-4 prof-posts">
                    <a  style="text-decoration:none; color:#fff"
                        href="<?php echo URLROOT . "/app/init.php?url=post/showPost/".$d["PostId"] ?>"
                    >
                        <div class="card text-white h-100">
                        
                            <img 
                                src="<?php echo URLROOT . "/uploads/posts/" . $d['Image'] ?>"
                                class="card-img" alt="..."
                                style="height:100%"
                            >
                            <div class="card-img-overlay">
                                <h5 class="card-title text-center">
                                    <i class="fas fa-heart" style="color:#fff"></i><?php echo ' '.$d['NumberLikes'] ?>
                                    <i class="fas fa-comment" style="margin-left:20px"></i> <?php echo $d['nbComments']?>
                                </h5>
                            </div>
                
                        </div>
                    </a>
                    </div>
        <?php
                }
            }
            else
            {
                echo '<div style="margin:auto">';
                if($data['user']['Username'] == $_SESSION['username'])
                    echo '<a href="'. URLROOT . '/app/init.php?url=post/newPost" class="btn btn-secondary"><i class="fa fa-plus"></i> New posts</a>';
                else
                    echo "<h5>There is no post</h5>";
                echo "</div>";
            }

        ?>

    </div>
</div>