<?php
class Delivery_model
{
    private $table = "delivery_order"; //nama table di db
    private $table2 = "do_item";
    private $table3 = "customer";
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

    public function getAllDelivery()
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' ORDER BY DO_date ASC');
        return $this->db->resultSet();
    }

    public function getDeliveryById($DO_ID)
    {
        $this->db->query('SELECT * FROM ' . $this->table .
            ' WHERE DO_id LIKE ' . $DO_ID);
        return $this->db->single();
    }

    public function getDeliveryByCustomer($customer_name)
    {
        $this->db->query('SELECT * FROM ' . $this->table .
            ' WHERE customer_name LIKE "%' . $customer_name . '%"');
        return $this->db->resultSet();
    }

    public function getDeliveryId()
    {
        $this->db->query("SELECT DO_id FROM " . $this->table);
        return $this->db->resultSet();
    }

    public function getDeliveryItemId()
    {
        $this->db->query("SELECT do_item_id FROM " . $this->table2);
        return $this->db->resultSet();
    }


    public function tambahDataDelivery($data)
    {
        $IdArray = $this->getDeliveryid();          // wkwkwkwkwkkwkw
        if (empty($IdArray)) {
            $newIdInt = "1001";
        } else {
            $lastId = max($IdArray);
            $lastIdInt = (int)$lastId['DO_id'];
            $newIdInt = $lastIdInt + 1;
        }             // wkwkwkwkwkkwkwi

        $query = "INSERT INTO " . $this->table .
            " VALUES(:DO_id, 
            :delivery_number,
            :customer_name, 
            :DO_date, 
            :other_expenses, 
            :tipe, 
            :status_pembayaran,
            :due_date,
            :ppn,  
            :PO_id, 
            :invoice_id) ";
        $this->db->query($query);

        $this->db->bind('DO_id', $newIdInt);
        $this->db->bind('delivery_number', $data['delivery_number']);
        $this->db->bind('customer_name', $data['customer_name']);
        $this->db->bind('DO_date', $data['DO_date']);
        $this->db->bind('other_expenses', $data['other_expenses']);
        $this->db->bind('tipe', $data['tipe']);
        $this->db->bind('status_pembayaran', $data['status_pembayaran']);
        $this->db->bind('due_date', $data['due_date']);
        $this->db->bind('ppn', $data['ppn']);
        $this->db->bind('PO_id', $data['PO_id']);
        $this->db->bind('invoice_id', $data['invoice_id']);
        //$this->dd($data);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function tambahDataDeliveryItem($data)
    {

        $IdArray = $this->getDeliveryItemId();          // wkwkwkwkwkkwkw
        if (empty($IdArray)) {
            $newIdInt = "1001";
        } else {
            $lastId = max($IdArray);
            $lastIdInt = (int)$lastId['do_item_id'];
            $newIdInt = $lastIdInt + 1;
        }                 // wkwkwkwkwkkwkwi

        $query = "INSERT INTO " . $this->table2 .
            " VALUES(:do_item_id, :DO_id, :product_id, :quantity, :unit_item, :price) ";
        $this->db->query($query);

        $this->db->bind('do_item_id', $newIdInt);
        $this->db->bind('DO_id', $data['DO_id']);
        $this->db->bind('product_id', $data['product_id']);
        $this->db->bind('quantity', $data['quantity']);
        $this->db->bind('unit_item', $data['unit_item']);
        $this->db->bind('price', $data['price']);
        $this->db->execute();


        return $this->db->rowCount();
    }

    public function insertNumber($data)
    {
        $query = "UPDATE " . $this->table . " SET 
        delivery_number =:delivery_number
            WHERE DO_id=:DO_id";
        $this->db->query($query);
        $this->db->bind('DO_id', $data['DO']['DO_id']);
        $this->db->bind('delivery_number', $data['delivery_number']);
        $this->db->execute();
    }

    public function editDataDelivery($data)
    {
        $query = "UPDATE " . $this->table . " SET 
        customer_name=:customer_name, 
        delivery_number=:delivery_number, 
        DO_date =:DO_date, 
        other_expenses =:other_expenses,
        status_pembayaran =:status_pembayaran, 
        tipe =:tipe,
        ppn =:ppn,
        due_date =:due_date,
        PO_id =:PO_id,
        invoice_id =:invoice_id
            WHERE DO_id=:DO_id";
        $this->db->query($query);
        $this->db->bind('DO_id', $data['DO_id']);
        $this->db->bind('customer_name', $data['customer_name']);
        $this->db->bind('delivery_number', $data['delivery_number']);
        $this->db->bind('DO_date', $data['DO_date']);
        $this->db->bind('other_expenses', $data['other_expenses']);
        $this->db->bind('status_pembayaran', $data['status_pembayaran']);
        $this->db->bind('tipe', $data['tipe']);
        $this->db->bind('ppn', $data['ppn']);
        $this->db->bind('due_date', $data['due_date']);
        $this->db->bind('PO_id', $data['PO_id']);
        $this->db->bind('invoice_id', $data['invoice_id']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapusDataDelivery($DO_ID)
    {
        $query = "DELETE FROM " . $this->table . " WHERE DO_id = :DO_id";
        $this->db->query($query);
        $this->db->bind('DO_id', $DO_ID);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function cariDataDelivery()
    {
        $keyword = $_POST['keyword'];
        $query = "SELECT * FROM " . $this->table . " WHERE customer_name LIKE :keyword";
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");

        return $this->db->resultSet();
    }

    public function getDeliveryItem($DO_ID)
    {
        $this->db->query(
            'SELECT *, product_name FROM '
                . $this->table2 .
                ' INNER JOIN product on ' . $this->table2 . '.product_id = product.product_id WHERE DO_id LIKE ' . $DO_ID
        );
        return $this->db->resultSet();
    }

    public function getDeliveryCust($customer_name)
    {
        $this->db->query('SELECT * FROM ' . $this->table3 . ' WHERE customer_name=:customer_name');
        $this->db->bind('customer_name', $customer_name);
        return $this->db->single();
    }

    public function getDeliveryItembyId($do_item_id)
    {
        $this->db->query('SELECT * FROM ' . $this->table2 .
            ' WHERE do_item_id LIKE ' . $do_item_id);
        return $this->db->single();
    }

    public function editDataItemDelivery($data)
    {
        $query = "UPDATE " . $this->table2 . " SET  
        do_id =:do_id,
        product_id =:product_id,
        quantity =:quantity, 
        unit_item =:unit_item, 
        price =:price
            WHERE do_item_id=:do_item_id";
        $this->db->query($query);
        $this->db->bind('do_item_id', $data['do_item_id']);
        $this->db->bind('do_id', $data['do_id']);
        $this->db->bind('product_id', $data['product_id']);
        $this->db->bind('quantity', $data['quantity']);
        $this->db->bind('unit_item', $data['unit_item']);
        $this->db->bind('price', $data['price']);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function hapusDataDeliveryItem($do_item_id)
    {
        $query = "DELETE FROM " . $this->table2 . " WHERE do_item_id = :do_item_id";
        $this->db->query($query);
        $this->db->bind('do_item_id', $do_item_id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getDeliveryInMonth($month)
    {

        $this->db->query("select DO_id from " . $this->table . " where monthname(DO_date)='" . $month
            . "' order by DO_date");
        return $this->db->resultSet();
    }
}
