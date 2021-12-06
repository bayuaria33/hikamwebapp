<?php
class Delivery extends Controller
{
    public function index()
    {
        $data['judul'] = "Daftar Delivery Order";
        $data['DO'] = $this->model('Delivery_model')->getAllDelivery();
        if ($_SESSION['level_user'] == '1' or $_SESSION['level_user'] == '2' or $_SESSION['level_user'] == '5') {
            $this->view('templates/header', $data);
            $this->view('delivery/index', $data);
            $this->view('templates/footer');
        } else {
            header('Location:' . BASEURL);
        }
    }

    function DeliveryDateFormat($DO_id)
    {
        $data['DO'] = $this->model('Delivery_model')->getDeliveryById($DO_id);

        $delivery_date_day = date("d", strtotime($data['DO']['DO_date']));
        $delivery_date_month = date("m", strtotime($data['DO']['DO_date']));
        $dateObj   = DateTime::createFromFormat('!m', $delivery_date_month);
        $delivery_date_month_format = $dateObj->format('F');
        $delivery_date_year = date("Y", strtotime($data['DO']['DO_date']));

        $date = $delivery_date_day . " - " . $delivery_date_month_format . " - " .  $delivery_date_year;
        return $date;
    }

    function getDeliveryMonth($DO_id)
    {
        $data['DO'] = $this->model('Delivery_model')->getDeliveryById($DO_id);
        $delivery_date_month = date("m", strtotime($data['DO']['DO_date']));
        $dateObj   = DateTime::createFromFormat('!m', $delivery_date_month);
        $delivery_date_month_format = $dateObj->format('F');
        return $delivery_date_month_format;
    }

    function DueDateFormat($DO_id)
    {
        $data['DO'] = $this->model('Delivery_model')->getDeliveryById($DO_id);

        $due_date_day = date("d", strtotime($data['DO']['due_date']));
        $due_date_month = date("m", strtotime($data['DO']['due_date']));
        $dateObj   = DateTime::createFromFormat('!m', $due_date_month);
        $due_date_month_format = $dateObj->format('F');
        $due_date_year = date("Y", strtotime($data['DO']['due_date']));

        $date = $due_date_day . " - " . $due_date_month_format . " - " .  $due_date_year;
        return $date;
    }

    function deliveryString($DO_id)
    {
        $data['DO'] = $this->model('Delivery_model')->getDeliveryById($DO_id);
        $m = date("m", strtotime($data['DO']['DO_date']));
        $index = $this->findDeliveryIndexInMonth($DO_id);
        $index_format = sprintf("%02d", $index);
        $s = "/";
        $i = "DO";
        $delivery_date_year = date("Y", strtotime($data['DO']['DO_date']));
        $delivery_number = $m . $index_format . $s . $i . $s . $delivery_date_year;
        return $delivery_number;
    }

    public function addPage()
    {
        $data['cust'] = $this->model('Customer_model')->getAllCustomer();
        $data['judul'] = "Tambah data Delivery";
        $data['PO'] = $this->model('Purchase_model')->getAllPurchase();
        $data['invc'] = $this->model('Invoice_model')->getAllInvoice();
        $this->view('templates/header', $data);
        $this->view('delivery/addPage', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        if ($this->model('Delivery_model')->tambahDataDelivery($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'ditambahkan');
            header('Location: ' . BASEURL . '/Delivery');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'ditambahkan');
            header('Location: ' . BASEURL . '/Delivery');
            exit;
        }
    }

    public function editPage($DO_id)
    {
        $data['judul'] = "Edit data Delivery ";
        $data['PO'] = $this->model('Purchase_model')->getAllPurchase();
        $data['invc'] = $this->model('Invoice_model')->getAllInvoice();
        $data['cust'] = $this->model('Customer_model')->getAllCustomer();
        $data['DO'] = $this->model('Delivery_model')->getDeliveryById($DO_id);

        $this->view('templates/header', $data);
        $this->view('delivery/editPage', $data);
        $this->view('templates/footer');
    }

