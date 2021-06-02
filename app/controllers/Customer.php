<?php
class Customer extends Controller
{
    public function index()
    {
        $data['judul'] = "Customer";
        $data['cust'] = $this->model('Customer_model')->getAllCustomer();
        $this->view('templates/header', $data);
        $this->view('customer/index', $data);
        $this->view('templates/footer');
    }
}
