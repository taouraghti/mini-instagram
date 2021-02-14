<div class="container">
    <h1 class="text-center">Add New Post</h1>
    <div class="card border-secondary" style="margin-top:30px">

        <h2 class="text-center pic-choice">
            <span class="pic-checked" onclick="choicePic(this)">Take picture</span>
             |   
            <span  onclick="choicePic(this)">Upload picture</span>
        </h2>
        <form 
            id="upload-pic"
            action="<?php echo URLROOT . '/app/init.php?url=post/insertPost'; ?>"
            method="POST"
            enctype="multipart/form-data"
            style="max-width:500px;margin:0 auto;"
            class="not-selected"   
        >
            <div class="custom-file">
                <input type="file" name="postimg" class="custom-file-input" id="inputGroupFile02" onchange="changeFile(this)">
                <label id="myLabel" class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
            </div>
            <textarea 
                class="form-control" 
                name="description" 
                id="desc" 
                rows="2" 
                placeholder="Description Of The Post" style="margin-bottom: 2%;"
            ></textarea>
            <input type="submit" button class="my-btn btn-dark" value="Add Post">       
        </form>

        <div id="take-pic" style="max-width:500px;margin:0 auto;">
            <div style="max-width:500px;margin:0 auto">
                    <video id="video" style="width:100%;height:auto">Stream not available...</video>
                </div>
                    <button class="my-btn btn-dark" onclick="takePicture()">
                        Take Photo
                    </button>
                    <select id="photo-filter" class="select">
                        <option value="none">Normal</option>
                        <option value="grayscale(100%)">Grayscale</option>
                        <option value="sepia(100%)">Sepia</option>
                        <option value="invert(100%)">Invert</option>
                        <option value="hue-rotate(90deg)">Hue</option>
                        <option value="blur(10px)">Blur</option>
                        <option value="contrast(200%)">Contrast</option>
                    </select>
                    <button id="clear-button" class="my-btn btn-light">Clear</button>
                    <canvas id="canvas"></canvas>
                <div id="photos"></div>
                <textarea 
                    class="form-control" 
                    name="description" 
                    id="description" 
                    rows="2" 
                    placeholder="Description Of The Post" style="margin-bottom: 2%;"
                ></textarea>
                <input type="submit" disabled button id="save-button" class="my-btn btn-dark" onclick="saveImage()" value="Add Post">
            </div>
    </div>
</div>