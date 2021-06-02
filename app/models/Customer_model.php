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
}
