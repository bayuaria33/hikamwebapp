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

        $data['inv'] = $this->model('Home_model')->getTotalInvoice();
        $data['purch'] = $this->model('Home_model')->getTotalPurchase();
        $data['petty'] = $this->model('Home_model')->getTotalPetycash();
        $data['totinv'] = $this->model('Home_model')->getTotalInvoiceMont();
        $data['totpurch'] = $this->model('Home_model')->getTotalPurchMont();
        $data['totpetty'] = $this->model('Home_model')->getTotalPettyCash();
        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }

    public function login()
    {
        header('location:' . BASEURL . '/users/login');
    }
}
