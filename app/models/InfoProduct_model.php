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
        $this->db->query('SELECT infoproduct_id, product_id, product_avb, supplier_name, product_price, DATE(product_updated) AS product_updated FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getAllProductSupp($product_id)
    {
        $this->db->query('SELECT 
        infoproduct_id,
        product.product_id AS product_id, 
        product.product_name AS product_name, 
        product_avb, 
        infoproduct.product_desc AS product_desc, 
        infoproduct.unit AS unit, 
        supplier_name, 
        product_price, 
        DATE(infoproduct.product_updated) AS product_updated
        FROM infoproduct 
            INNER JOIN product on product.product_id = infoproduct.product_id
                WHERE infoproduct.product_id =:product_id');
        $this->db->bind('product_id', $product_id);
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
        if (empty($IdArray)) {
            $newIdInt = "1001";
        } else {
            $lastId = max($IdArray);
            $lastIdInt = (int)$lastId['infoproduct_id'];
            $newIdInt = $lastIdInt + 1;
        }
        $t = time();
        $time = date("Y-m-d", $t);

        var_dump($data);
        $query = "INSERT INTO " . $this->table . " VALUES(:infoproduct_id, :product_id, :product_avb, :product_desc, :unit, :supplier_name, :product_price, :product_updated)";
        $this->db->query($query);
        $this->db->bind('infoproduct_id', $newIdInt);
        $this->db->bind('product_id', $data['product_id']);
        $this->db->bind('product_avb', $data['product_avb']);
        $this->db->bind('product_desc', $data['product_desc']);
        $this->db->bind('unit', $data['unit']);
        $this->db->bind('supplier_name', $data['supplier_name']);
        $this->db->bind('product_price', $data['product_price']);
        $this->db->bind('product_updated', $time);
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
        $query = "UPDATE " . $this->table . " SET 
        product_avb=:product_avb, 
        supplier_name =:supplier_name, 
        product_desc =:product_desc,
        unit =:unit, 
        product_price =:product_price
            WHERE infoproduct_id=:infoproduct_id";
        $this->db->query($query);
        $this->db->bind('infoproduct_id', $data['infoproduct_id']);
        $this->db->bind('product_avb', $data['product_avb']);
        $this->db->bind('product_desc', $data['product_desc']);
        $this->db->bind('unit', $data['unit']);
        $this->db->bind('supplier_name', $data['supplier_name']);
        $this->db->bind('product_price', $data['product_price']);


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
