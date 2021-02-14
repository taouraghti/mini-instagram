<?php
class post extends Controller{
    public function __construct()
    {
        $this->postModel = $this->model('posts');
        $this->userModel = $this->model('users');
        $this->likeModel = $this->model('likes');
        $this->commentModel = $this->model('comments');
        if(isset($_SESSION['username']))
        {
            $notif['like'] = $this->likeModel->getNotif();
            $notif += ['comment' => $this->commentModel->getNotif()];
            $this->view('templates/navbar',$notif);
        }
        else
        {
            if($_SERVER["REQUEST_METHOD"] != "POST")
                redirect("");
        }
    }

    public function home()
    {
        $data['post'] = $this->postModel->getAll();
        $data += ['like' => $this->likeModel->getAll()];
        $data += ['comment' => $this->commentModel->getAll()];
        $this->view('user/home', $data);
        $this->view('templates/userFooter');
    }

    public function postLiked($userid, $postid)
    {
        $this->likeModel->getLike($userid, $postid);
    }

    public function notifView($userid)
    {
        $this->postModel->notifView($userid);
    }

    public function postCommented($userid, $postid, $comment)
    {
        //session_start();
        $this->commentModel->comment($userid, $postid, $comment);
    }

    public function newPost()
    {
        $this->view('user/newpost');
        $this->view('templates/userfooter');
    }

    /*public function tmpPost()
    {

    }*/
    public function insertPost()
    {
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $desc = filter_var($_POST['description'], FILTER_SANITIZE_STRING);

            if(isset($_POST['postimg']))
            {
                $image = $_POST['postimg'];
                $image = explode(";",$image)[1];
                $image = explode(",",$image)[1];
                $image = str_replace(" ","+", $image);
                $image = base64_decode($image);
                $imgName = rand(0, 100000) . '_' . randstr() . ".png";
                $imgUpload = "../uploads/posts/" . $imgName;
                file_put_contents($imgUpload, $image);
                $this->postModel->insert($desc, $imgName);
            }
            else
            {
                $image = $_FILES['postimg'];
                $imageName = $image['name'];
                $imageSize = $image['size'];
                $imageTmp = $image['tmp_name'];
                $imageType = $image['type'];
                // List Of Allowed File Types
                $imageAllowedExtension = array('jpeg', 'jpg', 'png', 'gif');
                $imageExtension = explode('.', $imageName);
                $ext = strtolower(end($imageExtension));

                $dataErr = [];
                if (!empty($imageName) && !in_array($ext, $imageAllowedExtension))
                    $dataErr[] = "This Extension is Not <strong>Allowed</strong>";
                if(empty($imageName))
                    $dataErr[] = "You Must Choose An Image";
                if(empty($dataErr))
                {
                    $img = rand(0, 100000) . '_' . $imageName;
                    move_uploaded_file($imageTmp, "../uploads/posts/" . $img);

                    if($this->postModel->insert($desc, $img) == 1)
                        redirect("app/init.php?url=post/home");
                    else
                        $dataErr[] = "Error";
                }
                redirectError("app/init.php?url=post/newPost", $dataErr);
            }
            
        }
    }


    public function showPost($postid)
    {
        $data['post'] = $this->postModel->getPost($postid);
        $data += ['like' => $this->likeModel->getAll($postid)];
        $data += ['comment' => $this->commentModel->getAll($postid)];
        $this->view('user/post', $data);
        $this->view('templates/userfooter');
    }

    public function deletePost($postid)
    {
        $this->postModel->delete($postid);
        redirect("app/init.php?url=user/profil/" . $_SESSION["username"]);
    }


}