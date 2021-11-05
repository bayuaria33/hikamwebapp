<?php
class Purchase extends Controller
{
    public function index()
    {
        $data['judul'] = "Daftar Purchase";
        $data['PO'] = $this->model('Purchase_model')->getAllPurchase();
        $this->view('templates/header', $data);
        $this->view('purchase/index', $data);
        $this->view('templates/footer');
    }

    function PurchaseDateFormat($PO_id)
    {
        $data['PO'] = $this->model('Purchase_model')->getPurchaseById($PO_id);

        $purchase_date_day = date("d", strtotime($data['PO']['PO_date']));
        $purchase_date_month = date("m", strtotime($data['PO']['PO_date']));
        $dateObj   = DateTime::createFromFormat('!m', $purchase_date_month);
        $purchase_date_month_format = $dateObj->format('F');
        $purchase_date_year = date("Y", strtotime($data['PO']['PO_date']));

        $date = $purchase_date_day . " - " . $purchase_date_month_format . " - " .  $purchase_date_year;
        return $date;
    }

    function getPurchaseMonth($PO_id)
    {
        $data['PO'] = $this->model('Purchase_model')->getPurchaseById($PO_id);
        $purchase_date_month = date("m", strtotime($data['PO']['PO_date']));
        $dateObj   = DateTime::createFromFormat('!m', $purchase_date_month);
        $purchase_date_month_format = $dateObj->format('F');
        return $purchase_date_month_format;
    }

    function DueDateFormat($PO_id)
    {
        $data['PO'] = $this->model('Purchase_model')->getPurchaseById($PO_id);

        $due_date_day = date("d", strtotime($data['PO']['due_date']));
        $due_date_month = date("m", strtotime($data['PO']['due_date']));
        $dateObj   = DateTime::createFromFormat('!m', $due_date_month);
        $due_date_month_format = $dateObj->format('F');
        $due_date_year = date("Y", strtotime($data['PO']['due_date']));

        $date = $due_date_day . " - " . $due_date_month_format . " - " .  $due_date_year;
        return $date;
    }

    function purchaseString($PO_id)
    {
        $data['PO'] = $this->model('Purchase_model')->getPurchaseById($PO_id);
        $m = date("m", strtotime($data['PO']['PO_date']));
        $index = $this->findPurchaseIndexInMonth($PO_id);
        $index_format = sprintf("%02d", $index);
        $s = "/";
        $i = "PO";
        $purchase_date_year = date("Y", strtotime($data['PO']['PO_date']));
        $purchase_number = $m . $index_format . $s . $i . $s . $purchase_date_year;
        return $purchase_number;
    }


    public function addPage()
    {
        $data['cust'] = $this->model('Customer_model')->getAllCustomer();
        $data['judul'] = "Tambah data Purchase";
        $data['invc'] = $this->model('Invoice_model')->getAllInvoice();
        $data['DO'] = $this->model('Delivery_model')->getAllDelivery();
        $this->view('templates/header', $data);
        $this->view('purchase/addPage', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        if ($this->model('Purchase_model')->tambahDataPurchase($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'ditambahkan');
            header('Location: ' . BASEURL . '/Purchase');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'ditambahkan');
            header('Location: ' . BASEURL . '/Purchase');
            exit;
        }
    }

    public function editPage($PO_id)
    {
        $data['judul'] = "Edit data Purchase ";
        $data['cust'] = $this->model('Customer_model')->getAllCustomer();
        $data['invc'] = $this->model('Invoice_model')->getAllInvoice();
        $data['PO'] = $this->model('Purchase_model')->getPurchaseById($PO_id);
        $data['DO'] = $this->model('Delivery_model')->getAllDelivery();
        $this->view('templates/header', $data);
        $this->view('purchase/editPage', $data);
        $this->view('templates/footer');
    }

    public function edit($PO_id)
    {
        $url = BASEURL . '/Purchase' . '/Item' . '/' . $PO_id;
        if ($this->model('Purchase_model')->editDataPurchase($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'diubah');
            header("Location: $url");
            exit;
        } else {
            Flasher::setFlash('Gagal', 'diubah');
            header("Location:$url");

            exit;
        }
    }

