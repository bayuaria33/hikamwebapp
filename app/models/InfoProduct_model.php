<?php
class InfoProduct_model
{
    private $table = "infoproduct"; //nama table produk
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllInfoProduct()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getInfoProductById($infoproduct_id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE infoproduct_id=:infoproduct_id');
        $this->db->bind('infoproduct_id', $infoproduct_id);
        return $this->db->single();
    }


    public function getInfoProductId()
    {
        $this->db->query("SELECT infoproduct_id FROM " . $this->table);
        return $this->db->resultSet();
    }

    public function getProductId()                                    // <--
    {
        $this->db->query("SELECT product_id FROM " . $this->table);   // tambahan
        return $this->db->resultSet();
    }

    public function tambahDataInfoProduct($data)
    {
        $IdArray = $this->getInfoProductId();          
        $lastId = end($IdArray);                    
        $lastIdInt = (int)$lastId['infoproduct_id'];   
        $newIdInt = $lastIdInt + 1;                


        $query = "INSERT INTO " . $this->table . " VALUES(:infoproduct_id, :product_id, :product_avb, :supplier_id, :product_price, :product_update, :infoproduct_quantity) ";
        $this->db->query($query);
        $this->db->bind('infoproduct_id', $newIdInt);
        $this->db->bind('product_id', $data['product_id']);
        $this->db->bind('product_avb', $data['product_avb']);
        $this->db->bind('supplier_id', $data['supplier_id']);
        $this->db->bind('product_price', $data['product_price']);
        $this->db->bind('product_update', $data['product_update']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function hapusDataInfoProduct($infoproduct_id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE infoproduct_id = :infoproduct_id";
        $this->db->query($query);
        $this->db->bind('infoproduct_id', $infoproduct_id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function editDataInfoProduct($data)
    {
        echo '<pre>', var_dump($data), '</pre>';
        $query = "UPDATE " . $this->table . " SET product_id=:product_id, 
        product_avb=:product_avb, 
        supplier_id =:supplier_id, 
        product_price =:product_price,
        product_update =:product_update, 
            WHERE infoproduct_id=:infoproduct_id";
        $this->db->query($query);
        $this->db->bind('infoproduct_id', $data['infoproduct_id']);
        $this->db->bind('product_id', $data['product_id']);
        $this->db->bind('product_avb', $data['product_avb']);
        $this->db->bind('supplier_id', $data['supplier_id']);
        $this->db->bind('product_price', $data['product_price']);
        $this->db->bind('product_update', $data['product_update']);
        

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function cariDataInfoProduct()
    {
        $keyword = $_POST['keyword'];
        $query = "SELECT * FROM " . $this->table . " WHERE infoproduct_name LIKE :keyword";
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");

        return $this->db->resultSet();
    }
}
