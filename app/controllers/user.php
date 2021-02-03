<?php

class user extends controller
{
    //private $userModel;
    public function __construct()
    {
        $this->userModel = $this->model('users');
        $this->postModel = $this->model('posts');
        $this->commentModel = $this->model('comments');
        $this->likeModel = $this->model('likes');

        if(isset($_SESSION['username']))
        {
            $notif['like'] = $this->likeModel->getNotif();
            $notif += ['comment' => $this->commentModel->getNotif()];
            $this->view('templates/navbar',$notif);
        }
    }

    public function index()
    {
        if(isset($_SESSION['username']))
            redirect('app/init.php?url=post/home');
        else
        {
            $this->view('user/login');
            $this->view('templates/userfooter');
        }
    }
    public function login()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $username = $_POST['username'];
            $password = $_POST['password'];
            //$hashedPass = sha1($password);
            $dataErr = [];
            $loggedInUser = $this->userModel->login($username, $password);
            if($loggedInUser != -1)
            {
                createSessionUser($loggedInUser);
                redirect('app/init.php?url=post/home');
            }
                
            else
            {
                $dataErr[] = "Username or password incorrect";
                redirectError("index.php", $dataErr);
            }
        }
    }

    public function signup()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $dataUser = [
                'fullname'  => '',
                'email'     => '',
                'username'  => '',
                'password'  => ''
            ];
            $dataErr = [];
            $dataUser['fullname'] = filter_var($_POST['fullname'], FILTER_SANITIZE_STRING);
            $dataUser['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $dataUser['username'] = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
            $dataUser['password'] = $_POST['password'];
            if(empty($dataUser['fullname']))
                $dataErr[] = "Full name can't be <strong>Empty</strong>";
            if(empty($dataUser['email']))
                $dataErr[] = "Email can't be <strong>Empty</strong>";
            if(empty($dataUser['username']))
                $dataErr[] = "Username can't be <strong>Empty</strong>";
            else
            {
                if ($this->userModel->findUserByUsername($dataUser['username']) == 1)
                    $dataErr[] = "Username is already <strong>Taken</strong>";
            }
            if(empty($dataUser['password']))
                $dataErr[] = "Password can't be <strong>Empty</strong>";
            
            if(empty($dataErr))
            {
                $loggedInUser = $this->userModel->signup($dataUser);
                createSessionUser($loggedInUser);
                redirect('app/init.php?url=post/home');
            }
            else
                redirectError("/index.php", $dataErr);
        }
    }

    public function profile($user)
    {
        //session_start();
        if(isset($_SESSION['username']))
        {
            if ($_SESSION['username'] == $user)
                $data = $this->postModel->getPostsProfile();
            else
                $data = $this->userModel->getInfoProfile($user);
            $this->view('users/profile', $data);
            $this->view('templates/footer');
        }
        else
        {
            $this->view('user/login');
            $this->view('templates/userfooter');
        }

    }

    public function editProfile()
    {
        if(isset($_SESSION['username']))
        {
            $this->view('users/editprofile');
            $this->view('templates/footer');
        }
        else
        {
            $this->view('user/login');
            $this->view('templates/userfooter');
        }
    }

    public function updateProfile()
    {
        //session_start();
        if(isset($_SESSION['username']) && $_SERVER["REQUEST_METHOD"] == "POST")
        {
            $dataUser = [
                'userid'      => '',
                'fullname'      => '',
                'email'         => '',
                'username'      => '',
                'oldpassword'   => '',
                'newpassword'   => '',
                'avatar'        => ''
            ];
            $dataErr = [];
            $dataUser['userid'] = $_POST['userid'];
            $dataUser['fullname'] = filter_var($_POST['fullname'], FILTER_SANITIZE_STRING);
            $dataUser['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $dataUser['username'] = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
            $dataUser['oldpassword'] = $_POST['oldpassword'];
            $dataUser['newpassword'] = $_POST['newpassword'];

            $avatar = $_FILES['avatar'];
            $avatarName = $avatar['name'];
            $avatarSize = $avatar['size'];
            $avatarTmp = $avatar['tmp_name'];
            $avatarType = $avatar['type'];

            // List Of Allowed File Types
            $avatarAllowedExtension = array('jpeg', 'jpg', 'png', 'gif');
            $avatarExtension = explode('.', $avatarName);
            $ext = strtolower(end($avatarExtension));

            if (!empty($avatarName) && !in_array($ext, $avatarAllowedExtension))
                $dataErr[] = "This Extension is Not <strong>Allowed</strong>";
            if(empty($dataUser['fullname']))
                $dataErr[] = "Full name can't be <strong>Empty</strong>";
            if(empty($dataUser['email']))
                $dataErr[] = "Email can't be <strong>Empty</strong>";
            if(empty($dataUser['username']))
                $dataErr[] = "Username can't be <strong>Empty</strong>";
            else
            {
                if ($this->userModel->findUserByUsername($dataUser['username'], $_SESSION['userid']) > 0)
                    $dataErr[] = "Username is already <strong>Taken</strong>";
            }
            if(empty($dataUser['oldpassword']))
                $dataErr[] = "Password can't be <strong>Empty</strong>";
            else
            {
                if ($this->userModel->findUserByPassword($dataUser['oldpassword']) == 0)
                    $dataErr[] = "Password is <strong>Incorrect</strong>";
                if(empty($dataUser['newpassword']))
                    $dataUser['newpassword'] = $dataUser['oldpassword'];
            }
            
            if(empty($dataErr))
            {
                if(empty($avatarName))
                    $av = "inko.png";
                else
                {
                    $av = rand(0, 100000) . '_' . $avatarName;
                    move_uploaded_file($avatarTmp, "../uploads/avatars/" . $av);
                }
                $dataUser['avatar'] = $av;
                if(($d = $this->userModel->updateProfile($dataUser)) > 0)
                    createSessionUser($d); 
                redirect('app/init.php?url=users/profile/' . $_SESSION['username']);
            }
            else
                redirectError($_SERVER['HTTP_REFERER'], $dataErr, 1);
        }
        else
        {
            $this->view('user/login');
            $this->view('templates/userfooter');
        }

    }

    public function logout()
    {
        //session_start();
        session_unset();
        session_destroy();
        redirect('index.php');
    }
    
}

?>