    public function hapus($PO_id)
    {
        if ($this->model('Purchase_model')->hapusDataPurchase($PO_id) > 0) {
            Flasher::setFlash('Berhasil', 'dihapus');
            header('Location: ' . BASEURL . '/Purchase');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'dihapus');
            header('Location: ' . BASEURL . '/Purchase');
            exit;
        }
    }

    public function cari()
    {
        $data['judul'] = "Daftar Purchase";
        $data['PO'] = $this->model('Purchase_model')->cariDataPurchase();
        $this->view('templates/header', $data);
        $this->view('purchase/index', $data);
        $this->view('templates/footer');
    }

    function findPurchaseIndexInMonth($PO_id)
    {
        //cari urutan ke brp di bulan $PurchaseMonth
        $data['PO'] = $this->model('Purchase_model')->getPurchaseById($PO_id);
        $data['PurchaseMonth'] = $this->getPurchaseMonth($data['PO']['PO_id']);
        $data['AllPurchaseInMonth'] = $this->model('Purchase_model')->getPurchaseInMonth($data['PurchaseMonth']);
        $array = $data['AllPurchaseInMonth'];

        foreach ($array as $key => $value) {
            if ($value['PO_id'] == $data['PO']['PO_id']) {
                return $key + 1;
            }
        }
        return false;
    }
    public function getItemDetails($PO_id)
    {
        $data['judul'] = "Detail Item Purchase";
        $data['PO'] = $this->model('Purchase_model')->getPurchaseById($PO_id);
        $data['pc_item'] = $this->model('Purchase_model')->getPurchaseItem($PO_id);
        $data['cust'] = $this->model('Purchase_model')->getPurchaseCust($data['PO']['customer_name']);
        $data['purchase_number'] = $this->purchaseString($data['PO']['PO_id']);
        $data['purchase_date_format'] = $this->PurchaseDateFormat($data['PO']['PO_id']);
        $data['due_date_format'] = $this->DueDateFormat($data['PO']['PO_id']);
        // $data['PurchaseMonth'] = $this->getPurchaseMonth($data['PO']['PO_id']);
        // $data['AllPurchaseInMonth'] = $this->model('Purchase_model')->getPurchaseInMonth($data['PurchaseMonth']);
        // $data['key'] = $this->findPurchaseIndexInMonth($data['PO']['PO_id']);
        return $data;
    }
    public function item($PO_id)
    {
        $data = $this->getItemDetails($PO_id);
        $this->model('Purchase_model')->insertNumber($data);
        $this->view('templates/header', $data);
        $this->view('purchase/Item', $data);
        $this->view('templates/footer');
    }

    public function addItemPage($PO_id)
    {
        $data['product'] = $this->model('Product_model')->getAllProduct();
        $data['PO'] = $this->model('Purchase_model')->getPurchaseById($PO_id);
        $data['judul'] = "Tambah Item Purchase";
        $this->view('templates/header', $data);
        $this->view('purchase/addItemPage', $data);
        $this->view('templates/footer');
    }

    public function tambahItem($PO_id)
    {
        $url = BASEURL . '/Purchase' . '/Item' . '/' . $PO_id;
        if ($this->model('Purchase_model')->tambahDataPurchaseItem($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'ditambahkan');
            header("Location: $url");
            exit;
        } else {
            Flasher::setFlash('Gagal', 'ditambahkan');
            header("Location: $url");
            exit;
        }
    }


    public function editItemPage($pc_item_id)
    {
        $data['judul'] = "Edit Item Purchase ";
        $data['product'] = $this->model('Product_model')->getAllProduct();
        $data['pc_item'] = $this->model('Purchase_model')->getPurchaseItembyId($pc_item_id);
        $data['PO'] = $this->model('Purchase_model')->getPurchaseById($data['pc_item']['PO_id']);

        $this->view('templates/header', $data);
        $this->view('purchase/editItemPage', $data);
        $this->view('templates/footer');
    }

    public function editItem($PO_id)
    {
        $url = BASEURL . '/Purchase' . '/Item' . '/' . $PO_id;
        if ($this->model('Purchase_model')->editDataItemPurchase($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'diubah');
            header("Location: $url");
            exit;
        } else {
            Flasher::setFlash('Gagal', 'diubah');
            header("Location: $url");

            exit;
        }
    }

    public function hapusItem($pc_item_id)
    {
        $data['pc_item'] = $this->model('Purchase_model')->getPurchaseItembyId($pc_item_id);

        $url = BASEURL . '/Purchase' . '/Item' . '/' . $data['pc_item']['PO_id'];
        if ($this->model('Purchase_model')->hapusDataPurchaseItem($pc_item_id) > 0) {
            Flasher::setFlash('Berhasil', 'dihapus');
            header("Location: $url");
            exit;
        } else {
            Flasher::setFlash('Gagal', 'dihapus');
            header("Location: $url");
            exit;
        }
    }

    public function generatePDF($PO_id)
    {
        $data = $this->getItemDetails($PO_id);
        $filename = $data['PO']['PO_id'] . '-' . $data['PO']['customer_name'] . '-Purchase';
        $pdf = new FPDF('P', 'mm', 'A4');

        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 21);
        //Cell(width , height , text , border , end line , [align] )

        $pdf->Cell(189, 6, '', 1, 1);
        $pdf->Cell(189, 6, 'Purchase Order', 1, 1, 'C');
        $pdf->Cell(189, 6, '', 1, 1);
        $pdf->Cell(189, 10, '', 0, 1); //end of line
        //set font to arial, regular, 12pt
        $pdf->SetFont('Arial', '', 12);

        $pdf->Cell(50, 5, 'Nomor Purchase Order', 0, 0);
        $pdf->Cell(80, 5, ': ' . $data['purchase_number'], 0, 0);
        $pdf->Cell(30, 5, 'Nomor Invoice: ', 0, 0);
        $pdf->Cell(80, 5, $data['PO']['invoice_id'], 0, 0);
        $pdf->Cell(59, 5, '', 0, 1); //end of line

        $pdf->Cell(50, 5, 'Nama Customer', 0, 0);
        $pdf->Cell(80, 5, ': ' . $data['cust']['customer_name'], 0, 0);
        $pdf->Cell(30, 5, 'Nomor DO: ', 0, 0);
        $pdf->Cell(80, 5, $data['PO']['DO_id'], 0, 0);
        $pdf->Cell(59, 5, '', 0, 1); //end of line

        $pdf->Cell(50, 5, 'Alamat Penagihan             :', 0, 1);
        $pdf->MultiCell(112, 5, $data['cust']['alamat_penagihan'], 0, 1);
        $pdf->Cell(59, 5, '', 0, 1); //end of line

        // $pdf->Cell(50, 5, 'Alamat Pengiriman', 0, 0);
        // $pdf->Cell(50, 5, ': ' . $data['cust']['alamat_pengiriman'], 0, 0);
        // $pdf->Cell(59, 5, '', 0, 1); //end of line

        $pdf->Cell(50, 5, 'Nomor Telepon', 0, 0);
        $pdf->Cell(80, 5, ': ' . $data['cust']['no_telp1'], 0, 0);
        $pdf->Cell(25, 5, 'Purchase #', 0, 0);
        $pdf->Cell(34, 5, ': ' . $data['PO']['PO_id'], 0, 1); //end of line

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

        //purchase contents
        $pdf->SetFont('Arial', 'B', 12);

        $pdf->Cell(105, 5, 'Description', 1, 0);
        $pdf->Cell(25, 5, 'Quantity', 1, 0);
        $pdf->Cell(25, 5, 'Unit', 1, 0);
        $pdf->Cell(34, 5, 'Price per Unit', 1, 1); //end of line

        $pdf->SetFont('Arial', '', 12);

        //Numbers are right-aligned so we give 'R' after new line parameter


        $sum = 0;
        foreach ($data['pc_item'] as $pc_item) {
            $pdf->Cell(105, 5, $pc_item['product_name'], 1, 0);
            $pdf->Cell(25, 5, $pc_item['quantity'], 1, 0);
            $pdf->Cell(25, 5, $pc_item['unit'], 1, 0);
            $pdf->Cell(34, 5, $pc_item['price'], 1, 1, 'R'); //end of line
            $sum += $pc_item['price'] * $pc_item['quantity'];
        }

        //summary
        $pdf->Cell(126, 5, '', 0, 0);
        $pdf->Cell(22, 5, 'Subtotal', 0, 0);
        $pdf->Cell(7, 5, 'Rp', 1, 0);
        $pdf->Cell(34, 5, $sum, 1, 1, 'R'); //end of line

        $ppn = $data['PO']['ppn'];
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
        $pdf->MultiCell(120, 5, ': ' . $data['PO']['other_expenses'], 0, 1);

        $pdf->Output('I', $filename . '.pdf');
    }
}