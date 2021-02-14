

/*******  Start Login Page  ***********/

var b = document.getElementById("login-btn"),
    a = document.getElementById("signup-btn"),
    c = document.getElementById("login"),
    d = document.getElementById("signup");
    
if(a)
{
    a.onclick = function(){
        c.classList.remove("selected");
        c.classList.add("not-selected");
        d.classList.remove("not-selected")
        d.classList.add("selected");
    };
}
if(b)
{
    b.onclick = function(){
        d.classList.remove("selected");
        d.classList.add("not-selected");
        c.classList.remove("not-selected")
        c.classList.add("selected");
    };
}

/*******  End Login Page  ***********/

/*********** Function For liking Post *******/

function getlike(element, userid, postid)
{
    var myreq = new XMLHttpRequest(),
        x, y;
    myreq.open("GET", "http://localhost/instagram/app/init.php?url=post/postLiked/" + userid + "/" + postid, true);
    myreq.send();
    myreq.onreadystatechange = function(){
        var nb = document.getElementById("nblike" + postid);
        if(this.readyState == 4 && this.status == 200)
        {
            y = (parseInt(nb.innerHTML)) ? parseInt(nb.innerHTML) : 0;
            if(element.classList.contains('far'))
            {
                element.classList.remove("far");
                element.classList.add("fas");
                x = y + 1;
            }
            else
            {
                element.classList.remove("fas");
                element.classList.add("far");
                x = y - 1
            }
            if (x > 1)
                nb.innerHTML = x + " likes";
            else if (x == 1)
                nb.innerHTML = x + " like";
            else
                nb.innerHTML = "";
        }
    };
}

/* ************************************************* */

/* ************Live Post Function *********** */

function livePost(element)
{
    var liveDesc = document.getElementById("live-desc");
        liveDesc.textContent = element.value;
}

/* ************************************************* */

function submitBtn(element, postid)
{
    var btn = document.getElementById('submit-btn' + postid);
    if(element.value !== "")
    {
        btn.style.color = "#0095f6";
        btn.removeAttribute("disabled");
    }   
    else
    {
        btn.style.color = "rgba(0,149,246, .3)";
        btn.setAttribute("disabled","true");
    }
}

function getComment(element, userid, postid, username, avatar)
{
    var com = document.getElementById("comment" + postid),
        comment = com.value,
        comDiv = document.getElementById("com" + postid);
    com.value = "";
    console.log(com.value);

    var req = new XMLHttpRequest();
    req.open("GET", "http://localhost/instagram/app/init.php?url=post/postCommented/"+ userid + "/" + postid + "/" + comment);
    req.send();
    req.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200)
        {
             var myDiv = document.createElement("DIV");
             myDiv.classList.add("comment-box");
             myDiv.innerHTML = '<img class="img-responsive img-thumbnail rounded-circle" style="width:43px;height:43px;" src="http://localhost/instagram/uploads/avatars/'+ avatar +'" alt=""><p class="lead"><a href="http://localhost/instagram/app/init.php?url=user/profile/'+ username +'">'+ username +' </a> '+ comment +'</p>';
             comDiv.appendChild(myDiv)
             element.style.color = "rgba(0,149,246, .3)";
             element.setAttribute("disabled","true");
        }
    };
}


function showNotif(userid)
{
    var notif = document.getElementById("notifications");
    var n = document.getElementById("likesnb");
    var req = new XMLHttpRequest();
    req.open("GET", "http://localhost/instagram/app/init.php?url=post/notifView/"+ userid, true);
    req.send();
    req.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200)
        {
            notif.classList.toggle("show");
            if(n)
                n.style.display = "none";
        }
    }
}

function afficheEditeDel()
{
    var myDiv = document.getElementById("editeDelete");
    myDiv.classList.toggle("show");
}
/*
$(function(){
$('#inputGroupFile02').on('change',function(){
    //get the file name
    var fileName = $(this).val().replace('C:\\fakepath\\', " ");   //replace the "Choose a file" label
    $(this).next('.custom-file-label').html(fileName);
})
});*/

