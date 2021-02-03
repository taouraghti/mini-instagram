<body class="login-page">
    <div class="container">
        <!--  Start Login Form --->
        <div id="login" class="selected">
            <form action="<?php echo URLROOT . '/app/init.php?url=user/login'; ?>" method="post">
                <h1 class="text-center">Camagru</h1>
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Username">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <a href="#">Forgot Your Password ?</a>
                <input style="margin-top:10px;" class="btn btn-primary form-control" type="submit" value="login">
            </form>
            <div>
                You do not have an account ? <a id="signup-btn" href="#signup">Signup</a>
            </div>
        </div>
        <!--  End Login Form --->

        <!--  Start Signup Form --->
        <div id="signup" class = "not-selected">
            <form action="<?php echo URLROOT . '/app/init.php?url=users/signup'; ?>" method="post">
                <h1 class="text-center">Camagru</h1>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="text" name="fullname" class="form-control" placeholder="Full-name">
                </div>
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Username">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <input style="margin-top:10px;" class="btn btn-primary form-control" type="submit" value="Sign up">
            </form>
            <div>
                Do you have an account ? <a id="login-btn" href="#login">Login</a>
            </div>
        </div>
        <!--  End Signup Form --->
    </div>
