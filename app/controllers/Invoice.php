<?php
class Invoice extends Controller
{
    public function index()
    {
        $data['judul'] = "Daftar Invoice";
        $data['invc'] = $this->model('Invoice_model')->getAllInvoice();
        if ($_SESSION['level_user'] == '1' or $_SESSION['level_user'] == '2' or $_SESSION['level_user'] == '5') {
            $this->view('templates/header', $data);
            $this->view('invoice/index', $data);
            $this->view('templates/footer');
        } else {
            header('Location:' . BASEURL);
        }
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
        $data['PO'] = $this->model('Purchase_model')->getPurchaseById($data['invc']['PO_id']);
        $data['DO'] = $this->model('Delivery_model')->getDeliveryById($data['invc']['DO_id']);
        $data['invoice_number'] = $this->invoiceString($data['invc']['invoice_id']);
        $data['invoice_date_format'] = $this->InvoiceDateFormat($data['invc']['invoice_id']);
        $data['due_date_format'] = $this->DueDateFormat($data['invc']['invoice_id']);
        // $data['InvoiceMonth'] = $this->getInvoiceMonth($data['invc']['invoice_id']);
        // $data['AllInvoiceInMonth'] = $this->model('Invoice_model')->getInvoiceInMonth($data['InvoiceMonth']);
        // $data['key'] = $this->findInvoiceIndexInMonth($data['invc']['invoice_id']);
        $data['invc_text'] = $this->model('Invoice_model')->getInvoiceText($invoice_id);
        return $data;
    }
    public function item($invoice_id)
    {

        $data = $this->getItemDetails($invoice_id);
        if (!empty($data['invc']['invoice_number'])) {
        } else {
            $this->model('Invoice_model')->insertNumber($data);
        }

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

    public function pregenpdf($invoice_id) //to add, edit additional texts before generating the pdf
    {
        $data['invc_text'] = $this->model('Invoice_model')->getInvoiceText($invoice_id);
        if ($data['invc_text'] == false) {
            $data['invc_text']['invoice_id'] = $invoice_id;
            $data['invc_text']['text1'] = $_POST['text1'];
            $data['invc_text']['text2'] = $_POST['text2'];
            if ($this->model('Invoice_model')->tambahDataInvoiceText($data['invc_text']) > 0) {
                $this->generatePDF($invoice_id);
            }
        }else{
            $data['invc_text']['invoice_id'] = $invoice_id;
            $data['invc_text']['text1'] = $_POST['text1'];
            $data['invc_text']['text2'] = $_POST['text2'];
            if ($this->model('Invoice_model')->editDataInvoiceText($data['invc_text']) > 0) {
                $this->generatePDF($invoice_id);
            }
        }

    }


    public function generatePDF($invoice_id)
    {
        $data = $this->getItemDetails($invoice_id);
        $filename = $data['invc']['invoice_id'] . '-' . $data['invc']['customer_name'] . '-Invoice';
        $pdf = new FPDF('P', 'mm', 'A4');
        //echo '<pre>' , var_dump($data) , '</pre>';
        $pdf->SetAutoPageBreak(true, 0);
        $pdf->AddPage();
        $pdf->Rect(5, 5, 200, 287, 'D');
        $pdf->Image('logo_hikam.png', 10, 10, -200); //letak foto nya di folder public
        $pdf->SetFont('Times', 'B', 15);
        // Move to the right
        $pdf->Cell(35, 10, '', 0);
        // Title
        $pdf->SetTextColor(40, 130, 195);
        $pdf->Cell(154, 10, 'PT.HIKAM ABADI INDONESIA', 0, 1, 'C');
        $pdf->Cell(35, 10, '', 0);
        // Subtitle
        $pdf->SetFont('Times', 'B', 11);
        $pdf->SetTextColor(0, 149, 255);
        $pdf->Cell(154, 10, 'www.hikamabadi.com    ||  www.bahankimiaindustri.com ||   www.kimiapembersih.com', 0, 0, 'L');
        // Line break
        $pdf->Ln(10);

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', 'B', 21);
        //Cell(width , height , text , border , end line , [align] )
        if ($data['invc']['status_pembayaran'] == 'Lunas') {
            $pdf->Cell(189, 18, 'Invoice', 1, 1, 'C');
        } else {
            $pdf->Cell(189, 18, 'Proforma Invoice', 1, 1, 'C');
        }

        $pdf->Cell(189, 10, '', 0, 1); //end of line
        //set font to arial, regular, 12pt
        $pdf->SetFont('Arial', '', 12);

        $pdf->Cell(50, 5, 'Nomor Invoice', 0, 0);
        $pdf->Cell(80, 5, ': ' . $data['invc']['invoice_number'], 0, 0);


        $pdf->Cell(59, 5, '', 0, 1); //end of line

        $pdf->Cell(50, 5, 'Nama Customer', 0, 0);
        $pdf->Cell(80, 5, ': ' . $data['cust']['customer_name'], 0, 0);

        $pdf->Cell(59, 5, '', 0, 1); //end of line

        $pdf->Cell(50, 5, 'Alamat Penagihan             :', 0, 0);
        $pdf->MultiCell(112, 5, ': ' . $data['cust']['alamat_penagihan'], 0, 1);

        $pdf->Cell(59, 5, '', 0, 1); //end of line
        // $pdf->Cell(50, 5, 'Alamat Pengiriman', 0, 0);
        // $pdf->Cell(50, 5, ': ' . $data['cust']['alamat_pengiriman'], 0, 0);
        // $pdf->Cell(59, 5, '', 0, 1); //end of line

        $pdf->Cell(50, 5, 'U.P', 0, 0);
        $pdf->Cell(45, 5, ': ' . $data['cust']['UP_Penagihan'], 0, 0);

        $pdf->Cell(50, 5, 'Nomor PO', 0, 0);
        if (!empty($data['PO'])) {
            $pdf->Cell(80, 5, ': ' . $data['PO']['purchase_number'], 0, 1);
        } else {
            $pdf->Cell(80, 5, ': ' . '-', 0, 1);
        }



        $pdf->Cell(50, 5, 'Nomor Telepon 1', 0, 0);
        $pdf->Cell(45, 5, ': ' . $data['cust']['no_telp1'], 0, 0);

        $pdf->Cell(50, 5, 'Tanggal PO', 0, 0);
        if (!empty($data['PO'])) {
            $pdf->Cell(80, 5, ': ' . date("d F Y", strtotime($data['PO']['PO_date'])), 0, 1);
        } else {
            $pdf->Cell(80, 5, ': ' . '-', 0, 1);
        }


        $pdf->Cell(50, 5, 'Nomor Telepon 2', 0, 0);
        $pdf->Cell(45, 5, ': ' . $data['cust']['no_telp2'], 0, 0);

        $pdf->Cell(50, 5, 'Nomor DO', 0, 0);
        if (!empty($data['DO'])) {
            $pdf->Cell(80, 5, ': ' . $data['DO']['delivery_number'], 0, 1);
        } else {
            $pdf->Cell(81, 5, ': ' . '-', 0, 1);
        }

        //make a dummy empty cell as a vertical spacer
        $pdf->Cell(189, 10, '', 0, 1); //end of line

        $sum = 0;
        $ongkir = $data['invc']['biaya_kirim'];
        $ppn = $data['invc']['ppn'];
        foreach ($data['invc_item'] as $invc_item) {
            $sum += $invc_item['price'] * $invc_item['quantity'];
        }
        $taxed = $sum * $ppn / 100;
        $grandtotal = $sum + $taxed + $ongkir;

        $terbilang = strtoupper(terbilang($grandtotal));

        $pdf->Cell(30, 5, 'Jumlah Uang', 0, 0);
        $pdf->Cell(5, 5, ':', 0, 0);
        $pdf->SetFont('Arial', 'BI');
        $pdf->MultiCell(150, 5, '# ' .  $terbilang . ' RUPIAH #', 0, 1);
        $pdf->SetFont('Arial', '', 12);

        //make a dummy empty cell as a vertical spacer
        $pdf->Cell(189, 10, '', 'B', 1); //end of line


        $pdf->Cell(50, 5, 'Untuk Pembayaran', 0, 0);
        $pdf->Cell(50, 5, ': ', 0, 1);

        //make a dummy empty cell as a vertical spacer
        $pdf->Cell(189, 10, '', 0, 1); //end of line

        //invoice contents
        $pdf->SetFont('Arial', 'B', 12);

        $pdf->Cell(105, 5, 'Nama Barang', 1, 0);
        $pdf->Cell(25, 5, 'Quantity', 1, 0);
        $pdf->Cell(25, 5, 'Unit', 1, 0);
        $pdf->Cell(34, 5, 'Price per Unit', 1, 1); //end of line

        $pdf->SetFont('Arial', '', 12);

        //Numbers are right-aligned so we give 'R' after new line parameter

        foreach ($data['invc_item'] as $invc_item) {
            $pdf->Cell(105, 5, $invc_item['product_name'], 1, 0);
            $pdf->Cell(25, 5, $invc_item['quantity'], 1, 0);
            $pdf->Cell(25, 5, $invc_item['unit_item'], 1, 0);
            $pdf->Cell(34, 5, number_format($invc_item['price']), 1, 1, 'R'); //end of line
            $pdf->Cell(105, 5, '    -Keterangan: ' . $invc_item['product_desc'], 1, 1);
        }

        //summary
        $pdf->Cell(120, 5, '', 0, 0);
        $pdf->Cell(28, 5, 'Subtotal', 0, 0);
        $pdf->Cell(7, 5, 'Rp', 1, 0);
        $pdf->Cell(34, 5, number_format($sum), 1, 1, 'R'); //end of line

        $pdf->Cell(120, 5, '', 0, 0);
        $pdf->Cell(28, 5, 'PPN ' . $ppn . ' %', 0, 0);
        $pdf->Cell(7, 5, 'Rp', 1, 0);
        $pdf->Cell(34, 5, number_format($taxed), 1, 1, 'R'); //end of line

        $pdf->Cell(120, 5, '', 0, 0);
        $pdf->Cell(28, 5, 'Biaya Kirim', 0, 0);
        $pdf->Cell(7, 5, 'Rp', 1, 0);
        $pdf->Cell(34, 5, number_format($ongkir), 1, 1, 'R'); //end of line

        $pdf->Cell(120, 5, '', 0, 0);
        $pdf->Cell(28, 5, 'Grand Total', 0, 0);
        $pdf->Cell(7, 5, 'Rp', 1, 0);
        $pdf->Cell(34, 5, number_format($grandtotal, 2), 1, 1, 'R'); //end of line

        //make a dummy empty cell as a vertical spacer
        //$pdf->Cell(189, 10, '', 0, 1); //end of line

        $pdf->SetFont('Arial', 'B', 7);
        $pdf->MultiCell(189, 5, $data['invc_text']['text1'], 1, 1); //
        $pdf->SetFont('Arial', 'B', 11);

        $pdf->Cell(189, 10, "Bekasi, " . date("d F Y", strtotime($data['invc']['invoice_date'])), 0, 1, 'R');
        $pdf->SetFont('Arial', 'BU', 11);
        $pdf->Cell(28, 5, 'JUMLAH:', 0, 0, 'C'); //
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(28, 5, 'Rp ' . number_format($grandtotal, 2), 0, 1, 'C'); //
        $pdf->Cell(28, 5, 'Amount', 0, 1, 'C'); //
        $pdf->Cell(28, 20, '', 0, 1, 'C'); //

        $pdf->SetFont('Arial', '', 7);
        $pdf->Cell(30, 10, 'PERHATIAN', 0, 0);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(159, 10, '(Budi Ary Friyanto)', 0, 1, 'R');
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->MultiCell(189, 5, $data['invc_text']['text2'], 1, 1); //

        $pdf->Output('I', $filename . '.pdf');
    }
}