function changeFile(element)
{
    var fileName = element.value.replace('C:\\fakepath\\', " "),
        myLabel = document.getElementById("myLabel");
    //console.log(fileName);
    myLabel.textContent = fileName;
    
}

function choicePic(element){
    var checked = document.getElementsByClassName("pic-checked"),
        takePic = document.getElementById("take-pic"),
        uploadPic = document.getElementById("upload-pic");
    if(!element.classList.contains("pic-checked"))
    {
        checked[0].classList.remove("pic-checked");
        element.classList.add("pic-checked");
        if(takePic.classList.contains("not-selected"))
        {
            console.log("take-pic");
            takePic.classList.remove("not-selected");
            uploadPic.classList.add("not-selected");
        }
        else
        {
            console.log("upload-pic");
            takePic.classList.add("not-selected");
            uploadPic.classList.remove("not-selected");
        }   
    }
}

function saveImage()
{
    var desc = document.getElementById("description"),
        canvas = document.getElementById('canvas');
    var req = new XMLHttpRequest();
    req.open("POST", "http://localhost/instagram/app/init.php?url=post/insertPost");
    req.withCredentialfull_canvas = true;
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    req.send("postimg=" + canvas.toDataURL("image/png")+"&description=" + desc.value);
    req.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200)
        {
            window.location.replace("http://localhost/instagram/app/init.php?url=post/home");        }
    }
}

function showLikes(postid)
{
    var showLikes = document.getElementById("show-likes" + postid);
    showLikes.classList.toggle("show");
}

let width = 500,
    height = 0,
    filter = "none",
    streaming = false;
    
const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const photos = document.getElementById('photos');
const clearButton = document.getElementById('clear-button');
const photoFilter = document.getElementById('photo-filter');
const saveButton = document.getElementById('save-button');


function takePicture() {
    // Create canvas
    const context = canvas.getContext('2d');
    if(width && height) {
        console.log(height);
        // set canvas props
        canvas.width = width;
        canvas.height = height;
        // Draw an image of the video on the canvas
        context.filter = filter;
        context.drawImage(video, 0, 0, width, height);
        //context.drawImage(video.style.filter, 0, 0, width, height);
        // Create image from the canvas
        const imgUrl = canvas.toDataURL('image/png');
        const img = document.createElement("img");
        img.setAttribute('src', imgUrl);

        // Set image filter
        img.style.filter = filter;
        //context.drawImage(img, 0, 0, width, height);
        photos.appendChild(img);
        saveButton.disabled = false;
    }   
}
// Get media stream

if(video && canvas && photos)
{
    navigator.mediaDevices.getUserMedia({video: true, audio: false})
        .then(function(stream){
            // Link to the video source
            video.srcObject = stream;
            //play video
            video.play();
        })
        .catch(function(err){
            console.log('error : ' + err);
        });
        // Play when ready
    video.addEventListener('canplay', function(e) {
        if(!streaming) {
        // Set video / canvas height
        height = video.videoHeight / (video.videoWidth / width);

        video.setAttribute('width', width);
        video.setAttribute('height', height);
        canvas.setAttribute('width', width);
        canvas.setAttribute('height', height);

        streaming = true;
        }
    }, false);

    /*photoButton.addEventListener('click', function(e){
        console.log("ok");
        //takePicture();
        //e.preventDefault();
    });*/

    // Filter event
    photoFilter.addEventListener('change', function(e) {
        // Set filter to chosen option
        filter = e.target.value;
        // Set filter to video
        video.style.filter = filter;

        e.preventDefault(); 
    });

    // Clear event
    clearButton.addEventListener('click', function(e) {
        // Clear photos
        photos.innerHTML = '';
        // Change filter back to none
        filter = 'none';
        // Set video filter
        video.style.filter = filter;
        // Reset select list
        photoFilter.selectedIndex = 0;
    });

}