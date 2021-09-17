<?php
class Invoice_model
{
    private $table = "invoice"; //nama table di db
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
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getInvoiceById($invoice_id)
    {
        $this->db->query('SELECT * FROM ' . $this->table .
            ' WHERE invoice_id LIKE ' . $invoice_id);
        return $this->db->single();
    }

    public function getinvoiceId()
    {
        $this->db->query("SELECT invoice_id FROM " . $this->table);
        return $this->db->resultSet();
    }


    public function tambahDataInvoice($data)
    {
        $IdArray = $this->getInvoiceid();          // wkwkwkwkwkkwkw
        $lastId = end($IdArray);                    // satu block code ini cuman buat ngambil Id terakhir doang, soalnya gak autoincrement
        $lastIdInt = (int)$lastId['invoice_id'];   // wkwkwkwkwkkwkw
        $newIdInt = $lastIdInt + 1;                 // wkwkwkwkwkkwkwi

        $query = "INSERT INTO " . $this->table .
            " VALUES(:invoice_id, :customer_name, :invoice_date, :other_expenses, :status_pembayaran, :due_date, :PO_id, :DO_id) ";
        $this->db->query($query);

        $this->db->bind('invoice_id', $newIdInt);
        $this->db->bind('customer_name', $data['customer_name']);
        $this->db->bind('invoice_date', $data['invoice_date']);
        $this->db->bind('other_expenses', $data['other_expenses']);
        $this->db->bind('status_pembayaran', $data['status_pembayaran']);
        $this->db->bind('due_date', $data['due_date']);
        $this->db->bind('PO_id', $data['PO_id']);
        $this->db->bind('DO_id', $data['DO_id']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function editDataInvoice($data)
    {
        $query = "UPDATE " . $this->table . " SET 
        customer_name=:customer_name, 
        invoice_date =:invoice_date, 
        other_expenses =:other_expenses,
        status_pembayaran =:status_pembayaran, 
        due_date =:due_date,
        PO_id =:PO_id,
        DO_id =:DO_id
            WHERE invoice_id=:invoice_id";
        $this->db->query($query);
        $this->db->bind('invoice_id', $data['invoice_id']);
        $this->db->bind('customer_name', $data['customer_name']);
        $this->db->bind('invoice_date', $data['invoice_date']);
        $this->db->bind('other_expenses', $data['other_expenses']);
        $this->db->bind('status_pembayaran', $data['status_pembayaran']);
        $this->db->bind('due_date', $data['due_date']);
        $this->db->bind('PO_id', $data['PO_id']);
        $this->db->bind('DO_id', $data['DO_id']);

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
}
