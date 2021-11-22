<?php
class Supplier extends Controller
{
    public function index()
    {
        $data['judul'] = "Daftar Supplier";
        $data['sup'] = $this->model('Supplier_model')->getAllSupplier();
        if ($_SESSION['level_user'] == '1' or $_SESSION['level_user'] == '3') {
            $this->view('templates/header', $data);
            $this->view('supplier/index', $data);
            $this->view('templates/footer');
        } else {
            header('Location:' . BASEURL);
        }
    }

    public function detail($supplier_id)
    {
        $data['judul'] = "Detail Supplier";
        $data['sup'] = $this->model('Supplier_model')->getSupplierById($supplier_id);
        $this->view('templates/header', $data);
        $this->view('supplier/detail', $data);
        $this->view('templates/footer');
    }

    public function addPage()
    {
        $data['judul'] = "Tambah data Supplier";
        $this->view('templates/header', $data);
        $this->view('supplier/addPage');
        $this->view('templates/footer');
    }
    public function editPage($supplier_id)
    {
        $data['judul'] = "Edit data Supplier";
        $data['sup'] = $this->model('Supplier_model')->getSupplierById($supplier_id);
        $this->view('templates/header', $data);
        $this->view('supplier/editPage', $data);
        $this->view('templates/footer');
    }

    public function edit($supplier_id)
    {
        $url = BASEURL . '/Supplier' . '/detail' . '/' . $supplier_id;
        if ($this->model('Supplier_model')->editDataSupplier($_POST) > 0) {
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
        if ($this->model('Supplier_model')->tambahDataSupplier($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'ditambahkan');
            header('Location: ' . BASEURL . '/Supplier');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'ditambahkan');
            header('Location: ' . BASEURL . '/Supplier');
            exit;
        }
    }

    public function hapus($supplier_id)
    {
        if ($this->model('Supplier_model')->hapusDataSupplier($supplier_id) > 0) {
            Flasher::setFlash('Berhasil', 'dihapus');
            header('Location: ' . BASEURL . '/Supplier');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'dihapus');
            header('Location: ' . BASEURL . '/Supplier');
            exit;
        }
    }

    public function cari()
    {
        $data['judul'] = "Daftar Supplier";
        $data['sup'] = $this->model('Supplier_model')->cariDataSupplier();
        $this->view('templates/header', $data);
        $this->view('supplier/index', $data);
        $this->view('templates/footer');
    }
}
