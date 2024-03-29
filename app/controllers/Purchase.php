<?php
class Purchase extends Controller
{
    public function index()
    {
        $data['judul'] = "Daftar Purchase Supplier";
        $data['jenis'] = "Supplier";
        $data['PO'] = $this->model('Purchase_model')->getAllPurchaseSupplier();
        if ($_SESSION['level_user'] == '1' or $_SESSION['level_user'] == '3') {
            $this->view('templates/header', $data);
            $this->view('purchase/index', $data);
            $this->view('templates/footer');
        } else {
            header('Location:' . BASEURL);
        }
    }

    public function index2()
    {
        $data['judul'] = "Daftar Purchase Customer";
        $data['jenis'] = "Customer";
        $data['PO'] = $this->model('Purchase_model')->getAllPurchaseCustomer();
        if ($_SESSION['level_user'] == '1' or $_SESSION['level_user'] == '4') {
            $this->view('templates/header', $data);
            $this->view('purchase/index', $data);
            $this->view('templates/footer');
        } else {
            header('Location:' . BASEURL);
        }
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


    public function addPage($jenis)
    {
        $data['jenis'] = $jenis;
        $data['cust'] = $this->model('Customer_model')->getAllCustomer();
        $data['supp'] = $this->model('Supplier_model')->getAllSupplier();
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

    public function editPage($PO_id, $jenis)
    {
        $data['judul'] = "Edit data Purchase ";
        $data['jenis'] = $jenis;
        $data['cust'] = $this->model('Customer_model')->getAllCustomer();
        $data['supp'] = $this->model('Supplier_model')->getAllSupplier();
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
        $data['invc'] = $this->model('Invoice_model')->getInvoiceById($data['PO']['invoice_id']);
        $data['DO'] = $this->model('Delivery_model')->getDeliveryById($data['PO']['DO_id']);
        $data['cust'] = $this->model('Purchase_model')->getPurchaseCust($data['PO']['customer_name']);
        $data['supp'] = $this->model('Purchase_model')->getPurchaseSupp($data['PO']['supplier_name']);
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
        if (!empty($data['PO']['purchase_number'])) {
        } else {
            $this->model('Purchase_model')->insertNumber($data);
        }

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
        $filename = $data['PO']['PO_id'] . '-' . $data['PO']['supplier_name'] . '-Purchase';
        $pdf = new FPDF('P', 'mm', 'A4');

        $pdf->AddPage();
        $pdf->Rect(5, 5, 200, 287, 'D');
        $pdf->Image('logo_hikam.png',10,10,-200); //letak foto nya di folder public
        $pdf->SetFont('Times','B',15);
        // Move to the right
        $pdf->Cell(35,10,'',0);
        // Title
        $pdf->SetTextColor(40, 130, 195);
        $pdf->Cell(154,10,'PT.HIKAM ABADI INDONESIA',0,1,'C');
        $pdf->Cell(35,10,'',0);
        // Subtitle
        $pdf->SetFont('Times','B',11);
        $pdf->SetTextColor(0, 149, 255);
        $pdf->Cell(154,10,'www.hikamabadi.com    ||  www.bahankimiaindustri.com ||   www.kimiapembersih.com',0,0,'L');
        // Line break
        $pdf->Ln(10);

        $pdf->SetTextColor(0, 0,0);
        $pdf->SetFont('Arial', 'B', 21);
        //Cell(width , height , text , border , end line , [align] )


        $pdf->Cell(189, 18, 'Purchase Order', 1, 1, 'C');

        $pdf->Cell(189, 10, '', 0, 1); //end of line
        //set font to arial, regular, 12pt
        $pdf->SetFont('Arial', '', 12);

        $sum = 0;
        $ppn = $data['PO']['ppn'];
        foreach ($data['pc_item'] as $pc_item) {
            $sum += $pc_item['price'] * $pc_item['quantity'];
        }
        $taxed = $sum * $ppn / 100;
        $grandtotal = $sum + $taxed;

        if (!empty($data['supp'])) {
            $pdf->Cell(50, 5, 'Nomor Purchase Order', 0, 0);
            $pdf->Cell(80, 5, ': ' . $data['PO']['purchase_number'], 0, 0);
            $pdf->Cell(59, 5, '', 0, 1); //end of line
            $pdf->Cell(50, 5, 'Nama Supplier', 0, 0);
            $pdf->Cell(80, 5, ': ' . $data['supp']['supplier_name'], 0, 0);
            $pdf->Cell(59, 5, '', 0, 1); //end of line
        } else {
            $pdf->Cell(50, 5, 'Nomor Purchase Order', 0, 0);
            $pdf->Cell(80, 5, ': ' . $data['PO']['purchase_number'], 0, 0);

            $pdf->Cell(59, 5, '', 0, 1); //end of line
            $pdf->Cell(50, 5, 'Nama Customer', 0, 0);
            $pdf->Cell(80, 5, ': ' . $data['cust']['customer_name'], 0, 0);

            $pdf->Cell(59, 5, '', 0, 1); //end of line
        }

        $pdf->Cell(50, 5, 'Alamat Penagihan', 0, 0);
        if (!empty($data['supp'])) {
            $pdf->MultiCell(130, 5, ': ' . $data['supp']['alamat_penagihan'], 0, 1);
        } else {
            $pdf->MultiCell(130, 5, ': ' . $data['cust']['alamat_penagihan'], 0, 1);
        }
        $pdf->Cell(59, 5, '', 0, 1); //end of line


        $pdf->Cell(50, 5, 'Nomor Telepon', 0, 0);
        if (!empty($data['supp'])) {
            $pdf->Cell(80, 5, ': ' . $data['supp']['no_telp1'], 0, 1);
            $pdf->Cell(50, 5, '', 0, 0);
            $pdf->Cell(80, 5, ': ' . $data['supp']['no_telp2'], 0, 1);
        } else {
            $pdf->Cell(80, 5, ': ' . $data['cust']['no_telp1'], 0, 1);
            $pdf->Cell(50, 5, '', 0, 0);
            $pdf->Cell(80, 5, ': ' . $data['cust']['no_telp2'], 0, 1);

            $pdf->Cell(50, 5, 'Nomor Invoice', 0, 0);
            if (!empty($data['invc'])) {
                $pdf->Cell(80, 5, ": " . $data['invc']['invoice_number'], 0, 1);
            } else {
                $pdf->Cell(80, 5, ': -', 0, 1);
            }

            $pdf->Cell(50, 5, 'Nomor DO', 0, 0);
            if (!empty($data['DO'])) {
                $pdf->Cell(80, 5, ": " . $data['DO']['delivery_number'], 0, 0);
            } else {
                $pdf->Cell(80, 5, ': -', 0, 0);
            }

        }

        //make a dummy empty cell as a vertical spacer
        $pdf->Cell(189, 10, '', 0, 1); //end of line

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

        //purchase contents
        $pdf->SetFont('Arial', 'B', 12);

        $pdf->Cell(105, 5, 'Description', 1, 0);
        $pdf->Cell(25, 5, 'Quantity', 1, 0);
        $pdf->Cell(25, 5, 'Unit', 1, 0);
        $pdf->Cell(34, 5, 'Price per Unit', 1, 1); //end of line

        $pdf->SetFont('Arial', '', 12);

        //Numbers are right-aligned so we give 'R' after new line parameter



        foreach ($data['pc_item'] as $pc_item) {
            $pdf->Cell(105, 5, $pc_item['product_name'], 1, 0);
            $pdf->Cell(25, 5, $pc_item['quantity'], 1, 0);
            $pdf->Cell(25, 5, $pc_item['unit_item'], 1, 0);
            $pdf->Cell(34, 5, number_format($pc_item['price'],2), 1, 1, 'R'); //end of line
        }

        //summary
        $pdf->Cell(120, 5, '', 0, 0);
        $pdf->Cell(28, 5, 'Subtotal', 0, 0);
        $pdf->Cell(7, 5, 'Rp', 1, 0);
        $pdf->Cell(34, 5, number_format($sum ,2), 1, 1, 'R'); //end of line

        $ppn = $data['PO']['ppn'];
        $pdf->Cell(120, 5, '', 0, 0);
        $pdf->Cell(28, 5, 'PPN ' . $ppn . ' %', 0, 0);
        $pdf->Cell(7, 5, 'Rp', 1, 0);

        $pdf->Cell(34, 5, number_format($taxed,2), 1, 1, 'R'); //end of line

        $pdf->Cell(120, 5, '', 0, 0);
        $pdf->Cell(28, 5, 'Grand Total', 0, 0);
        $pdf->Cell(7, 5, 'Rp', 1, 0);
        $pdf->Cell(34, 5, number_format($grandtotal,2), 1, 1, 'R'); //end of line

        //make a dummy empty cell as a vertical spacer
        $pdf->Cell(189, 10, '', 0, 1); //end of line

        $pdf->Cell(20, 5, 'Catatan', 0, 0);
        $pdf->MultiCell(120, 5, ': ' . $data['PO']['other_expenses'], 0, 1);

        $pdf->Output('I', $filename . '.pdf');
    }

    //Uploads
    public function cek_file($PO_id)
    {
        $data['PO'] = $this->model('Purchase_model')->getPurchaseById($PO_id);
        $data['file_PO'] = $this->model('Purchase_model')->getPurchaseFileById($PO_id);
        $data['judul'] = "Daftar File " . $data['PO']['purchase_number'];
        $this->view('templates/header', $data);
        $this->view('purchase/file_details', $data);
        $this->view('templates/footer');
    }

    public function uploadPage($PO_id)
    {
        $data['judul'] = "Upload File ";
        $data['PO'] = $this->model('Purchase_model')->getPurchaseById($PO_id);
        $this->view('templates/header', $data);
        $this->view('purchase/upload_form', $data);
        $this->view('templates/footer');
    }

    public function hapusFile($pc_file_id)
    {
        $data['pc_file'] = $this->model('Purchase_model')->getPurchaseFile($pc_file_id);
        $fileName = 'terupload' . '/' . $data['pc_file']['file_name'];

        if (file_exists(realpath($fileName))) {
            echo '<pre>', var_dump($fileName), '</pre>';
            if ($this->model('Purchase_model')->hapusFilePurchase($pc_file_id) > 0) {
                Flasher::setFlash('Berhasil', 'dihapus');
                unlink($fileName);
                header('Location: ' . BASEURL . '/Purchase' . '/cek_file' . '/' . $data['pc_file']['PO_id']);
                exit;
            } else {
                Flasher::setFlash('Gagal', 'dihapus');
                header('Location: ' . BASEURL . '/Purchase' . '/cek_file' . '/' . $data['pc_file']['PO_id']);
                exit;
            }
        } else {
            Flasher::setFlash('Gagal', 'dihapus');
            header('Location: ' . BASEURL . '/Purchase' . '/cek_file' . '/' . $data['pc_file']['PO_id']);
            exit;
        }
    }

    function upload($PO_id)
    {
        // ambil data file
        $data['PO'] = $this->model('Purchase_model')->getPurchaseById($PO_id);

        $dir = "/hikamwebapp/public/terupload/";
        $data['file_name'] = $_FILES['file_upload']['name'];
        $data['file_size'] = $_FILES['file_upload']['size'];
        $namaSementara = $_FILES['file_upload']['tmp_name'];

        // tentukan lokasi file akan dipindahkan
        $dirUpload = $_SERVER['DOCUMENT_ROOT'] . $dir;

        // pindahkan file
        $terupload = move_uploaded_file($namaSementara, $dirUpload . $data['file_name']);

        if ($terupload) {

            if ($this->model('Purchase_model')->tambahFilePurchase($data) > 0) {
                Flasher::setFlash('Berhasil', 'ditambahkan');
                header('Location: ' . BASEURL . '/Purchase' . '/cek_file' . '/' . $data['PO']['PO_id']);
            }
        } else {
            Flasher::setFlash('Gagal', 'ditambahkan');
            header('Location: ' . BASEURL . '/Purchase' . '/cek_file' . '/' . $data['PO']['PO_id']);
            exit;
        }
    }
}
