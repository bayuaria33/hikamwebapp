<?php
class Customer_model
{
    private $table = "customer"; //nama table di db
    private $db;

    function dd($variable)
    {
        echo '<pre>';
        die(var_dump($variable));
        echo '</pre>';
    }

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


    public function getCustomerId()
    {
        $this->db->query("SELECT customer_id FROM " . $this->table);
        return $this->db->resultSet();
    }

    public function tambahDataCustomer($data)
    {

        $IdArray = $this->getCustomerId();
        if (empty($IdArray)) {
            $newIdInt = "1001";
        } else {
            $lastId = max($IdArray);
            $lastIdInt = (int)$lastId['customer_id'];
            $newIdInt = $lastIdInt + 1;
        }

        $query = "INSERT INTO " . $this->table . " VALUES(:customer_id, :customer_name, :alamat_penagihan, :alamat_pengiriman, :no_telp1, :no_telp2, :email, :UP_Penagihan, :UP_Pengiriman) ";
        $this->db->query($query);
        $this->db->bind('customer_id', $newIdInt);
        $this->db->bind('customer_name', $data['customer_name']);
        $this->db->bind('alamat_penagihan', $data['alamat_penagihan']);
        $this->db->bind('alamat_pengiriman', $data['alamat_pengiriman']);
        $this->db->bind('no_telp1', $data['no_telp1']);
        $this->db->bind('no_telp2', $data['no_telp2']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('UP_Penagihan', $data['UP_Penagihan']);
        $this->db->bind('UP_Pengiriman', $data['UP_Pengiriman']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function hapusDataCustomer($customer_id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE customer_id = :customer_id";
        $this->db->query($query);
        $this->db->bind('customer_id', $customer_id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function editDataCustomer($data)
    {

        $query = "UPDATE " . $this->table . " SET customer_name=:customer_name, 
        alamat_penagihan=:alamat_penagihan, 
        alamat_pengiriman =:alamat_pengiriman, 
        no_telp1 =:no_telp1,
        no_telp2 =:no_telp2, 
        email=:email,
        UP_Penagihan =:UP_Penagihan, 
        UP_Pengiriman =:UP_Pengiriman 
            WHERE customer_id=:customer_id";
        $this->db->query($query);
        $this->db->bind('customer_id', $data['customer_id']);
        $this->db->bind('customer_name', $data['customer_name']);
        $this->db->bind('alamat_penagihan', $data['alamat_penagihan']);
        $this->db->bind('alamat_pengiriman', $data['alamat_pengiriman']);
        $this->db->bind('no_telp1', $data['no_telp1']);
        $this->db->bind('no_telp2', $data['no_telp2']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('UP_Penagihan', $data['UP_Penagihan']);
        $this->db->bind('UP_Pengiriman', $data['UP_Pengiriman']);

        $this->db->execute();
        return $this->db->rowCount();
    }
}
