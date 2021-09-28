<?php
class Supplier_model
{
    private $table = "supplier"; //nama table di db
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllSupplier()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getSupplierById($supplier_id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE supplier_id=:supplier_id');
        $this->db->bind('supplier_id', $supplier_id);
        return $this->db->single();
    }


    public function getSupplierId()
    {
        $this->db->query("SELECT supplier_id FROM " . $this->table);
        return $this->db->resultSet();
    }

    public function tambahDataSupplier($data)
    {
        $IdArray = $this->getSupplierId();
        if (empty($IdArray)) {
            $newIdInt = "1001";
        } else {
            $lastId = max($IdArray);
            $lastIdInt = (int)$lastId['supplier_id'];
            $newIdInt = $lastIdInt + 1;
        }


        $query = "INSERT INTO " . $this->table . " VALUES(:supplier_id, :supplier_name, :sales_name, :norek1, :norek2, :alamat_penagihan, :alamat_pengiriman, :no_telp1, :no_telp2, :email) ";
        $this->db->query($query);
        $this->db->bind('supplier_id', $newIdInt);
        $this->db->bind('supplier_name', $data['supplier_name']);
        $this->db->bind('sales_name', $data['sales_name']);
        $this->db->bind('norek1', $data['norek1']);
        $this->db->bind('norek2', $data['norek2']);
        $this->db->bind('alamat_penagihan', $data['alamat_penagihan']);
        $this->db->bind('alamat_pengiriman', $data['alamat_pengiriman']);
        $this->db->bind('no_telp1', $data['no_telp1']);
        $this->db->bind('no_telp2', $data['no_telp2']);
        $this->db->bind('email', $data['email']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function hapusDataSupplier($supplier_id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE supplier_id = :supplier_id";
        $this->db->query($query);
        $this->db->bind('supplier_id', $supplier_id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function editDataSupplier($data)
    {
        echo '<pre>', var_dump($data), '</pre>';
        $query = "UPDATE " . $this->table . " SET supplier_name=:supplier_name,
        sales_name=:sales_name,
        norek1=:norek1,
        norek2=:norek2,
        alamat_penagihan=:alamat_penagihan, 
        alamat_pengiriman =:alamat_pengiriman, 
        no_telp1 =:no_telp1,
        no_telp2 =:no_telp2, 
        email=:email 
            WHERE supplier_id=:supplier_id";
        $this->db->query($query);
        $this->db->bind('supplier_id', $data['supplier_id']);
        $this->db->bind('supplier_name', $data['supplier_name']);
        $this->db->bind('sales_name', $data['sales_name']);
        $this->db->bind('norek1', $data['norek1']);
        $this->db->bind('norek2', $data['norek2']);
        $this->db->bind('alamat_penagihan', $data['alamat_penagihan']);
        $this->db->bind('alamat_pengiriman', $data['alamat_pengiriman']);
        $this->db->bind('no_telp1', $data['no_telp1']);
        $this->db->bind('no_telp2', $data['no_telp2']);
        $this->db->bind('email', $data['email']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function cariDataSupplier()
    {
        $keyword = $_POST['keyword'];
        $query = "SELECT * FROM " . $this->table . " WHERE supplier_name LIKE :keyword";
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");

        return $this->db->resultSet();
    }
}
