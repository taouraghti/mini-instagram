<?php
    if(isset($_SESSION['username']))
    {
        $av = isset($data[0]['Avatar']) ? $data[0]['Avatar'] : $_SESSION['avatar'];
?>
<div class="container profil-container">
    
    <div class="row">
        <div class="col-6" style="text-align: center;">
            <img 
                class="rounded-circle"
                style="width:200px;height:200px"
                src="<?php echo URLROOT . "/uploads/avatars/" . $av ?>"
                alt="...">
        </div>
        <div class="col-6" style="font-size:18px">
            <span style="font-size:30px">
            <?php
                    if(isset($data[0]['Username']))
                        echo $data[0]['Username'] . '</span>';
                    else
                    {
                        echo $_SESSION['username'] . "</span>";
                        echo '<a href="' . URLROOT . '/app/init.php?url=user/editProfil" class="btn btn-outline-dark prof-setting"><i class="fas fa-user-cog"></i></a>';
                    }            
            ?> 
            <br>
            <div style="margin-top:20px"><span style="font-weight:bold"><?php echo sizeof($data)?></span> Publications</div>
            <br>
            <div style="font-size:30px">
                <?php
                    if(isset($data[0]['FullName']))
                        echo $data[0]['FullName'];
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
            foreach($data as $d)
            { ?>
                
                <div class="col-sm-4 col-12 prof-posts" style="max-height:345px;overflow:hidden;">
                <a  style="text-decoration:none;font-weight:500;color:#FFF" 
                    href="<?php echo URLROOT . "/app/init.php?url=posts/showPost/".$d["PostId"] ?>">
                    <div class="overlay">
                        <i class="fas fa-heart" ></i><?php echo ' '.$d['NumberLikes'] ?>
                        <i class="fas fa-comment" style="margin-left:20px"></i> <?php echo $d['nbComments']?>
                    </div>
                    <img 
                        style="width:100%;height:100%;"
                        src="<?php echo URLROOT . "/uploads/posts/" . $d['Image'] ?>" 
                        alt="...">
                    </img>
                </a>
                </div>
                
        <?php
            }
        ?>
    </div>
</div>

<?php 
    }
    else
    {
        echo '<div class="container" style="margin-top:100px;">';
            echo "<div class='alert alert-danger text-center'>Sorry you can't brows this page directly </div>";
            echo "<div class='alert alert-info text-center'>You Will Be Redirected to the previous After 3 seconds <i class='fa fa-check'></i></div>";
        echo '</div>';
        header('refresh:3;http://localhost/instagram');
    } 
?>