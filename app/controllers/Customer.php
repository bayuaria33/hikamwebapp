<?php
class Customer extends Controller
{
    public function index()
    {
        $data['judul'] = "Daftar Customer";
        $data['cust'] = $this->model('Customer_model')->getAllCustomer();
        if ($_SESSION['level_user'] == '1' or $_SESSION['level_user'] == '2' or $_SESSION['level_user'] == '4') {
            $this->view('templates/header', $data);
            $this->view('customer/index', $data);
            $this->view('templates/footer');
        } else {
            header('Location:' . BASEURL);
        }
    }

    public function detail($customer_id)
    {
        $data['judul'] = "Detail Customer";
        $data['cust'] = $this->model('Customer_model')->getCustomerById($customer_id);
        $this->view('templates/header', $data);
        $this->view('customer/detail', $data);
        $this->view('templates/footer');
    }

    public function addPage()
    {
        $data['judul'] = "Tambah data Customer";
        $this->view('templates/header', $data);
        $this->view('customer/addPage');
        $this->view('templates/footer');
    }

    public function editPage($customer_id)
    {
        $data['judul'] = "Edit data Customer";
        $data['cust'] = $this->model('Customer_model')->getCustomerById($customer_id);
        $this->view('templates/header', $data);
        $this->view('customer/editPage', $data);
        $this->view('templates/footer');
    }

    public function custInvoice($customer_id)
    {
        $data['cust'] = $this->model('Customer_model')->getCustomerById($customer_id);
        $data['judul'] = "Daftar Invoice " . $data['cust']['customer_name'];
        $data['invc'] = $this->model('Invoice_model')->getInvoiceByCustomer($data['cust']['customer_name']);
        $this->view('templates/header', $data);
        $this->view('invoice/index', $data);
        $this->view('templates/footer');
    }
    public function custPurchase($customer_id)
    {
        $data['cust'] = $this->model('Customer_model')->getCustomerById($customer_id);
        $data['judul'] = "Daftar Purchase Order " . $data['cust']['customer_name'];
        $data['PO'] = $this->model('Purchase_model')->getPurchaseByCustomer($data['cust']['customer_name']);
        $this->view('templates/header', $data);
        $this->view('purchase/index', $data);
        $this->view('templates/footer');
    }
    public function custDelivery($customer_id)
    {
        $data['cust'] = $this->model('Customer_model')->getCustomerById($customer_id);
        $data['judul'] = "Daftar Delivery Order " . $data['cust']['customer_name'];
        $data['DO'] = $this->model('Delivery_model')->getDeliveryByCustomer($data['cust']['customer_name']);
        $this->view('templates/header', $data);
        $this->view('delivery/index', $data);
        $this->view('templates/footer');
    }

    public function edit($customer_id)
    {
        $url = BASEURL . '/Customer' . '/detail' . '/' . $customer_id;
        if ($this->model('Customer_model')->editDataCustomer($_POST) > 0) {
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
        if ($this->model('Customer_model')->tambahDataCustomer($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'ditambahkan');
            header('Location: ' . BASEURL . '/Customer');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'ditambahkan');
            header('Location: ' . BASEURL . '/Customer');
            exit;
        }
    }

    public function hapus($customer_id)
    {
        if ($this->model('Customer_model')->hapusDataCustomer($customer_id) > 0) {
            Flasher::setFlash('Berhasil', 'dihapus');
            header('Location: ' . BASEURL . '/Customer');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'dihapus');
            header('Location: ' . BASEURL . '/Customer');
            exit;
        }
    }

    public function cari()
    {
        $data['judul'] = "Daftar Customer";
        $data['cust'] = $this->model('Customer_model')->cariDataCustomer();
        $this->view('templates/header', $data);
        $this->view('customer/index', $data);
        $this->view('templates/footer');
    }
}
