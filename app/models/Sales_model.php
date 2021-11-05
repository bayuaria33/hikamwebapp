<?php
class Sales_model
{
    private $table = "sales"; //nama table di db
    private $table2 = "customer"; //nama table di db
    private $table3 = "product"; //nama table di db
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

    public function getAllSales()
    {
        $this->db->query('SELECT ' . $this->table . '.*, customer_name, product_name FROM ' . $this->table . ' 
        INNER JOIN ' . $this->table3 . ' on ' . $this->table3 . '.product_id = ' . $this->table . '.product_id
        INNER JOIN ' . $this->table2 . ' on ' . $this->table2 . '.customer_id = ' . $this->table . '.customer_id');
        return $this->db->resultSet();
    }

    public function getSalesById($sales_id)
    {
        $this->db->query('SELECT ' . $this->table . '.*, customer_name, product_name FROM ' . $this->table . ' 
        INNER JOIN ' . $this->table3 . ' on ' . $this->table3 . '.product_id = ' . $this->table . '.product_id
        INNER JOIN ' . $this->table2 . ' on ' . $this->table2 . '.customer_id = ' . $this->table . '.customer_id  WHERE sales_id=:sales_id');
        $this->db->bind('sales_id', $sales_id);
        return $this->db->single();
    }

    public function getSalesId()
    {
        $this->db->query("SELECT sales_id FROM " . $this->table);
        return $this->db->resultSet();
    }

    public function tambahDataSales($data)
    {

        $IdArray = $this->getSalesId();
        if (empty($IdArray)) {
            $newIdInt = "1001";
        } else {
            $lastId = max($IdArray);
            $lastIdInt = (int)$lastId['sales_id'];
            $newIdInt = $lastIdInt + 1;
        }

        $query = "INSERT INTO " . $this->table . " VALUES(:sales_id, :customer_id, :product_id, :quantity, :price, :sales_date) ";
        $this->db->query($query);
        $this->db->bind('sales_id', $newIdInt);
        $this->db->bind('customer_id', $data['customer_id']);
        $this->db->bind('product_id', $data['product_id']);
        $this->db->bind('quantity', $data['quantity']);
        $this->db->bind('price', $data['price']);
        $this->db->bind('sales_date', $data['sales_date']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function hapusDataSales($sales_id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE sales_id = :sales_id";
        $this->db->query($query);
        $this->db->bind('sales_id', $sales_id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function editDataSales($data)
    {

        $query = "UPDATE " . $this->table . " SET customer_id=:customer_id, 
        product_id=:product_id, 
        quantity =:quantity, 
        price =:price,
        sales_date =:sales_date
            WHERE sales_id=:sales_id";
        $this->db->query($query);
        $this->db->bind('sales_id', $data['sales_id']);
        $this->db->bind('customer_id', $data['customer_id']);
        $this->db->bind('product_id', $data['product_id']);
        $this->db->bind('quantity', $data['quantity']);
        $this->db->bind('price', $data['price']);
        $this->db->bind('sales_date', $data['sales_date']);

        $this->db->execute();
        return $this->db->rowCount();
    }
}
