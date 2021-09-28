<?php
class Product_model
{
    private $table = "product"; //nama table produk
    private $table1 = "info_product"; //nama table info produk
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllProduct()
    {
        $this->db->query('SELECT 
                            product_id, product_name, 
                            product_sell_price, unit, 
                            product_desc, 
                            DATE(product_updated) AS product_updated, 
                            product_quantity FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getProductById($product_id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE product_id=:product_id');
        $this->db->bind('product_id', $product_id);
        return $this->db->single();
    }


    public function getProductId()
    {
        $this->db->query("SELECT product_id FROM " . $this->table);
        return $this->db->resultSet();
    }

    public function tambahDataProduct($data)
    {
        $IdArray = $this->getProductId();
        if (empty($IdArray)) {
            $newIdInt = "1001";
        } else {
            $lastId = max($IdArray);
            $lastIdInt = (int)$lastId['product_id'];
            $newIdInt = $lastIdInt + 1;
        }


        $query = "INSERT INTO " . $this->table . " VALUES(:product_id, :product_name, :product_sell_price, :unit, :product_desc, :product_updated, :product_quantity) ";
        $this->db->query($query);
        $this->db->bind('product_id', $newIdInt);
        $this->db->bind('product_name', $data['product_name']);
        $this->db->bind('product_sell_price', $data['product_sell_price']);
        $this->db->bind('unit', $data['unit']);
        $this->db->bind('product_desc', $data['product_desc']);
        $this->db->bind('product_updated', $data['product_updated']);
        $this->db->bind('product_quantity', $data['product_quantity']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function hapusDataProduct($product_id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE product_id = :product_id";
        $this->db->query($query);
        $this->db->bind('product_id', $product_id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function editDataProduct($data)
    {
        echo '<pre>', var_dump($data), '</pre>';
        $query = "UPDATE " . $this->table . " SET product_name=:product_name, 
        product_sell_price=:product_sell_price, 
        unit =:unit, 
        product_desc =:product_desc,
        product_updated =:product_updated, 
        product_quantity=:product_quantity 
            WHERE product_id=:product_id";
        $this->db->query($query);
        $this->db->bind('product_id', $data['product_id']);
        $this->db->bind('product_name', $data['product_name']);
        $this->db->bind('product_sell_price', $data['product_sell_price']);
        $this->db->bind('unit', $data['unit']);
        $this->db->bind('product_desc', $data['product_desc']);
        $this->db->bind('product_updated', $data['product_updated']);
        $this->db->bind('product_quantity', $data['product_quantity']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function cariDataProduct()
    {
        $keyword = $_POST['keyword'];
        $query = "SELECT * FROM " . $this->table . " WHERE product_name LIKE :keyword";
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");

        return $this->db->resultSet();
    }
}
