<?php
class Sales extends Controller
{
    public function index()
    {
        $data['judul'] = "Daftar Sales";
        $data['sales'] = $this->model('Sales_model')->getAllSales();
        $this->view('templates/header', $data);
        $this->view('sales/index', $data);
        $this->view('templates/footer');
    }

    public function detail($sales_id)
    {
        $data['judul'] = "Detail Sales";
        $data['sales'] = $this->model('Sales_model')->getSalesById($sales_id);
        $this->view('templates/header', $data);
        $this->view('sales/detail', $data);
        $this->view('templates/footer');
    }

    public function addPage()
    {
        $data['judul'] = "Tambah data Sales";
        $data['cust'] = $this->model('Customer_model')->getAllCustomer();
        $data['prod'] = $this->model('Product_model')->getAllProduct();
        $this->view('templates/header', $data);
        $this->view('sales/addPage', $data);
        $this->view('templates/footer');
    }
    public function editPage($sales_id)
    {
        $data['judul'] = "Edit data Sales";
        $data['cust'] = $this->model('Customer_model')->getAllCustomer();
        $data['prod'] = $this->model('Product_model')->getAllProduct();
        $data['sales'] = $this->model('Sales_model')->getSalesById($sales_id);
        $this->view('templates/header', $data);
        $this->view('sales/editPage', $data);
        $this->view('templates/footer');
    }

    public function edit($sales_id)
    {
        $url = BASEURL . '/Sales' . '/index' . $sales_id;
        if ($this->model('Sales_model')->editDataSales($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'diubah');
            header("Location: $url");
            exit;
        } else {
            Flasher::setFlash('Gagal', 'diubah');
            header("Location: $url");
            exit;
        }
    }


    public function tambah()
    {
        if ($this->model('Sales_model')->tambahDataSales($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'ditambahkan');
            header('Location: ' . BASEURL . '/Sales');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'ditambahkan');
            header('Location: ' . BASEURL . '/Sales');
            exit;
        }
    }

    public function hapus($sales_id)
    {
        if ($this->model('Sales_model')->hapusDataSales($sales_id) > 0) {
            Flasher::setFlash('Berhasil', 'dihapus');
            header('Location: ' . BASEURL . '/Sales');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'dihapus');
            header('Location: ' . BASEURL . '/Sales');
            exit;
        }
    }
}
