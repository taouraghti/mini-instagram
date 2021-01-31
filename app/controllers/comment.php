<?php
class comment extends Controller{
    public function __construct()
    {
            $this->postModel = $this->model('posts');
            $this->commentModel = $this->model('comments');
            $this->userModel = $this->model('users');
    }
}