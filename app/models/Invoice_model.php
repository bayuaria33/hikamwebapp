<?php
class Invoice_model
{
    private $table = "invoice"; //nama table di db
    private $table2 = "invc_item";
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

    public function getAllInvoice()
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' ORDER BY invoice_date ASC');
        return $this->db->resultSet();
    }

    public function getInvoiceById($invoice_id)
    {
        $this->db->query('SELECT * FROM ' . $this->table .
            ' WHERE invoice_id LIKE ' . $invoice_id);
        return $this->db->single();
    }

    public function getInvoiceByCustomer($customer_name)
    {
        $this->db->query('SELECT * FROM ' . $this->table .
            ' WHERE customer_name LIKE "%' . $customer_name . '%"');
        return $this->db->resultSet();
    }

    public function getinvoiceId()
    {
        $this->db->query("SELECT invoice_id FROM " . $this->table);
        return $this->db->resultSet();
    }

    public function getInvoiceItemId()
    {
        $this->db->query("SELECT invc_item_id FROM " . $this->table2);
        return $this->db->resultSet();
    }


    public function tambahDataInvoice($data)
    {
        $IdArray = $this->getInvoiceid();          // wkwkwkwkwkkwkw
        if (empty($IdArray)) {
            $newIdInt = "1001";
        } else {
            $lastId = max($IdArray);
            $lastIdInt = (int)$lastId['invoice_id'];
            $newIdInt = $lastIdInt + 1;
        }             // wkwkwkwkwkkwkwi

        $query = "INSERT INTO " . $this->table .
            " VALUES(:invoice_id, 
            :invoice_number,
            :customer_name, 
            :invoice_date, 
            :other_expenses, 
            :status_pembayaran, 
            :biaya_kirim,
            :payment_option,
            :due_date,
            :ppn,  
            :PO_id, 
            :DO_id) ";
        $this->db->query($query);

        $this->db->bind('invoice_id', $newIdInt);
        $this->db->bind('invoice_number', $data['invoice_number']);
        $this->db->bind('customer_name', $data['customer_name']);
        $this->db->bind('invoice_date', $data['invoice_date']);
        $this->db->bind('other_expenses', $data['other_expenses']);
        $this->db->bind('status_pembayaran', $data['status_pembayaran']);
        $this->db->bind('ppn', $data['ppn']);
        $this->db->bind('payment_option', $data['payment_option']);
        $this->db->bind('due_date', $data['due_date']);
        $this->db->bind('PO_id', $data['PO_id']);
        $this->db->bind('DO_id', $data['DO_id']);
        $this->db->bind('biaya_kirim', $data['biaya_kirim']);
        // $this->dd($data);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function tambahDataInvoiceItem($data)
    {

        $IdArray = $this->getInvoiceItemId();          // wkwkwkwkwkkwkw
        if (empty($IdArray)) {
            $newIdInt = "1001";
        } else {
            $lastId = max($IdArray);
            $lastIdInt = (int)$lastId['invc_item_id'];
            $newIdInt = $lastIdInt + 1;
        }                 // wkwkwkwkwkkwkwi

        $query = "INSERT INTO " . $this->table2 .
            " VALUES(:invc_item_id, :invoice_id, :product_id, :quantity, :unit_item, :price) ";
        $this->db->query($query);

        $this->db->bind('invc_item_id', $newIdInt);
        $this->db->bind('invoice_id', $data['invoice_id']);
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
        invoice_number =:invoice_number
            WHERE invoice_id=:invoice_id";
        $this->db->query($query);
        $this->db->bind('invoice_id', $data['invc']['invoice_id']);
        $this->db->bind('invoice_number', $data['invoice_number']);
        $this->db->execute();
    }

    public function editDataInvoice($data)
    {
        $query = "UPDATE " . $this->table . " SET 
        customer_name=:customer_name, 
        invoice_number=:invoice_number,
        invoice_date =:invoice_date, 
        other_expenses =:other_expenses,
        status_pembayaran =:status_pembayaran, 
        ppn =:ppn,
        payment_option =:payment_option,
        due_date =:due_date,
        PO_id =:PO_id,
        DO_id =:DO_id,
        biaya_kirim =:biaya_kirim
            WHERE invoice_id=:invoice_id";
        $this->db->query($query);
        $this->db->bind('invoice_id', $data['invoice_id']);
        $this->db->bind('invoice_number', $data['invoice_number']);
        $this->db->bind('customer_name', $data['customer_name']);
        $this->db->bind('invoice_date', $data['invoice_date']);
        $this->db->bind('other_expenses', $data['other_expenses']);
        $this->db->bind('status_pembayaran', $data['status_pembayaran']);
        $this->db->bind('ppn', $data['ppn']);
        $this->db->bind('payment_option', $data['payment_option']);
        $this->db->bind('due_date', $data['due_date']);
        $this->db->bind('PO_id', $data['PO_id']);
        $this->db->bind('DO_id', $data['DO_id']);
        $this->db->bind('biaya_kirim', $data['biaya_kirim']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapusDataInvoice($invoice_id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE invoice_id = :invoice_id";
        $this->db->query($query);
        $this->db->bind('invoice_id', $invoice_id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function cariDataInvoice()
    {
        $keyword = $_POST['keyword'];
        $query = "SELECT * FROM " . $this->table . " WHERE customer_name LIKE :keyword";
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");

        return $this->db->resultSet();
    }

    public function getInvoiceItem($invoice_id)
    {
        $this->db->query(
            'SELECT *, product_name FROM '
                . $this->table2 .
                ' INNER JOIN product on ' . $this->table2 . '.product_id = product.product_id WHERE invoice_id LIKE ' . $invoice_id
        );
        return $this->db->resultSet();
    }

    public function getInvoiceCust($customer_name)
    {
        $this->db->query('SELECT * FROM ' . $this->table3 . ' WHERE customer_name=:customer_name');
        $this->db->bind('customer_name', $customer_name);
        return $this->db->single();
    }

    public function getInvoiceItembyId($invc_item_id)
    {
        $this->db->query('SELECT * FROM ' . $this->table2 .
            ' WHERE invc_item_id LIKE ' . $invc_item_id);
        return $this->db->single();
    }

    public function editDataItemInvoice($data)
    {
        $query = "UPDATE " . $this->table2 . " SET  
        invoice_id =:invoice_id,
        product_id =:product_id,
        quantity =:quantity, 
        unit_item =:unit_item, 
        price =:price
            WHERE invc_item_id=:invc_item_id";
        $this->db->query($query);
        $this->db->bind('invc_item_id', $data['invc_item_id']);
        $this->db->bind('invoice_id', $data['invoice_id']);
        $this->db->bind('product_id', $data['product_id']);
        $this->db->bind('quantity', $data['quantity']);
        $this->db->bind('unit_item', $data['unit_item']);
        $this->db->bind('price', $data['price']);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function hapusDataInvoiceItem($invc_item_id)
    {
        $query = "DELETE FROM " . $this->table2 . " WHERE invc_item_id = :invc_item_id";
        $this->db->query($query);
        $this->db->bind('invc_item_id', $invc_item_id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getInvoiceInMonth($month)
    {

        $this->db->query("select invoice_id from " . $this->table . " where monthname(invoice_date)='" . $month
            . "' order by invoice_date");
        return $this->db->resultSet();
    }
}
