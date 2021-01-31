<form class="login" action="<?php echo URLROOT . '/app/initadmin.php?url=admin/login'; ?>" method="POST">
    <h4 class="text-center">Admin Login</h4>
    <input class="form-control" type="text" name="user" placeholder="username" autocomplete="off">
    <input class="form-control" type="password" name="pass" placeholder="password" autocomplete="new-password">
    <input class="btn btn-primary btn-block" type="submit" value="Login">
</form>