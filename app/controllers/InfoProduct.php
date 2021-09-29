<?php
class InfoProduct extends Controller
{


    public function detailSupp($product_id)
    {
        $data['inprod'] = $this->model('InfoProduct_model')->getAllProductSupp($product_id); //BARU
        $data['judul'] = "Detail Info Product";

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

        $this->view('templates/header', $data);
        $this->view('infoproduct/editPage', $data);
        $this->view('templates/footer');
    }

    public function edit($product_id)
    {
        $url = BASEURL . '/InfoProduct' . '/DetailSupp' . '/' . $product_id;
        if ($this->model('InfoProduct_model')->editDataInfoProduct($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'diubah');
            header("Location: $url");
            exit;
        } else {
            Flasher::setFlash('Gagal', 'diubah');
            header("Location: $url");
            exit;
        }
    }


    public function tambah($product_id)
    {
        $url = BASEURL . '/InfoProduct' . '/DetailSupp' . '/' . $product_id;
        if ($this->model('InfoProduct_model')->tambahDataInfoProduct($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'ditambahkan');
            header("Location: $url");
            exit;
        } else {
            Flasher::setFlash('Gagal', 'ditambahkan');
            header("Location: $url");
            exit;
        }
    }

    public function hapus($infoproduct_id)
    {
        $data['inprod'] = $this->model('InfoProduct_model')->getInfoProductById($infoproduct_id);
        $url = BASEURL . '/InfoProduct' . '/DetailSupp' . '/' . $data['inprod']['product_id'];

        if ($this->model('InfoProduct_model')->hapusDataInfoProduct($infoproduct_id) > 0) {
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
        $data['judul'] = "Daftar InfoProduct";
        $data['inprod'] = $this->model('InfoProduct_model')->cariDataInfoProduct();
        $this->view('templates/header', $data);
        $this->view('infoproduct/index', $data);
        $this->view('templates/footer');
    }
}
