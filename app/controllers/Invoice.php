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

    function getInvoiceMonth($invoice_id)
    {
        $data['invc'] = $this->model('Invoice_model')->getInvoiceById($invoice_id);
        $invoice_date_month = date("m", strtotime($data['invc']['invoice_date']));
        $dateObj   = DateTime::createFromFormat('!m', $invoice_date_month);
        $invoice_date_month_format = $dateObj->format('F');
        return $invoice_date_month_format;
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
        $m = date("m", strtotime($data['invc']['invoice_date']));
        $index = $this->findInvoiceIndexInMonth($invoice_id);
        $index_format = sprintf("%02d", $index);
        $s = "/";
        $i = "INV";
        $invoice_date_year = date("Y", strtotime($data['invc']['invoice_date']));
        $invoice_number = $m . $index_format . $s . $i . $s . $invoice_date_year;
        return $invoice_number;
    }

    public function addPage()
    {
        $data['cust'] = $this->model('Customer_model')->getAllCustomer();
        $data['judul'] = "Tambah data Invoice";
        $data['PO'] = $this->model('Purchase_model')->getAllPurchase();
        $data['DO'] = $this->model('Delivery_model')->getAllDelivery();
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
        $data['PO'] = $this->model('Purchase_model')->getAllPurchase();
        $data['DO'] = $this->model('Delivery_model')->getAllDelivery();
        $data['cust'] = $this->model('Customer_model')->getAllCustomer();
        $data['invc'] = $this->model('Invoice_model')->getInvoiceById($invoice_id);

        $this->view('templates/header', $data);
        $this->view('invoice/editPage', $data);
        $this->view('templates/footer');
    }

    public function edit($invoice_id)
    {
        $url = BASEURL . '/Invoice' . '/Item' . '/' . $invoice_id;
        if ($this->model('Invoice_model')->editDataInvoice($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'diubah');
            header("Location: $url");
            exit;
        } else {
            Flasher::setFlash('Gagal', 'diubah');
            header("Location:$url");

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
        $this->view('invoice/index', $data);
        $this->view('templates/footer');
    }

    function findInvoiceIndexInMonth($invoice_id)
    {
        //cari urutan ke brp di bulan $InvoiceMonth
        $data['invc'] = $this->model('Invoice_model')->getInvoiceById($invoice_id);
        $data['InvoiceMonth'] = $this->getInvoiceMonth($data['invc']['invoice_id']);
        $data['AllInvoiceInMonth'] = $this->model('Invoice_model')->getInvoiceInMonth($data['InvoiceMonth']);
        $array = $data['AllInvoiceInMonth'];

        foreach ($array as $key => $value) {
            if ($value['invoice_id'] == $data['invc']['invoice_id']) {
                return $key + 1;
            }
        }
        return false;
    }
    public function getItemDetails($invoice_id)
    {
        $data['judul'] = "Detail Item Invoice";
        $data['invc'] = $this->model('Invoice_model')->getInvoiceById($invoice_id);
        $data['invc_item'] = $this->model('Invoice_model')->getInvoiceItem($invoice_id);
        $data['cust'] = $this->model('Invoice_model')->getInvoiceCust($data['invc']['customer_name']);
        $data['invoice_number'] = $this->invoiceString($data['invc']['invoice_id']);
        $data['invoice_date_format'] = $this->InvoiceDateFormat($data['invc']['invoice_id']);
        $data['due_date_format'] = $this->DueDateFormat($data['invc']['invoice_id']);
        // $data['InvoiceMonth'] = $this->getInvoiceMonth($data['invc']['invoice_id']);
        // $data['AllInvoiceInMonth'] = $this->model('Invoice_model')->getInvoiceInMonth($data['InvoiceMonth']);
        // $data['key'] = $this->findInvoiceIndexInMonth($data['invc']['invoice_id']);
        return $data;
    }
    public function item($invoice_id)
    {

        $data = $this->getItemDetails($invoice_id);
        $this->model('Invoice_model')->insertNumber($data);
        $this->view('templates/header', $data);
        $this->view('invoice/item', $data);
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

        $this->view('templates/header', $data);
        $this->view('invoice/editItemPage', $data);
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

    public function generatePDF($invoice_id)
    {
        $data = $this->getItemDetails($invoice_id);
        $filename = $data['invc']['invoice_id'] . '-' . $data['invc']['customer_name'] . '-Invoice';
        $pdf = new FPDF('P', 'mm', 'A4');

        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 21);
        //Cell(width , height , text , border , end line , [align] )

        $pdf->Cell(189, 6, '', 1, 1);
        $pdf->Cell(189, 6, 'Invoice', 1, 1, 'C');
        $pdf->Cell(189, 6, '', 1, 1);
        $pdf->Cell(189, 10, '', 0, 1); //end of line
        //set font to arial, regular, 12pt
        $pdf->SetFont('Arial', '', 12);

        $pdf->Cell(50, 5, 'Nomor Invoice', 0, 0);
        $pdf->Cell(80, 5, ': ' . $data['invoice_number'], 0, 0);
        $pdf->Cell(30, 5, 'Nomor PO: ', 0, 0);
        $pdf->Cell(80, 5, $data['invc']['PO_id'], 0, 0);
        $pdf->Cell(59, 5, '', 0, 1); //end of line

        $pdf->Cell(50, 5, 'Nama Customer', 0, 0);
        $pdf->Cell(80, 5, ': ' . $data['cust']['customer_name'], 0, 0);
        $pdf->Cell(30, 5, 'Nomor DO: ', 0, 0);
        $pdf->Cell(80, 5, $data['invc']['DO_id'], 0, 0);
        $pdf->Cell(59, 5, '', 0, 1); //end of line

        $pdf->Cell(50, 5, 'Alamat Penagihan             :', 0, 1);
        $pdf->MultiCell(112, 5, $data['cust']['alamat_penagihan'], 0, 1);
        $pdf->Cell(59, 5, '', 0, 1); //end of line

        // $pdf->Cell(50, 5, 'Alamat Pengiriman', 0, 0);
        // $pdf->Cell(50, 5, ': ' . $data['cust']['alamat_pengiriman'], 0, 0);
        // $pdf->Cell(59, 5, '', 0, 1); //end of line

        $pdf->Cell(50, 5, 'Nomor Telepon', 0, 0);
        $pdf->Cell(80, 5, ': ' . $data['cust']['no_telp1'], 0, 0);
        $pdf->Cell(25, 5, 'Invoice #', 0, 0);
        $pdf->Cell(34, 5, ': ' . $data['invc']['invoice_id'], 0, 1); //end of line

        $pdf->Cell(50, 5, '', 0, 0);
        $pdf->Cell(80, 5, ': ' . $data['cust']['no_telp2'], 0, 0);
        $pdf->Cell(25, 5, 'Customer ID', 0, 0);
        $pdf->Cell(34, 5, ': ' . $data['cust']['customer_id'], 0, 1); //end of line

        //make a dummy empty cell as a vertical spacer
        $pdf->Cell(189, 10, '', 0, 1); //end of line

        $pdf->Cell(50, 5, 'Jumlah Uang', 0, 0);
        $pdf->Cell(80, 5, ':', 0, 1);

        //make a dummy empty cell as a vertical spacer
        $pdf->Cell(189, 10, '', 'B', 1); //end of line


        $pdf->Cell(50, 5, 'Untuk Pembayaran', 0, 0);
        $pdf->Cell(50, 5, ': ', 0, 1);

        //make a dummy empty cell as a vertical spacer
        $pdf->Cell(189, 10, '', 0, 1); //end of line

        //invoice contents
        $pdf->SetFont('Arial', 'B', 12);

        $pdf->Cell(105, 5, 'Description', 1, 0);
        $pdf->Cell(25, 5, 'Quantity', 1, 0);
        $pdf->Cell(25, 5, 'Unit', 1, 0);
        $pdf->Cell(34, 5, 'Price per Unit', 1, 1); //end of line

        $pdf->SetFont('Arial', '', 12);

        //Numbers are right-aligned so we give 'R' after new line parameter


        $sum = 0;
        foreach ($data['invc_item'] as $invc_item) {
            $pdf->Cell(105, 5, $invc_item['product_name'], 1, 0);
            $pdf->Cell(25, 5, $invc_item['quantity'], 1, 0);
            $pdf->Cell(25, 5, $invc_item['unit'], 1, 0);
            $pdf->Cell(34, 5, $invc_item['price'], 1, 1, 'R'); //end of line
            $sum += $invc_item['price'] * $invc_item['quantity'];
        }

        //summary
        $pdf->Cell(126, 5, '', 0, 0);
        $pdf->Cell(22, 5, 'Subtotal', 0, 0);
        $pdf->Cell(7, 5, 'Rp', 1, 0);
        $pdf->Cell(34, 5, $sum, 1, 1, 'R'); //end of line

        $ppn = $data['invc']['ppn'];
        $pdf->Cell(126, 5, '', 0, 0);
        $pdf->Cell(22, 5, 'PPN ' . $ppn . ' %', 0, 0);
        $pdf->Cell(7, 5, 'Rp', 1, 0);
        $taxed = $sum * $ppn / 100;
        $pdf->Cell(34, 5, $taxed, 1, 1, 'R'); //end of line

        $pdf->Cell(126, 5, '', 0, 0);
        $pdf->Cell(22, 5, 'Total Due', 0, 0);
        $pdf->Cell(7, 5, 'Rp', 1, 0);
        $pdf->Cell(34, 5, $sum + $taxed, 1, 1, 'R'); //end of line

        //make a dummy empty cell as a vertical spacer
        $pdf->Cell(189, 10, '', 0, 1); //end of line

        $pdf->Cell(20, 5, 'Catatan', 0, 0);
        $pdf->MultiCell(120, 5, ': ' . $data['invc']['other_expenses'], 0, 1);

        $pdf->Output('I', $filename . '.pdf');
    }
}
