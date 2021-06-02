<?php

class About extends Controller
{
    public function index($aa = "1", $bb = "2", $cc = "3")
    {
        $data['judul'] = "About";
        $data['aa'] = $aa;
        $data['bb'] = $bb;
        $data['cc'] = $cc;
        $this->view('templates/header', $data);
        $this->view('about/index', $data);
        $this->view('templates/footer');
    }
    public function page()
    {
        $data['judul'] = "Page";
        $this->view('templates/header', $data);
        $this->view('about/page');
        $this->view('templates/footer');
    }
}
