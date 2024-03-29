<?php
class Product extends Controller
{
    public function index()
    {
        $data['judul'] = "Daftar Product";
        $data['prod'] = $this->model('Product_model')->getAllProduct();
        if ($_SESSION['level_user'] == '1' or $_SESSION['level_user'] == '2' or $_SESSION['level_user'] == '3' or $_SESSION['level_user'] == '4' or $_SESSION['level_user'] == '5') {
            $this->view('templates/header', $data);
            $this->view('product/index', $data);
            $this->view('templates/footer');
        } else {
            header('Location:' . BASEURL);
        }
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
        $url = BASEURL . '/Product';
        if ($this->model('Product_model')->editDataProduct($_POST) > 0) {
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
        $url = BASEURL . '/Product';
        if ($this->model('Product_model')->tambahDataProduct($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'ditambahkan');
            header("Location: $url");
            exit;
        } else {
            Flasher::setFlash('Gagal', 'ditambahkan');
            header("Location: $url");
            exit;
        }
    }

    public function hapus($product_id)
    {
        $url = BASEURL . '/Product';
        if ($this->model('Product_model')->hapusDataProduct($product_id) > 0) {
            Flasher::setFlash('Berhasil', 'dihapus');
            header("Location: $url");
            exit;
        } else {
            Flasher::setFlash('Gagal', 'dihapus');
            header("Location: $url");
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
