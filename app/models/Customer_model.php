<?php
class Customer_model
{
    private $table = "customer"; //nama table di db
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllCustomer()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getCustomerById($customer_id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE customer_id=:customer_id');
        $this->db->bind('customer_id', $customer_id);
        return $this->db->single();
    }
}
