<?php
class Customer extends Controller
{
    public function index()
    {
        $data['judul'] = "Daftar Customer";
        $data['cust'] = $this->model('Customer_model')->getAllCustomer();
        $this->view('templates/header', $data);
        $this->view('customer/index', $data);
        $this->view('templates/footer');
    }

    public function detail($customer_id)
    {
        $data['judul'] = "Detail Customer";
        $data['cust'] = $this->model('Customer_model')->getCustomerById($customer_id);
        $this->view('templates/header', $data);
        $this->view('customer/detail', $data);
        $this->view('templates/footer');
    }
}
