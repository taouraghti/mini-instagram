<?php
    if(isset($_SESSION['username']))
    {
?>

<div class="container">
    <h1 class="text-center">Add New Post</h1>
    <div class="card border-secondary" style="margin-top:30px">
        <form 
            action="<?php echo URLROOT . '/app/init.php?url=post/insertPost'; ?>"
            method="POST"
            enctype="multipart/form-data"
            style="max-width:500px;margin:0 auto"
        >
            <div style="max-width:500px;margin:0 auto">
                <video id="video" style="width:100%;height:auto">Stream not available...</video>
            </div>
                <button id="photo-button" class="my-btn btn-dark">
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
            <input type="submit" button id="photo-button" class="my-btn btn-dark" value="Add Post">
                
        </form>
    </div>
</div>


<?php 
    }
    else
    {
        echo '<div class="container" style="margin-top:100px;">';
            echo "<div class='alert alert-danger text-center'>Sorry you can't brows this page directly </div>";
            echo "<div class='alert alert-info text-center'>You Will Be Redirected to the previous After 3 seconds <i class='fa fa-check'></i></div>";
        echo '</div>';
        header('refresh:3;http://localhost/instagram');
    } 
?>