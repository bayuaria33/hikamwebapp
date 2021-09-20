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

    function InvoiceDateFormat($invoice_id)
    {
        $data['invc'] = $this->model('Invoice_model')->getInvoiceById($invoice_id);

        $invoice_date_day = date("d", strtotime($data['invc']['invoice_date']));
        $invoice_date_month = date("m", strtotime($data['invc']['invoice_date']));
        $dateObj   = DateTime::createFromFormat('!m', $invoice_date_month);
        $invoice_date_month_format = $dateObj->format('F');
        $invoice_date_year = date("Y", strtotime($data['invc']['invoice_date']));

        $date = $invoice_date_day . " - " . $invoice_date_month_format . " - " .  $invoice_date_year;
        return $date;
    }

    function DueDateFormat($invoice_id)
    {
        $data['invc'] = $this->model('Invoice_model')->getInvoiceById($invoice_id);

        $due_date_day = date("d", strtotime($data['invc']['due_date']));
        $due_date_month = date("m", strtotime($data['invc']['due_date']));
        $dateObj   = DateTime::createFromFormat('!m', $due_date_month);
        $due_date_month_format = $dateObj->format('F');
        $due_date_year = date("Y", strtotime($data['invc']['due_date']));

        $date = $due_date_day . " - " . $due_date_month_format . " - " .  $due_date_year;
        return $date;
    }

    function invoiceString($invoice_id)
    {
        $data['invc'] = $this->model('Invoice_model')->getInvoiceById($invoice_id);

        $h = "HAI";
        $s = "/";
        $i = "INV";
        $invoice_date_year = date("Y", strtotime($data['invc']['invoice_date']));
        $invoice_number = $h . $invoice_id . $s . $i . $s . $invoice_date_year;
        return $invoice_number;
    }

    public function detail($invoice_id)
    {
        $data['judul'] = "Detail Invoice";
        $data['invc'] = $this->model('Invoice_model')->getInvoiceById($invoice_id);

        $data['invoice_number'] = $this->invoiceString($data['invc']['invoice_id']);
        $data['invoice_date_format'] = $this->InvoiceDateFormat($data['invc']['invoice_id']);
        $data['due_date_format'] = $this->DueDateFormat($data['invc']['invoice_id']);

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

    public function item($invoice_id)
    {
        $data['judul'] = "Detail Item Invoice";
        $data['invc'] = $this->model('Invoice_model')->getInvoiceById($invoice_id);
        $data['invc_item'] = $this->model('Invoice_model')->getInvoiceItem($invoice_id);
        $data['cust'] = $this->model('Invoice_model')->getInvoiceCust($data['invc']['customer_name']);
        $data['invoice_number'] = $this->invoiceString($data['invc']['invoice_id']);
        $data['invoice_date_format'] = $this->InvoiceDateFormat($data['invc']['invoice_id']);
        $data['due_date_format'] = $this->DueDateFormat($data['invc']['invoice_id']);
        $data['test'] = $this->model('Invoice_model')->getInvoiceItemId($invoice_id);
        $this->view('templates/header', $data);
        $this->view('Invoice/Item', $data);
        $this->view('templates/footer');
    }

    public function addItemPage($invoice_id)
    {
        $data['product'] = $this->model('Product_model')->getAllProduct();
        $data['invc'] = $this->model('Invoice_model')->getInvoiceById($invoice_id);
        $data['judul'] = "Tambah Item Invoice";
        $this->view('templates/header', $data);
        $this->view('invoice/addItemPage', $data);
        $this->view('templates/footer');
    }

    public function tambahItem($invoice_id)
    {
        $url = BASEURL . '/Invoice' . '/Item' . '/' . $invoice_id;
        if ($this->model('Invoice_model')->tambahDataInvoiceItem($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'ditambahkan');
            header("Location: $url");
            exit;
        } else {
            Flasher::setFlash('Gagal', 'ditambahkan');
            header("Location: $url");
            exit;
        }
    }


    public function editItemPage($invc_item_id)
    {
        $data['judul'] = "Edit Item Invoice ";
        $data['product'] = $this->model('Product_model')->getAllProduct();
        $data['invc_item'] = $this->model('Invoice_model')->getInvoiceItembyId($invc_item_id);
        $data['invc'] = $this->model('Invoice_model')->getInvoiceById($data['invc_item']['invoice_id']);
        //echo '<pre>', var_dump($data), '</pre>';
        $this->view('templates/header', $data);
        $this->view('Invoice/editItemPage', $data);
        $this->view('templates/footer');
    }

    public function editItem($invoice_id)
    {
        $url = BASEURL . '/Invoice' . '/Item' . '/' . $invoice_id;
        if ($this->model('Invoice_model')->editDataItemInvoice($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'diubah');
            header("Location: $url");
            exit;
        } else {
            Flasher::setFlash('Gagal', 'diubah');
            header("Location: $url");

            exit;
        }
    }

    public function hapusItem($invc_item_id)
    {
        $data['invc_item'] = $this->model('Invoice_model')->getInvoiceItembyId($invc_item_id);

        $url = BASEURL . '/Invoice' . '/Item' . '/' . $data['invc_item']['invoice_id'];
        if ($this->model('Invoice_model')->hapusDataInvoiceItem($invc_item_id) > 0) {
            Flasher::setFlash('Berhasil', 'dihapus');
            header("Location: $url");
            exit;
        } else {
            Flasher::setFlash('Gagal', 'dihapus');
            header("Location: $url");
            exit;
        }
    }
}
