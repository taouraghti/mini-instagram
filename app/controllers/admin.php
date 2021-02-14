<?php

class admin extends controller
{
    public function __construct()
    {
        $this->adminModel = $this->model('admins');
        $this->userModel = $this->model('users');
        $this->postModel = $this->model('posts');
        $this->commentModel = $this->model('comments');
        if(isset($_SESSION['username']) && $_SESSION['group'] == 1)
            $this->view('admin/navbar');
        else
        {
            if($_SERVER["REQUEST_METHOD"] != "POST")
            {
                $this->index();
                exit();
            }
        }
    }

    public function index()
    {
        if(isset($_SESSION['username']) && $_SESSION['group'] == 1)
            redirect('app/initadmin.php?url=admin/dashboard');
        else
        {
            $this->view('admin/login');
            $this->view('templates/footer');
        }
    }

    public function login()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $username = $_POST['user'];
            $pass = $_POST['pass'];
            $dataErr = [];
            $data = [];
            if(($loggedInAdmin = $this->adminModel->login($username, $pass)) != -1)
            {
                createSessionUser($loggedInAdmin);
                redirect('app/initadmin.php?url=admin/dashboard');
            }
                
            else
            {
                $dataErr[] = "Username or password incorrect";
                redirectError("/admin", $dataErr);
            }
        }
    }

    public function member()
    {
        $data = $this->userModel->getAll();
        $this->view("admin/member",$data);
        $this->view('templates/footer');
    }

    public function comment()
    {
        $data = $this->commentModel->getAll();
        $this->view("admin/comment",$data);
        $this->view('templates/footer');
    }

    public function post()
    {
        $data = $this->postModel->getAll();
        $this->view("admin/post",$data);
        $this->view('templates/footer');
    }

    public function dashboard()
    {
        $data['countAllUser'] = $this->userModel->countAll();
        $data += ['countPendUser' => $this->userModel->countPend()];
        $data += ['LatestUser' => $this->userModel->getLatest()];
        $data += ['countpost' => $this->postModel->countpost()];
        $data += ['Latestpost' => $this->postModel->getLatest()];
        $data += ['countComment' => $this->commentModel->countComment()];
        $data += ['LatestComment' => $this->commentModel->getLatest()];
        $this->view('admin/dashboard',$data);
        $this->view('templates/footer');
    }

    public function addMember()
    {
        $this->view('admin/addMember');
        $this->view('templates/footer');
    }

    public function editMember($id)
    {
        $data = $this->userModel->getOne($id);
        $this->view('admin/editMember',$data);
        $this->view('templates/footer');
    }

    public function updateMember()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $avatar = $_FILES['avatar'];
            $avatarName = $avatar['name'];
            $avatarSize = $avatar['size'];
            $avatarTmp = $avatar['tmp_name'];
            $avatarType = $avatar['type'];

            // List Of Allowed File Types
            $avatarAllowedExtension = array('jpeg', 'jpg', 'png', 'gif');
            $avatarExtension = explode('.', $avatarName);
            $ext = strtolower(end($avatarExtension));

            $pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : $pass = sha1($_POST['newpassword']);
            $dataErr = [];

            $data['fullname'] = filter_var($_POST['fullname'], FILTER_SANITIZE_STRING);
            $data += ['id' =>  $_POST['userid']];
            $data += ['email' => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) ];
            $data += ['username' => filter_var($_POST['username'], FILTER_SANITIZE_STRING) ];
            $data += ['password' => $pass ];

            if ($this->userModel->findUserByUsername($data['username'], $data['id']) == 1)
                $dataErr[] = "Username is already <strong>exist</strong>";
            if(empty($data['username']))
                $dataErr[] = "Username can't be <strong>Empty</strong>";
            if(empty($data['email']))
                $dataErr[] = "Email can't be <strong>Empty</strong>";
            if(empty($data['fullname']))
                $dataErr[] = "Full name can't be <strong>Empty</strong>";
            if (!empty($avatarName) &&!in_array($ext, $avatarAllowedExtension))
                $dataErr[] = "This Extension is Not <strong>Allowed</strong>";
            //Update The DataBase With This infos

            if (empty($dataErr))
            {
                if(empty($avatarName))
                {
                    $r = $this->userModel->getOne($data['id']);
                    $av = $r['Avatar'];
                }
                else
                {
                    $av = rand(0, 100000) . '_' . $avatarName;
                    move_uploaded_file($avatarTmp, "../uploads/avatars/" . $av);
                }
                $data += ['avatar' => $av];
                $this->userModel->update($data);
            }
                $this->view('admin/result',$dataErr);
        }
        else
        {
            $this->index();
            exit();
        }
        $this->view('templates/footer');
    }

    public function insertMember()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $avatar = $_FILES['avatar'];
            $avatarName = $avatar['name'];
            $avatarSize = $avatar['size'];
            $avatarTmp = $avatar['tmp_name'];
            $avatarType = $avatar['type'];

            // List Of Allowed File Types
            $avatarAllowedExtension = array('jpeg', 'jpg', 'png', 'gif');
            $avatarExtension = explode('.', $avatarName);
            $ext = strtolower(end($avatarExtension));

            $dataErr = [];
            $data['fullname'] = filter_var($_POST['fullname'], FILTER_SANITIZE_STRING);
            $data['username'] = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
            $data += ['email' => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) ];
            $data += ['username' => filter_var($_POST['username'], FILTER_SANITIZE_STRING) ];
            $data += ['password' => sha1($_POST['password']) ];
            if(empty($data['fullname']))
                $dataErr[] = "Full name can't be <strong>Empty</strong>";
            if(empty($data['password']))
                $dataErr[] = "Password can't be <strong>Empty</strong>";
            if(empty($data['email']))
                $dataErr[] = "Email can't be <strong>Empty</strong>";
            if(empty($data['username']))
                $dataErr[] = "Username can't be <strong>Empty</strong>";
            if ($this->userModel->findUserByUsername($data['username']) == 1)
                $dataErr[] = "Username is already <strong>exist</strong>";
            else
            {
                if ($this->userModel->findUserByUsername($data['username']) == 1)
                    $dataErr[] = "Username is already <strong>Taken</strong>";
            }
            if (!empty($avatarName) && !in_array($ext, $avatarAllowedExtension))
                $dataErr[] = "This extension is not <strong>Allowed</strong>";
            
            if(empty($dataErr))
            {
                if(empty($avatarName))
                    $av = "inko.png";
                else
                {
                    $av = rand(0, 100000) . '_' . $avatarName;
                    move_uploaded_file($avatarTmp, "../uploads/avatars/" . $av);
                }
                $data += ["avatar" => $av];
                $this->userModel->insert($data);
            }
            $this->view('admin/result',$dataErr);
        }
        else
        {
            $this->index();
            exit();
        }
        $this->view('templates/footer');
    }

    public function activateMember($id, $url)
    {
        $this->userModel->activate($id);
        redirect('app/initadmin.php?url=admin/'.$url);
    }

    public function deleteMember($id)
    {
        $this->userModel->delete($id);
        redirect('app/initadmin.php?url=admin/member');
    }

    public function addPost()
    {
        $this->view('admin/addPost');
        $this->view('templates/footer');
    }

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

                if($this->postModel->insert($desc, $img) == 1)
                    redirect("app/initadmin.php?url=admin/post");
                else
                    $dataErr[] = "Error";
            }
            $this->view('admin/result',$dataErr);
        }
        else
        {
            $this->index();
            exit();
        }
        $this->view('templates/footer');
    }

    public function editPost($id)
    {
        $data = $this->postModel->getPost($id);
        $this->view('admin/EditPost', $data);
        $this->view('templates/footer');
    }

    public function updatePost()
    {
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $desc = $_POST['description'];
            $status = ($_POST['status'] == 1 ? 1 : 0);
            $id = $_POST['postid'];
            $data = $this->postModel->update($id, $desc, $status);
            redirect("app/initadmin.php?url=admin/post");
        }    
        else
        {
            $this->index();
            exit();
        }
    }

    public function deletePost($id)
    {
        $this->postModel->delete($id);
        redirect('app/initadmin.php?url=admin/post');
    }

    public function approvePost($id, $url)
    {
        $this->postModel->approve($id);
        redirect('app/initadmin.php?url=admin/'.$url);
    }

    public function deleteComment($id)
    {
        $this->commentModel->delete($id);
        redirect('app/initadmin.php?url=admin/comment');
    }
    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        redirect('app/initadmin.php?url=admin/index');
    }
}
