

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
    myreq.open("GET", "http://localhost/camagru-test/app/init.php?url=posts/postLiked/"+ userid + "/" + postid + "/1", true);
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
    req.open("GET", "http://localhost/camagru-test/app/init.php?url=posts/postCommented/"+ userid + "/" + postid + "/" + comment, true);
    req.send();
    req.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200)
        {
             var myDiv = document.createElement("DIV");
             myDiv.classList.add("comment-box");
             myDiv.innerHTML = '<img class="img-responsive img-thumbnail rounded-circle" style="width:43px;height:43px;" src="http://localhost/camagru-test/uploads/avatars/'+ avatar +'" alt=""><p class="lead"><a href="http://localhost/camagru-test/app/init.php?url=users/profile/'+ username +'">'+ username +' </a> '+ comment +'</p>';
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
    req.open("GET", "http://localhost/camagru-test/app/init.php?url=posts/notifView/"+ userid, true);
    req.send();
    req.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200)
        {
            notif.classList.toggle("show");
            if(n)
                n.style.display = "none";
            /*if (notif.style.display == "none")
                notif.classList.add("show");
                //notif.style.display = "block";
            else 
            {
                notif.classList.remove("show");
                //notif.style.display = "none";
                if(n)
                    n.style.display = "none";
            }*/
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

function showLikes(postid)
{
    var showLikes = document.getElementById("show-likes" + postid);
    showLikes.classList.toggle("show");
}