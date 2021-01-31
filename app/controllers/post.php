<?php
class post extends Controller{
    public function __construct()
    {
            $this->postModel = $this->model('posts');
            $this->userModel = $this->model('users');
    }

}