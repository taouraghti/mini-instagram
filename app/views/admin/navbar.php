<nav class="navbar navbar-expand-lg navbar-light">
<div class="container">
  <a class="navbar-brand" href="<?php echo URLROOT . '/app/initadmin.php?url=admin/dashboard';?>">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#app-nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="app-nav">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item"><a class="nav-link" href="../index.php">Instagram</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo URLROOT . '/app/initadmin.php?url=admin/post';?>">Posts</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo URLROOT . '/app/initadmin.php?url=admin/member';?>">Membres</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo URLROOT . '/app/initadmin.php?url=admin/comment';?>">Comments</a></li>
    </ul>
    <ul class="navbar-nav navbar-right">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $_SESSION['username']; ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="../index.php">Visit Instagram</a>
          <a class="dropdown-item" href="<?php echo URLROOT . '/app/initadmin.php?url=admin/editMember/'. $_SESSION['userid'] ?>">Edit Profil</a>
          <a class="dropdown-item" href="#">Setting</a>
          <a class="dropdown-item" href="<?php echo URLROOT . '/app/initadmin.php?url=admin/logout';?>">Logout</a>
        </div>
      </li>
    </ul>
    </div>  
  </div>
</nav>