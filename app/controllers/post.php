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
        $this->view('posts/newpost');
        $this->view('templates/footer');
    }

    /*public function tmpPost()
    {

    }*/
    public function insertPost()
    {
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $desc = filter_var($_POST['description'], FILTER_SANITIZE_STRING);

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

                if($this->postModel->newPost($desc, $img) == 1)
                    redirect("app/init.php?url=posts/homepage");
                else
                    $dataErr[] = "Error";
            }
            redirectError("app/init.php?url=posts/newPost", $dataErr);
        }
    }


    public function showPost($postid)
    {
        $data = $this->postModel->getAllPost("WHERE PostId=$postid");
        $like = $this->postModel->getElements("likes","likeId", "WHERE PostId=$postid", 1);
        $comment = $this->postModel->getElements("comments", "CommentId", "WHERE PostId=$postid", 1);
        if ($like != 0 )
            $data = array_merge($data, $like);
        if ($comment != 0 )
            $data = array_merge($data, $comment);
        $this->view('posts/showPost', $data);
        $this->view('templates/footer');
    }

    public function deletePost($postid)
    {
        $this->postModel->deltePost($postid);
        redirect("app/init.php?url=users/profile/" . $_SESSION["username"]);
    }


}