<?php
class InfoProduct extends Controller
{


    public function detailSupp($product_id)
    {
        $data['inprod'] = $this->model('InfoProduct_model')->getAllProductSupp($product_id); //BARU
        $data['judul'] = "Detail Info Product";
        //echo '<pre>', var_dump($data, $newIdInt), '</pre>';
        if (!empty($data['inprod'])) {
            $this->view('templates/header', $data);
            $this->view('infoproduct/index', $data);
            $this->view('templates/footer');
        } else {
            $data['judul'] = "Tambah New Info Product";
            $this->addNewPage($product_id);
        }
    }

    public function addPage($infoproduct_id)
    {
        $data['suppliers'] = $this->model('Supplier_model')->getAllSupplier();
        $data['judul'] = "Tambah data InfoProduct";
        $data['inprod'] = $this->model('InfoProduct_model')->getAllProductSupp($infoproduct_id); //BARU //GANTI INI
        //echo '<pre>', var_dump($data), '</pre>';
        //echo "masuk add page";
        $this->view('templates/header', $data);
        $this->view('infoproduct/addPage', $data);
        $this->view('templates/footer');
    }

    public function addNewPage($product_id)
    {
        $data['suppliers'] = $this->model('Supplier_model')->getAllSupplier();
        $data['prod'] = $this->model('Product_model')->getProductById($product_id);

        $data['judul'] = "Tambah Data Supplier " . $data['prod']['product_name'];
        $this->view('templates/header', $data);
        $this->view('infoproduct/addNewPage', $data);
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
