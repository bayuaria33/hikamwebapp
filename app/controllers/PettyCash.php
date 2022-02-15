<?php
class PettyCash extends Controller
{
    public function index()
    {
        $data['judul'] = "Petty Cash";
        $data['petty'] = $this->model('PettyCash_model')->getAllPettyCash();
        if ($_SESSION['level_user'] == '1' or $_SESSION['level_user'] == '2') {
            $this->view('templates/header', $data);
            $this->view('pettycash/index', $data);
            $this->view('templates/footer');
        } else {
            header('Location:' . BASEURL);
        }
        
    }

    public function addPage()
    {
        $data['judul'] = "Tambah data PettyCash";
        $this->view('templates/header', $data);
        $this->view('pettycash/addPage');
        $this->view('templates/footer');
    }

    public function tambah()
    {
        if ($this->model('PettyCash_model')->tambahDataPettyCash($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'ditambahkan');
            header('Location: ' . BASEURL . '/PettyCash');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'ditambahkan');
            header('Location: ' . BASEURL . '/PettyCash');
            exit;
        }
    }

    public function hapus($petty_id)
    {
        if ($this->model('PettyCash_model')->hapusDataPettyCash($petty_id) > 0) {
            Flasher::setFlash('Berhasil', 'dihapus');
            header('Location: ' . BASEURL . '/PettyCash');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'dihapus');
            header('Location: ' . BASEURL . '/PettyCash');
            exit;
        }
    }

    public function cari()
    {
        $data['judul'] = "Petty Cash";
        $data['petty'] = $this->model('Petty Cash_model')->cariDataPettyCash();
        $this->view('templates/header', $data);
        $this->view('pettycash/index', $data);
        $this->view('templates/footer');
    }
}

