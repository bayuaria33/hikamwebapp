<?php
class Home extends Controller
{
    public function index()
    {
        $data['judul'] = "Home";
        if (empty($_SESSION)) {
            $_SESSION['user_id'] = null;
            $_SESSION['username'] = null;
            $_SESSION['level_user'] = null;
        }
        $this->view('templates/header', $data);
        $this->view('home/index');
        $this->view('templates/footer');
    }

    public function login()
    {
        header('location:' . BASEURL . '/users/login');
    }
}
