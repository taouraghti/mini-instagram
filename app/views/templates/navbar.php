<body>
<div class="upper-bar">
        <div class="container">
            <?php
                if (!isset($_SESSION['user']))
                { 
                    echo '<a href="login.php">';
                        echo '<span class="float-right"> Login/Signup </span>';
                    echo '</a>';
                } 
                ?>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">HomePage</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#app-nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="app-nav">
            <ul class="navbar-nav ml-auto">   <!--  ml-auto to push posts to the right (l:left, There is also mr-auto r:right) -->
            </ul>
                <ul class="navbar-nav navbar-right">
                        <li class="nav-post dropdown">
                            <a class=" nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#FFF;">
                                <img class="rounded-circle" style="width:30px;" src="admin/uploads/avatars/" alt="">
                                username
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-post" href="<?php echo URLROOT . '/app/init.php?url=users/profile'; ?>">Profile</a>
                            <a class="dropdown-post" href="profile.php#my-posts">posts</a>
                            <a class="dropdown-post" href="newad.php">New post</a>
                            <a class="dropdown-post" href="logout.php">Logout</a>
                            </div>
                        </li>
                    </ul>
        </div>  
        </div>
    </nav>
