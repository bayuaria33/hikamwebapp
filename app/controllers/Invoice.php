<?php
class Invoice extends Controller
{
    public function index()
    {
        $data['judul'] = "Daftar Invoice";
        $data['invc'] = $this->model('Invoice_model')->getAllInvoice();
        $this->view('templates/header', $data);
        $this->view('invoice/index', $data);
        $this->view('templates/footer');
    }

    public function detail($invoice_id)
    {
        $data['judul'] = "Detail Invoice";
        $data['invc'] = $this->model('Invoice_model')->getInvoiceById($invoice_id);



        $invoice_date_day = date("d", strtotime($data['invc']['invoice_date']));
        $invoice_date_month = date("m", strtotime($data['invc']['invoice_date']));
        $dateObj   = DateTime::createFromFormat('!m', $invoice_date_month);
        $invoice_date_month_format = $dateObj->format('F');
        $invoice_date_year = date("Y", strtotime($data['invc']['invoice_date']));

        $due_date_day = date("d", strtotime($data['invc']['due_date']));
        $due_date_month = date("m", strtotime($data['invc']['due_date']));
        $dateObj   = DateTime::createFromFormat('!m', $due_date_month);
        $due_date_month_format = $dateObj->format('F');
        $due_date_year = date("Y", strtotime($data['invc']['due_date']));

        //Bikin invoice number jadi HAI200X/INV/2021
        $h = "HAI";
        $s = "/";
        $i = "INV";
        $invoice_number = $h . $invoice_id . $s . $i . $s . $invoice_date_year;
        $data['invoice_number'] = $invoice_number;

        //Get month string


        $data['invoice_date_format'] = $invoice_date_day . " - " . $invoice_date_month_format . " - " .  $invoice_date_year;
        $data['due_date_format'] = $due_date_day . " - " . $due_date_month_format . " - " .  $due_date_year;

        $this->view('templates/header', $data);
        $this->view('Invoice/detail', $data);
        $this->view('templates/footer');
    }

    public function addPage()
    {
        $data['cust'] = $this->model('Customer_model')->getAllCustomer();
        $data['judul'] = "Tambah data Invoice";
        $this->view('templates/header', $data);
        $this->view('invoice/addPage', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        if ($this->model('Invoice_model')->tambahDataInvoice($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'ditambahkan');
            header('Location: ' . BASEURL . '/Invoice');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'ditambahkan');
            header('Location: ' . BASEURL . '/Invoice');
            exit;
        }
    }

    public function editPage($invoice_id)
    {
        $data['judul'] = "Edit data Invoice ";
        $data['cust'] = $this->model('Customer_model')->getAllCustomer();
        $data['invc'] = $this->model('Invoice_model')->getInvoiceById($invoice_id);
        //echo '<pre>', var_dump($data), '</pre>';
        $this->view('templates/header', $data);
        $this->view('Invoice/editPage', $data);
        $this->view('templates/footer');
    }

    public function edit()
    {
        if ($this->model('Invoice_model')->editDataInvoice($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'diubah');
            header('Location: ' . BASEURL . '/Invoice');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'diubah');
            header('Location: ' . BASEURL . '/Invoice');

            exit;
        }
    }

    public function hapus($invoice_id)
    {
        if ($this->model('Invoice_model')->hapusDataInvoice($invoice_id) > 0) {
            Flasher::setFlash('Berhasil', 'dihapus');
            header('Location: ' . BASEURL . '/Invoice');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'dihapus');
            header('Location: ' . BASEURL . '/Invoice');
            exit;
        }
    }

    public function cari()
    {
        $data['judul'] = "Daftar Invoice";
        $data['invc'] = $this->model('Invoice_model')->cariDataInvoice();
        $this->view('templates/header', $data);
        $this->view('Invoice/index', $data);
        $this->view('templates/footer');
    }
}
