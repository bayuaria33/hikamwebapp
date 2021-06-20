<?php
class InfoProduct extends Controller
{
    public function index()
    {
        $data['judul'] = "Daftar InfoProduct";
        $data['inprod'] = $this->model('InfoProduct_model')->getAllInfoProduct();
        //echo '<pre>', var_dump($data), '</pre>';
        $this->view('templates/header', $data);
        $this->view('infoproduct/index', $data);
        $this->view('templates/footer');
    }

    public function detailSupp($product_id)
    {
        $data['inprod'] = $this->model('InfoProduct_model')->getAllProductSupp($product_id); //BARU
        $data['judul'] = $data['inprod'][0]['product_name'];
        //echo '<pre>', var_dump($data), '</pre>';
        if (!empty($data['inprod'])) {
            $this->view('templates/header', $data);
            $this->view('infoproduct/index', $data);
            $this->view('templates/footer');
        } else {                                            // SOLUSI SEMENTARA
            //TODO $data ISEMPTY                            // SAMPAI 
            Flasher::setFlash('Gagal', 'dibuka');           // ADD INFO PRODUCT
            header('Location: ' . BASEURL . '/Product');    // DITAMBAHKAN
            exit;                                           //
        }
    }

    public function addPage($infoproduct_id)
    {
        $data['suppliers'] = $this->model('Supplier_model')->getAllSupplier();
        $data['judul'] = "Tambah data InfoProduct";
        $data['inprod'] = $this->model('InfoProduct_model')->getAllProductSupp($infoproduct_id); //BARU
        $this->view('templates/header', $data);
        $this->view('infoproduct/addPage', $data);
        $this->view('templates/footer');
    }
    public function editPage($infoproduct_id)
    {
        $data['judul'] = "Edit data Supplier Product ";
        $data['inprod'] = $this->model('InfoProduct_model')->getInfoProductById($infoproduct_id);
        //echo '<pre>', var_dump($data), '</pre>';
        $this->view('templates/header', $data);
        $this->view('infoproduct/editPage', $data);
        $this->view('templates/footer');
    }

    public function edit()
    {
        if ($this->model('InfoProduct_model')->editDataInfoProduct($_POST) > 0) {
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
        if ($this->model('InfoProduct_model')->tambahDataInfoProduct($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'ditambahkan');
            header('Location: ' . BASEURL . '/Product');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'ditambahkan');
            header('Location: ' . BASEURL . '/Product');
            exit;
        }
    }

    public function hapus($infoproduct_id)
    {
        if ($this->model('InfoProduct_model')->hapusDataInfoProduct($infoproduct_id) > 0) {
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
        $data['judul'] = "Daftar InfoProduct";
        $data['inprod'] = $this->model('InfoProduct_model')->cariDataInfoProduct();
        $this->view('templates/header', $data);
        $this->view('infoproduct/index', $data);
        $this->view('templates/footer');
    }
}
