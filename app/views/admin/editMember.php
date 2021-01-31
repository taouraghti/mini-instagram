<h1 class="text-center">Edit Member</h1>
<div class="container">
    <form action="<?php echo URLROOT . '/app/initadmin.php?url=admin/updateMember/'. $data["UserId"];?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="userid" value = "<?php echo $data['UserId']?>">
        <!--  Start Field Username  -->
        <div class="form-group row">
            <label class="col-sm-2 control-label">Username</label>
            <div class="col-sm-10 col-md-6">
                <input type="text" class="form-control" name="username" value="<?php echo $data['Username']?>" required = "required">
            </div>
        </div> 
        <!--  End Field Username  -->

        <!--  Start Field Password  -->
        <div class="form-group row">
            <label class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10 col-md-6">
                <input type="hidden" name="oldpassword" value="<?php echo $data['Password']?>">
                <input type="password" class="form-control" name="newpassword" autocomplete="new-password" placeholder="Leave blank if you don't want to change your password">

            </div>
        </div> 
        <!--  End Field Password  --> 

        <!--  Start Field Email  -->
        <div class="form-group row">
            <label class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10 col-md-6">
                <input type="email" class="form-control" name="email" value="<?php echo $data['Email']?>" required = "required">
            </div>
        </div> 
        <!--  End Field Email  --> 

        <!--  Start Field Full name  -->
        <div class="form-group row">
            <label class="col-sm-2 control-label">Full name</label>
            <div class="col-sm-10 col-md-6">
                <input type="text" class="form-control" name="fullname" value="<?php echo $data['FullName']?>" required = "required">
            </div>
        </div> 
        <!--  End Field Full name  -->

        <!--  Start Field Avatar  -->
        <div class="form-group row">
            <label class="col-sm-2 control-label">User Avatar</label>
            <div class="col-sm-10 col-md-6">
                <div class="custom-file">
                    <input type="file" name='avatar' class="custom-file-input" id="inputGroupFile02" >
                    <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Leave blank if you don't want to change your avatar</label>
                </div>
            </div>
        </div>
        <!--  End Field Avatar  -->

        <!--  Start Field Submit  -->
        <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
                <input type="submit" class="btn btn-success" value="save">
            </div>
        </div> 
        <!--  End Field Submit  -->   
    </form>
</div>
