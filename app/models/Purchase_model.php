<?php
class Purchase_model
{
    private $table = "pc_order"; //nama table di db
    private $table2 = "pc_item";
    private $table3 = "supplier";
    private $table4 = "customer";
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

    public function getAllPurchase()
    {
        $this->db->query("SELECT * FROM " . $this->table . " ORDER BY PO_date ASC");
        return $this->db->resultSet();
    }

    public function getAllPurchaseSupplier()
    {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE customer_name IS NULL OR customer_name = '' ORDER BY PO_date ASC");
        return $this->db->resultSet();
    }

    public function getAllPurchaseCustomer()
    {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE supplier_name IS NULL OR supplier_name = '' ORDER BY PO_date ASC");
        return $this->db->resultSet();
    }

    public function getPurchaseById($PO_id)
    {
        $this->db->query('SELECT * FROM ' . $this->table .
            ' WHERE PO_id LIKE ' . $PO_id);
        return $this->db->single();
    }

    public function getPurchaseBySupplier($supplier_name)
    {
        $this->db->query('SELECT * FROM ' . $this->table .
            ' WHERE supplier_name LIKE "%' . $supplier_name . '%"');
        return $this->db->resultSet();
    }

    public function getPurchaseByCustomer($customer_name)
    {
        $this->db->query('SELECT * FROM ' . $this->table .
            ' WHERE customer_name LIKE "%' . $customer_name . '%"');
        return $this->db->resultSet();
    }

    public function getPurchaseId()
    {
        $this->db->query("SELECT PO_id FROM " . $this->table);
        return $this->db->resultSet();
    }

    public function getPurchaseItemId()
    {
        $this->db->query("SELECT pc_item_id FROM " . $this->table2);
        return $this->db->resultSet();
    }


    public function tambahDataPurchase($data)
    {
        $IdArray = $this->getPurchaseId();          // wkwkwkwkwkkwkw
        if (empty($IdArray)) {
            $newIdInt = "1001";
        } else {
            $lastId = max($IdArray);
            $lastIdInt = (int)$lastId['PO_id'];
            $newIdInt = $lastIdInt + 1;
        }             // wkwkwkwkwkkwkwi

        $query = "INSERT INTO " . $this->table .
            " VALUES(:PO_id, 
            :purchase_number,
            :supplier_name,
            :customer_name, 
            :PO_date, 
            :other_expenses, 
            :status_pembayaran, 
            :payment_option,
            :due_date, 
            :ppn,
            :invoice_id, 
            :DO_id) ";
        $this->db->query($query);

        $this->db->bind('PO_id', $newIdInt);
        $this->db->bind('purchase_number', $data['purchase_number']);
        $this->db->bind('supplier_name', $data['supplier_name']);
        $this->db->bind('customer_name', $data['customer_name']);
        $this->db->bind('PO_date', $data['PO_date']);
        $this->db->bind('other_expenses', $data['other_expenses']);
        $this->db->bind('status_pembayaran', $data['status_pembayaran']);
        $this->db->bind('payment_option', $data['payment_option']);
        $this->db->bind('due_date', $data['due_date']);
        $this->db->bind('ppn', $data['ppn']);
        $this->db->bind('invoice_id', $data['invoice_id']);
        $this->db->bind('DO_id', $data['DO_id']);
        //$this->dd($_POST);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function tambahDataPurchaseItem($data)
    {

        $IdArray = $this->getPurchaseItemId();          // wkwkwkwkwkkwkw
        if (empty($IdArray)) {
            $newIdInt = "1001";
        } else {
            $lastId = max($IdArray);
            $lastIdInt = (int)$lastId['pc_item_id'];
            $newIdInt = $lastIdInt + 1;
        }                 // wkwkwkwkwkkwkwi

        $query = "INSERT INTO " . $this->table2 .
            " VALUES(:pc_item_id, :PO_id, :product_id, :quantity, :unit_item, :price) ";
        $this->db->query($query);

        $this->db->bind('pc_item_id', $newIdInt);
        $this->db->bind('PO_id', $data['PO_id']);
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
        purchase_number =:purchase_number
            WHERE PO_id=:PO_id";
        $this->db->query($query);
        $this->db->bind('PO_id', $data['PO']['PO_id']);
        $this->db->bind('purchase_number', $data['purchase_number']);
        $this->db->execute();
    }

