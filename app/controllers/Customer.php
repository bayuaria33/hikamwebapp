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
    public function editPage($customer_id)
    {
        $data['judul'] = "Edit data Customer";
        $data['cust'] = $this->model('Customer_model')->getCustomerById($customer_id);
        $this->view('templates/header', $data);
        $this->view('customer/editPage', $data);
        $this->view('templates/footer');
    }

    public function edit()
    {
        if ($this->model('Customer_model')->editDataCustomer($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'diubah');
            header('Location: ' . BASEURL . '/Customer');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'diubah');
            header('Location: ' . BASEURL . '/Customer');
            exit;
        }
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

    public function hapus($customer_id)
    {
        if ($this->model('Customer_model')->hapusDataCustomer($customer_id) > 0) {
            Flasher::setFlash('Berhasil', 'dihapus');
            header('Location: ' . BASEURL . '/Customer');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'dihapus');
            header('Location: ' . BASEURL . '/Customer');
            exit;
        }
    }

    public function cari()
    {
        $data['judul'] = "Daftar Customer";
        $data['cust'] = $this->model('Customer_model')->cariDataCustomer();
        $this->view('templates/header', $data);
        $this->view('customer/index', $data);
        $this->view('templates/footer');
    }
}
