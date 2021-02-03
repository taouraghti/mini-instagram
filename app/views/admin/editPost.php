<h1 class="text-center">Edit Post</h1>
<div class="container">

    <form action="<?php echo URLROOT . "/app/initadmin.php?url=admin/updatePost"?>" method="POST">
        <input type="hidden" name="postid" value="<?php echo $data['PostId'];?>">

        <!--  Start Field Description  -->
        <div class="form-group row">
            <label class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10 col-md-6">
                <input type="text" class="form-control" name="description" placeholder="Description of the post" value="<?php echo $data['Description']?>">
            </div>
        </div> 
        <!--  End Field Description  -->

        <!--  Start Field Status  -->
        <div class="form-group row">
            <label class="col-sm-2 control-label">Status</label>
            <div class="col-sm-10 col-md-6">
                <select class="form-control" name="status" value="0">
                    <option value="1" <?php if($data['Approve'] == 1) echo "selected";?>>Show</option>
                    <option value="2" <?php if($data['Approve'] == 0) echo "selected";?>>Hide</option>
                </select>
            </div>
        </div> 
        <!--  End Field status  -->

        <!--  Start Field Submit  -->
        <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
                <input type="submit" class="btn btn-success" value="Save Post">
            </div>
        </div> 
        <!--  End Field Submit  -->  
    </form>
</div>