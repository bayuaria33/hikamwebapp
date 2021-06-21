<?php
class Product extends Controller
{
    public function index()
    {
        $data['judul'] = "Daftar Product";
        $data['prod'] = $this->model('Product_model')->getAllProduct();
        $this->view('templates/header', $data);
        $this->view('product/index', $data);
        $this->view('templates/footer');
    }


    public function addPage()
    {
        $data['judul'] = "Tambah data Product";
        $this->view('templates/header', $data);
        $this->view('product/addPage');
        $this->view('templates/footer');
    }
    public function editPage($product_id)
    {
        $data['judul'] = "Edit data Product";
        $data['prod'] = $this->model('Product_model')->getProductById($product_id);
        $this->view('templates/header', $data);
        $this->view('product/editPage', $data);
        $this->view('templates/footer');
    }

    public function edit()
    {
        if ($this->model('Product_model')->editDataProduct($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'diubah');
            header('Location: ' . BASEURL . '/Product');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'diubah');
            header('Location: ' . BASEURL . '/Product');
            exit;
        }
    }


    public function tambah()
    {
        if ($this->model('Product_model')->tambahDataProduct($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'ditambahkan');
            header('Location: ' . BASEURL . '/Product');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'ditambahkan');
            header('Location: ' . BASEURL . '/Product');
            exit;
        }
    }

    public function hapus($product_id)
    {
        if ($this->model('Product_model')->hapusDataProduct($product_id) > 0) {
            Flasher::setFlash('Berhasil', 'dihapus');
            header('Location: ' . BASEURL . '/Product');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'dihapus');
            header('Location: ' . BASEURL . '/Product');
            exit;
        }
    }

    public function cari()
    {
        $data['judul'] = "Daftar Product";
        $data['prod'] = $this->model('Product_model')->cariDataProduct();
        $this->view('templates/header', $data);
        $this->view('product/index', $data);
        $this->view('templates/footer');
    }
}
