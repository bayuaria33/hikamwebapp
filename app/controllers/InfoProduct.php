<?php
class InfoProduct extends Controller
{
    public function index()
    {
        $data['judul'] = "Daftar InfoProduct";
        $data['inprod'] = $this->model('InfoProduct_model')->getAllInfoProduct();
        $this->view('templates/header', $data);
        $this->view('infoproduct/index', $data);
        $this->view('templates/footer');
    }

    public function detail($infoproduct_id)
    {
        $data['judul'] = "Detail InfoProduct";
        $data['inprod'] = $this->model('InfoProduct_model')->getInfoProductById($infoproduct_id);
        $this->view('templates/header', $data);
        $this->view('infoproduct/detail', $data);
        $this->view('templates/footer');
    }

    public function details($product_id)
    {
        $data['judul'] = "Detail InfoProduct";
        $data['inprod'] = $this->model('InfoProduct_model')->getProductInfoById($product_id); //BARU
        $this->view('templates/header', $data);
        $this->view('infoproduct/detail', $data);
        $this->view('templates/footer');
    }

    public function addPage()
    {
        $data['judul'] = "Tambah data InfoProduct";
        $this->view('templates/header', $data);
        $this->view('infoproduct/addPage');
        $this->view('templates/footer');
    }
    public function editPage($infoproduct_id)
    {
        $data['judul'] = "Edit data InfoProduct";
        $data['inprod'] = $this->model('InfoProduct_model')->getInfoProductById($infoproduct_id);
        $this->view('templates/header', $data);
        $this->view('infoproduct/editPage', $data);
        $this->view('templates/footer');
    }

    public function edit()
    {
        if ($this->model('InfoProduct_model')->editDataInfoProduct($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'diubah');
            header('Location: ' . BASEURL . '/InfoProduct');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'diubah');
            header('Location: ' . BASEURL . '/InfoProduct');
            exit;
        }
    }


    public function tambah()
    {
        if ($this->model('InfoProduct_model')->tambahDataInfoProduct($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'ditambahkan');
            header('Location: ' . BASEURL . '/InfoProduct');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'ditambahkan');
            header('Location: ' . BASEURL . '/InfoProduct');
            exit;
        }
    }

    public function hapus($infoproduct_id)
    {
        if ($this->model('InfoProduct_model')->hapusDataInfoProduct($infoproduct_id) > 0) {
            Flasher::setFlash('Berhasil', 'dihapus');
            header('Location: ' . BASEURL . '/InfoProduct');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'dihapus');
            header('Location: ' . BASEURL . '/InfoProduct');
            exit;
        }
    }

    public function cari()
    {
        $data['judul'] = "Daftar InfoProduct";
        $data['inprod'] = $this->model('InfoProduct_model')->cariDataInfoProduct();
        $this->view('templates/header', $data);
        $this->view('infoproduct/index', $data);
        $this->view('templates/footer');
    }
}
