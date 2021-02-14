<h1 class="text-center" style="margin-bottom:70px">Edit Profile</h1>
<div class="container">
    <form action="<?php echo URLROOT . '/app/init.php?url=user/updateProfile'; ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="userid" value = "<?php echo $_SESSION['userid']?>">
        <!--  Start Field Username  -->
        <div class="form-group row">
            <label class="col-sm-2 control-label">Username</label>
            <div class="col-sm-10 col-md-6">
                <input type="text" class="form-control" name="username" value="<?php echo $_SESSION['username']?>" required = "required">
            </div>
        </div> 
        <!--  End Field Username  -->

        <div class="form-group row">
            <label class="col-sm-2 control-label">User Avatar</label>
            <div class="col-sm-10 col-md-6">
                <div class="custom-file">
                    <input type="file" name='avatar' class="custom-file-input" id="inputGroupFile02" onchange="changeFile(this)">
                    <label id="myLabel" class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                </div>
            </div>
        </div>
        <!--  End Field Avatar  -->

        <!--  Start Field Old Password  -->
        <div class="form-group row">
            <label class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10 col-md-6">
                <input type="password" class="form-control" name="oldpassword" autocomplete="new-password" placeholder="Password" required = "required">
            </div>
        </div> 
        <!--  End Field Old Password  --> 

        <!--  Start Field New Password  -->
        <div class="form-group row">
            <label class="col-sm-2 control-label">New Password</label>
            <div class="col-sm-10 col-md-6">
                <input type="password" class="form-control" name="newpassword" autocomplete="new-password" placeholder="Leave It Blank If You Don't Want To Change Your Password">
            </div>
        </div> 
        <!--  End Field New Password  --> 

        <!--  Start Field Email  -->
        <div class="form-group row">
            <label class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10 col-md-6">
                <input type="email" class="form-control" name="email" value="<?php echo $_SESSION['email']?>" required = "required">
            </div>
        </div> 
        <!--  End Field Email  --> 

        <!--  Start Field Full name  -->
        <div class="form-group row">
            <label class="col-sm-2 control-label">Full name</label>
            <div class="col-sm-10 col-md-6">
                <input type="text" class="form-control" name="fullname" value="<?php echo $_SESSION['fullname']?>" required = "required">
            </div>
        </div> 
        <!--  End Field Full name  -->

       
        <!--  Start Field Submit  -->
        <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
                <input type="submit" class="btn btn-success" value="save">
            </div>
        </div> 
        <!--  End Field Submit  -->   
    </form>
</div>