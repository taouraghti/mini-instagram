<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">

        <a class="navbar-brand" href="<?php echo URLROOT . '/app/init.php?url=post/home';?>">Camagru</a>

        <div class="myNav">
            <div class="myLink">
                <a href="<?php echo URLROOT . '/app/init.php?url=posts/homepage';?>"><i class="fas fa-home" style="font-size: 25px;"></i></a>
                <a href="<?php echo URLROOT . '/app/init.php?url=posts/newPost';?>"><i class="fab fa-instagram" style="font-size: 25px;"></i></a>
                <a class="nav-like" onclick="showNotif(<?php echo $_SESSION['userid']?>);">
                    <i class="far fa-heart" style="font-size: 25px;"></i>
                    <?php 
                        $n = 0;
                        foreach($data['like'] as $a)
                        {
                            if($a['LikeView'] == 0)
                                $n++;
                        }
                        foreach($data['comment'] as $a)
                        {
                            if($a['CommentView'] == 0)
                                $n++;
                        }
                        if($n > 0)
                        {
                            if($n > 99)
                                $n = 99;
                            echo '<span id="likesnb" class="likesnb">' .$n.'</span>';
                        }
                    ?>
                </a>
                <div id="notifications" class="notifications">
                    <?php 
                    foreach($data['comment'] as $ar)
                    {
                        echo '<a class="link-notif" href="'.URLROOT . '/app/init.php?url=posts/showPost/'.$ar["PostId"].'">';
                            echo "<div class='row notif'>";
                                echo "<div class='col-2'>";
                                    echo '<img class="rounded-circle" style="width:40px;height:40px;" src="' . URLROOT . '/uploads/avatars/'. $ar['Avatar'] . '" alt="">';
                                echo "</div>";
                                echo "<div class='col-8' style='font-size: 15px; line-height:35px'>";
                                    echo "<span style='font-weight:bold;'>".$ar['UserComment']."</span> commented your post.";
                                echo "</div>";
                                echo "<div class='col-2'>";
                                echo '<img class="" style="width:40px;height:40px" src="' . URLROOT . '/uploads/posts/'. $ar['Image'] . '"  alt="">';
                                echo "</div>";
                            echo "</div>";
                        echo "</a>";
                        
                    }
                    foreach($data['like'] as $ar)
                    {
                        echo '<a class="link-notif" href="'.URLROOT . '/app/init.php?url=posts/showPost/'.$ar["PostId"].'">';
                            echo "<div class='row notif'>";
                                echo "<div class='col-2'>";
                                    echo '<img class="rounded-circle" style="width:40px;height:40px;" src="' . URLROOT . '/uploads/avatars/'. $ar['Avatar'] . '" alt="">';
                                echo "</div>";
                                echo "<div class='col-8' style='font-size: 15px; line-height:35px'>";
                                    echo "<span style='font-weight:bold;'>".$ar['UserLike']."</span> liked your post.";
                                echo "</div>";
                                echo "<div class='col-2'>";
                                echo '<img class="" style="width:40px;height:40px" src="' . URLROOT . '/uploads/posts/'. $ar['Image'] . '"  alt="">';
                                echo "</div>";
                            echo "</div>";
                        echo "</a>";
                        
                    }

                    ?>
                </div>
            </div>    
                <?php
                if (isset($_SESSION['username']))
                { 
                   ?>
                    <div class="dropdown">
                        <a class="dropdown-toggle nav-img" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle" style="width:35px; height:35px;" src="<?php echo URLROOT . '/uploads/avatars/'. $_SESSION['avatar']?>" alt="">    
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="<?php echo URLROOT . '/app/init.php?url=user/profile/'.$_SESSION['username']; ?>">Profile</a>
                            <a class="dropdown-item" href="<?php echo URLROOT . '/app/init.php?url=user/editProfile';?>">Edit</a>
                            <a class="dropdown-item" href="<?php echo URLROOT . '/app/init.php?url=user/logout'; ?>">Logout</a>
                        </div>
                    </div>
                <?php   
                }
                ?>
        </div>  
    </div>
</nav>

<div style="margin: 100px;"></div>