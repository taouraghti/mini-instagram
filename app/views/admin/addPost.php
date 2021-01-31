
<h1 class="text-center">Add New posts</h1>
<div class="container">
    <form action="<?php echo URLROOT . "/app/initadmin.php?url=admin/insertPost"?>" method="POST" enctype="multipart/form-data">
        <!--  Start Field Image  -->
        <div class="form-group row">
            <label class="col-sm-2 control-label">Post Image</label>
            <div class="col-sm-10 col-md-6">
                <div class="custom-file">
                    <input type="file" name="postimg" class="custom-file-input live-img" id="inputGroupFile02" onchange="changeFile(this)">
                    <label id="myLabel" class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                </div>
            </div>
        </div>
        <!--  End Field Image  -->

        <!--  Start Field Description  -->
        <div class="form-group row">
            <label class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10 col-md-6">
                <input type="text" class="form-control" name="description" placeholder="Description Of The post">
            </div>
        </div> 
        <!--  End Field Description  -->

        <!--  Start Field Submit  -->
        <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
                <input type="submit" class="btn btn-success" value="Add post">
            </div>
        </div> 
        <!--  End Field Submit  -->   
    </form>
</div>