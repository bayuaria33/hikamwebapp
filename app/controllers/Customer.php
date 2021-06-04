<?php
class Customer extends Controller
{
    public function index()
    {
        $data['judul'] = "Daftar Customer";
        $data['cust'] = $this->model('Customer_model')->getAllCustomer();
        $this->view('templates/header', $data);
        $this->view('customer/index', $data);
        $this->view('templates/footer');
    }

    public function detail($customer_id)
    {
        $data['judul'] = "Detail Customer";
        $data['cust'] = $this->model('Customer_model')->getCustomerById($customer_id);
        $this->view('templates/header', $data);
        $this->view('customer/detail', $data);
        $this->view('templates/footer');
    }

    public function addPage()
    {
        $data['judul'] = "Tambah data Customer";
        $this->view('templates/header', $data);
        $this->view('customer/addPage');
        $this->view('templates/footer');
    }


    public function tambah()
    {
        if ($this->model('Customer_model')->tambahDataCustomer($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'ditambahkan');
            header('Location: ' . BASEURL . '/Customer');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'ditambahkan');
            header('Location: ' . BASEURL . '/Customer');
            exit;
        }
    }
}