    public function edit($DO_id)
    {
        $url = BASEURL . '/Delivery' . '/Item' . '/' . $DO_id;
        if ($this->model('Delivery_model')->editDataDelivery($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'diubah');
            header("Location: $url");
            exit;
        } else {
            Flasher::setFlash('Gagal', 'diubah');
            header("Location:$url");

            exit;
        }
    }

    public function hapus($DO_id)
    {
        if ($this->model('Delivery_model')->hapusDataDelivery($DO_id) > 0) {
            Flasher::setFlash('Berhasil', 'dihapus');
            header('Location: ' . BASEURL . '/Delivery');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'dihapus');
            header('Location: ' . BASEURL . '/Delivery');
            exit;
        }
    }

    public function cari()
    {
        $data['judul'] = "Daftar Delivery Order";
        $data['DO'] = $this->model('Delivery_model')->cariDataDelivery();
        $this->view('templates/header', $data);
        $this->view('delivery/index', $data);
        $this->view('templates/footer');
    }

    function findDeliveryIndexInMonth($DO_id)
    {
        //cari urutan ke brp di bulan $DeliveryMonth
        $data['DO'] = $this->model('Delivery_model')->getDeliveryById($DO_id);
        $data['DeliveryMonth'] = $this->getDeliveryMonth($data['DO']['DO_id']);
        $data['AllDeliveryInMonth'] = $this->model('Delivery_model')->getDeliveryInMonth($data['DeliveryMonth']);
        $array = $data['AllDeliveryInMonth'];

        foreach ($array as $key => $value) {
            if ($value['DO_id'] == $data['DO']['DO_id']) {
                return $key + 1;
            }
        }
        return false;
    }
    public function getItemDetails($DO_id)
    {
        $data['judul'] = "Detail Item Delivery";
        $data['DO'] = $this->model('Delivery_model')->getDeliveryById($DO_id);
        $data['do_item'] = $this->model('Delivery_model')->getDeliveryItem($DO_id);
        $data['invc'] = $this->model('Invoice_model')->getInvoiceById($data['DO']['invoice_id']);
        $data['PO'] = $this->model('Purchase_model')->getPurchaseById($data['DO']['PO_id']);
        $data['cust'] = $this->model('Delivery_model')->getDeliveryCust($data['DO']['customer_name']);
        $data['delivery_number'] = $this->deliveryString($data['DO']['DO_id']);
        $data['delivery_date_format'] = $this->DeliveryDateFormat($data['DO']['DO_id']);
        $data['due_date_format'] = $this->DueDateFormat($data['DO']['DO_id']);
        // $data['DeliveryMonth'] = $this->getDeliveryMonth($data['DO']['DO_id']);
        // $data['AllDeliveryInMonth'] = $this->model('Delivery_model')->getDeliveryInMonth($data['DeliveryMonth']);
        // $data['key'] = $this->findDeliveryIndexInMonth($data['DO']['DO_id']);
        return $data;
    }
    public function item($DO_id)
    {

        $data = $this->getItemDetails($DO_id);

        if (!empty($data['DO']['delivery_number'])) {
        } else {
            $this->model('Delivery_model')->insertNumber($data);
        }

        $this->view('templates/header', $data);
        $this->view('delivery/Item', $data);
        $this->view('templates/footer');
    }

    public function addItemPage($DO_id)
    {
        $data['product'] = $this->model('Product_model')->getAllProduct();
        $data['DO'] = $this->model('Delivery_model')->getDeliveryById($DO_id);
        $data['judul'] = "Tambah Item Delivery";
        $this->view('templates/header', $data);
        $this->view('delivery/addItemPage', $data);
        $this->view('templates/footer');
    }

    public function tambahItem($DO_id)
    {
        $url = BASEURL . '/Delivery' . '/Item' . '/' . $DO_id;
        if ($this->model('Delivery_model')->tambahDataDeliveryItem($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'ditambahkan');
            header("Location: $url");
            exit;
        } else {
            Flasher::setFlash('Gagal', 'ditambahkan');
            header("Location: $url");
            exit;
        }
    }


    public function editItemPage($do_item_id)
    {
        $data['judul'] = "Edit Item Delivery ";
        $data['product'] = $this->model('Product_model')->getAllProduct();
        $data['do_item'] = $this->model('Delivery_model')->getDeliveryItembyId($do_item_id);
        $data['DO'] = $this->model('Delivery_model')->getDeliveryById($data['do_item']['do_id']);

        $this->view('templates/header', $data);
        $this->view('delivery/editItemPage', $data);
        $this->view('templates/footer');
    }

    public function editItem($DO_id)
    {
        $url = BASEURL . '/Delivery' . '/Item' . '/' . $DO_id;
        if ($this->model('Delivery_model')->editDataItemDelivery($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'diubah');
            header("Location: $url");
            exit;
        } else {
            Flasher::setFlash('Gagal', 'diubah');
            header("Location: $url");

            exit;
        }
    }

    public function hapusItem($do_item_id)
    {
        $data['do_item'] = $this->model('Delivery_model')->getDeliveryItembyId($do_item_id);

        $url = BASEURL . '/Delivery' . '/Item' . '/' . $data['do_item']['do_id'];
        if ($this->model('Delivery_model')->hapusDataDeliveryItem($do_item_id) > 0) {
            Flasher::setFlash('Berhasil', 'dihapus');
            header("Location: $url");
            exit;
        } else {
            Flasher::setFlash('Gagal', 'dihapus');
            header("Location: $url");
            exit;
        }
    }

    public function generatePDF($DO_id)
    {
        $data = $this->getItemDetails($DO_id);
        $filename = $data['DO']['DO_id'] . '-' . $data['DO']['customer_name'] . '-Delivery';
        $pdf = new FPDF('P', 'mm', 'A4');

        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 21);
        //Cell(width , height , text , border , end line , [align] )

        $pdf->Cell(189, 6, '', 1, 1);
        $pdf->Cell(189, 6, 'Delivery', 1, 1, 'C');
        $pdf->Cell(189, 6, '', 1, 1);
        $pdf->Cell(189, 10, '', 0, 1); //end of line
        //set font to arial, regular, 12pt
        $pdf->SetFont('Arial', '', 12);

        $pdf->Cell(50, 5, 'Nomor Delivery', 0, 0);
        $pdf->Cell(80, 5, ': ' . $data['DO']['delivery_number'], 0, 0);
        // $pdf->Cell(30, 5, 'Nomor PO: ', 0, 0);
        // if (!empty($data['PO'])) {
        //     $pdf->Cell(80, 5, $data['PO']['purchase_number'], 0, 0);
        // } else {
        //     $pdf->Cell(80, 5, '-', 0, 0);
        // }
        $pdf->Cell(59, 5, '', 0, 1); //end of line

        $pdf->Cell(50, 5, 'Nama Customer', 0, 0);
        $pdf->Cell(80, 5, ': ' . $data['cust']['customer_name'], 0, 0);

        // $pdf->Cell(30, 5, 'Nomor Invoice: ', 0, 0);
        // if (!empty($data['invc'])) {
        //     $pdf->Cell(80, 5, $data['invc']['invoice_number'], 0, 0);
        // } else {
        //     $pdf->Cell(80, 5, '-', 0, 0);
        // }
        $pdf->Cell(59, 5, '', 0, 1); //end of line

        // $pdf->Cell(50, 5, 'Alamat Penagihan             :', 0, 1);
        // $pdf->MultiCell(112, 5, $data['cust']['alamat_penagihan'], 0, 1);
        // $pdf->Cell(59, 5, '', 0, 1); //end of line

        $pdf->Cell(50, 5, 'Alamat Pengiriman', 0, 0);
        $pdf->MultiCell(130, 5, ': ' . $data['cust']['alamat_pengiriman'], 0, 1);
        // $pdf->Cell(59, 5, '', 1, 1); //end of line

        $pdf->Cell(50, 5, 'Nomor Telepon', 0, 0);
        $pdf->Cell(80, 5, ': ' . $data['cust']['no_telp1'], 0, 1);


        $pdf->Cell(50, 5, '', 0, 0);
        $pdf->Cell(80, 5, ': ' . $data['cust']['no_telp2'], 0, 1);

        $pdf->Cell(30, 5, 'Nomor PO: ', 0, 0);
        if (!empty($data['PO'])) {
            $pdf->Cell(80, 5, $data['PO']['purchase_number'], 0, 0);
        } else {
            $pdf->Cell(80, 5, '-', 0, 0);
        }
        $pdf->Cell(59, 5, '', 0, 1); //end of line

        $pdf->Cell(30, 5, 'Nomor Invoice: ', 0, 0);
        if (!empty($data['invc'])) {
            $pdf->Cell(80, 5, $data['invc']['invoice_number'], 0, 0);
        } else {
            $pdf->Cell(80, 5, '-', 0, 0);
        }

        //make a dummy empty cell as a vertical spacer
        $pdf->Cell(189, 10, '', 0, 1); //end of line

        // $pdf->Cell(50, 5, 'Jumlah Uang', 0, 0);
        // $pdf->Cell(80, 5, ':', 0, 1);

        //make a dummy empty cell as a vertical spacer
        $pdf->Cell(189, 10, '', 'B', 1); //end of line


        // $pdf->Cell(50, 5, 'Untuk Pembayaran', 0, 0);
        // $pdf->Cell(50, 5, ': ', 0, 1);

        //make a dummy empty cell as a vertical spacer
        $pdf->Cell(189, 10, '', 0, 1); //end of line

        //delivery contents
        $pdf->SetFont('Arial', 'B', 12);

        $pdf->Cell(105, 5, 'Nama Barang', 1, 0);
        $pdf->Cell(25, 5, 'Quantity', 1, 0);
        $pdf->Cell(25, 5, 'Unit', 1, 1);
        // $pdf->Cell(34, 5, 'Price per Unit', 1, 1); //end of line

        $pdf->SetFont('Arial', '', 12);

        //Numbers are right-aligned so we give 'R' after new line parameter


        $sum = 0;
        foreach ($data['do_item'] as $do_item) {
            $pdf->Cell(105, 5, $do_item['product_name'], 1, 0);
            $pdf->Cell(25, 5, $do_item['quantity'], 1, 0);
            $pdf->Cell(25, 5, $do_item['unit_item'], 1, 1, 'R');
            // $pdf->Cell(34, 5, $do_item['price'], 1, 1, 'R'); //end of line
            $sum += $do_item['price'] * $do_item['quantity'];
        }

        //summary
        // $pdf->Cell(126, 5, '', 0, 0);
        // $pdf->Cell(22, 5, 'Subtotal', 0, 0);
        // $pdf->Cell(7, 5, 'Rp', 1, 0);
        // $pdf->Cell(34, 5, $sum, 1, 1, 'R'); //end of line

        // $ppn = $data['DO']['ppn'];
        // $pdf->Cell(126, 5, '', 0, 0);
        // $pdf->Cell(22, 5, 'PPN ' . $ppn . ' %', 0, 0);
        // $pdf->Cell(7, 5, 'Rp', 1, 0);
        // $taxed = $sum * $ppn / 100;
        // $pdf->Cell(34, 5, $taxed, 1, 1, 'R'); //end of line

        // $pdf->Cell(126, 5, '', 0, 0);
        // $pdf->Cell(22, 5, 'Total Due', 0, 0);
        // $pdf->Cell(7, 5, 'Rp', 1, 0);
        // $pdf->Cell(34, 5, $sum + $taxed, 1, 1, 'R'); //end of line

        //make a dummy empty cell as a vertical spacer
        $pdf->Cell(189, 10, '', 0, 1); //end of line

        $pdf->Cell(20, 5, 'Catatan', 0, 0);
        $pdf->MultiCell(120, 5, ': ' . $data['DO']['other_expenses'], 0, 1);

        $pdf->Output('I', $filename . '.pdf');
    }
}