    public function editDataPurchase($data)
    {
        $query = "UPDATE " . $this->table . " SET 
        supplier_name=:supplier_name,
        customer_name=:customer_name,  
        purchase_number=:purchase_number, 
        PO_date =:PO_date, 
        other_expenses =:other_expenses,
        status_pembayaran =:status_pembayaran, 
        ppn =:ppn,
        payment_option =:payment_option,
        due_date =:due_date,
        invoice_id =:invoice_id,
        DO_id =:DO_id
            WHERE PO_id=:PO_id";
        $this->db->query($query);
        $this->db->bind('PO_id', $data['PO_id']);
        $this->db->bind('supplier_name', $data['supplier_name']);
        $this->db->bind('customer_name', $data['customer_name']);
        $this->db->bind('purchase_number', $data['purchase_number']);
        $this->db->bind('PO_date', $data['PO_date']);
        $this->db->bind('other_expenses', $data['other_expenses']);
        $this->db->bind('status_pembayaran', $data['status_pembayaran']);
        $this->db->bind('ppn', $data['ppn']);
        $this->db->bind('payment_option', $data['payment_option']);
        $this->db->bind('due_date', $data['due_date']);
        $this->db->bind('invoice_id', $data['invoice_id']);
        $this->db->bind('DO_id', $data['DO_id']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapusDataPurchase($PO_id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE PO_id = :PO_id";
        $this->db->query($query);
        $this->db->bind('PO_id', $PO_id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function cariDataPurchase()
    {
        $keyword = $_POST['keyword'];
        $query = "SELECT * FROM " . $this->table . " WHERE supplier_name LIKE :keyword";
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");

        return $this->db->resultSet();
    }

    public function getPurchaseItem($PO_id)
    {
        $this->db->query(
            'SELECT *, product_name FROM '
                . $this->table2 .
                ' INNER JOIN product on ' . $this->table2 . '.product_id = product.product_id WHERE PO_id LIKE ' . $PO_id
        );
        return $this->db->resultSet();
    }

    public function getPurchaseSupp($supplier_name)
    {
        $this->db->query('SELECT * FROM ' . $this->table3 . ' WHERE supplier_name=:supplier_name');
        $this->db->bind('supplier_name', $supplier_name);
        return $this->db->single();
    }

    public function getPurchaseCust($customer_name)
    {
        $this->db->query('SELECT * FROM ' . $this->table4 . ' WHERE customer_name=:customer_name');
        $this->db->bind('customer_name', $customer_name);
        return $this->db->single();
    }

    public function getPurchaseItembyId($pc_item_id)
    {
        $this->db->query('SELECT * FROM ' . $this->table2 .
            ' WHERE pc_item_id LIKE ' . $pc_item_id);
        return $this->db->single();
    }

    public function editDataItemPurchase($data)
    {
        $query = "UPDATE " . $this->table2 . " SET  
        PO_id =:PO_id,
        product_id =:product_id,
        quantity =:quantity, 
        unit_item =:unit_item,
        price =:price
            WHERE pc_item_id=:pc_item_id";
        $this->db->query($query);
        $this->db->bind('pc_item_id', $data['pc_item_id']);
        $this->db->bind('PO_id', $data['PO_id']);
        $this->db->bind('product_id', $data['product_id']);
        $this->db->bind('quantity', $data['quantity']);
        $this->db->bind('unit_item', $data['unit_item']);
        $this->db->bind('price', $data['price']);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function hapusDataPurchaseItem($pc_item_id)
    {
        $query = "DELETE FROM " . $this->table2 . " WHERE pc_item_id = :pc_item_id";
        $this->db->query($query);
        $this->db->bind('pc_item_id', $pc_item_id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getPurchaseInMonth($month)
    {

        $this->db->query("select PO_id from " . $this->table . " where monthname(PO_date)='" . $month
            . "' order by PO_date");
        return $this->db->resultSet();
    }
}
