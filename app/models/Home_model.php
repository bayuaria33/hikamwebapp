<?php



class Home_model
{
    private $table = "invoice"; //nama table produk
    private $table1 = "invc_item";
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }


    public function getTotalInvoice()
    {
        $this->db->query('SELECT SUM(invc_item.quantity * invc_item.price) as total FROM ' . $this->table . ' LEFT JOIN ' . $this->table1 . ' ON invoice.invoice_id = invc_item.invoice_id WHERE MONTH(invoice_date) = MONTH(CURRENT_DATE()) AND YEAR(invoice_date) = YEAR(CURRENT_DATE()) AND status_pembayaran = "Lunas"');
        return $this->db->single();
    }

    public function getTotalPurchase()
    {
        $this->db->query('SELECT SUM(pc_item.quantity * pc_item.price) as total FROM pc_order LEFT JOIN pc_item ON pc_order.PO_id = pc_item.PO_id WHERE MONTH(PO_date) = MONTH(CURRENT_DATE()) AND YEAR(PO_date) =  YEAR(CURRENT_DATE()) AND status_pembayaran = "Lunas"');
        return $this->db->single();
    }

    public function getTotalPetycash()
    {
        $this->db->query('SELECT SUM(petty_cash.price) as total FROM petty_cash WHERE MONTH(petty_date) = MONTH(CURRENT_DATE()) AND YEAR(petty_date) = YEAR(CURRENT_DATE()) ');
        return $this->db->Single();
    }

    public function getTotalInvoiceMont()
    {
        $this->db->query('SELECT
        SUM(IF(month(invoice_date) = "01", invc_item.quantity * invc_item.price, 0)) as january,
        SUM(IF(month(invoice_date) = "02", invc_item.quantity * invc_item.price, 0)) as february,
        SUM(IF(month(invoice_date) = "03", invc_item.quantity * invc_item.price, 0)) as maret,
        SUM(IF(month(invoice_date) = "04", invc_item.quantity * invc_item.price, 0)) as april,
        SUM(IF(month(invoice_date) = "05", invc_item.quantity * invc_item.price, 0)) as mei,
        SUM(IF(month(invoice_date) = "06", invc_item.quantity * invc_item.price, 0)) as juni,
        SUM(IF(month(invoice_date) = "07", invc_item.quantity * invc_item.price, 0)) as july,
        SUM(IF(month(invoice_date) = "08", invc_item.quantity * invc_item.price, 0)) as agustus,
        SUM(IF(month(invoice_date) = "09", invc_item.quantity * invc_item.price, 0)) as september,
        SUM(IF(month(invoice_date) = "10", invc_item.quantity * invc_item.price, 0)) as oktober,
        SUM(IF(month(invoice_date) = "11", invc_item.quantity * invc_item.price, 0)) as november,
        SUM(IF(month(invoice_date) = "12", invc_item.quantity * invc_item.price, 0)) as desember
        FROM ' . $this->table . ' LEFT JOIN ' . $this->table1 . ' ON invoice.invoice_id = invc_item.invoice_id WHERE YEAR(invoice_date) = YEAR(CURRENT_DATE()) AND status_pembayaran = "Lunas"');

        return $this->db->Single();
    }

    public function getTotalPurchMont()
    {
        $this->db->query('SELECT
        SUM(IF(month(PO_date) = "01", pc_item.quantity * pc_item.price, 0)) as january,
        SUM(IF(month(PO_date) = "02", pc_item.quantity * pc_item.price, 0)) as february,
        SUM(IF(month(PO_date) = "03", pc_item.quantity * pc_item.price, 0)) as maret,
        SUM(IF(month(PO_date) = "04", pc_item.quantity * pc_item.price, 0)) as april,
        SUM(IF(month(PO_date) = "05", pc_item.quantity * pc_item.price, 0)) as mei,
        SUM(IF(month(PO_date) = "06", pc_item.quantity * pc_item.price, 0)) as juni,
        SUM(IF(month(PO_date) = "07", pc_item.quantity * pc_item.price, 0)) as july,
        SUM(IF(month(PO_date) = "08", pc_item.quantity * pc_item.price, 0)) as agustus,
        SUM(IF(month(PO_date) = "09", pc_item.quantity * pc_item.price, 0)) as september,
        SUM(IF(month(PO_date) = "10", pc_item.quantity * pc_item.price, 0)) as oktober,
        SUM(IF(month(PO_date) = "11", pc_item.quantity * pc_item.price, 0)) as november,
        SUM(IF(month(PO_date) = "12", pc_item.quantity * pc_item.price, 0)) as desember
        FROM pc_order LEFT JOIN pc_item ON pc_order.PO_id = pc_item.PO_id WHERE YEAR(PO_date) = YEAR(CURRENT_DATE()) AND status_pembayaran = "Lunas"');

        return $this->db->Single();
    }

    public function getTotalPettyCash()
    {
        $this->db->query('SELECT
        SUM(IF(month(petty_date) = "01", petty_cash.price, 0)) as january,
        SUM(IF(month(petty_date) = "02", petty_cash.price, 0)) as february,
        SUM(IF(month(petty_date) = "03", petty_cash.price, 0)) as maret,
        SUM(IF(month(petty_date) = "04", petty_cash.price, 0)) as april,
        SUM(IF(month(petty_date) = "05", petty_cash.price, 0)) as mei,
        SUM(IF(month(petty_date) = "06", petty_cash.price, 0)) as juni,
        SUM(IF(month(petty_date) = "07", petty_cash.price, 0)) as july,
        SUM(IF(month(petty_date) = "08", petty_cash.price, 0)) as agustus,
        SUM(IF(month(petty_date) = "09", petty_cash.price, 0)) as september,
        SUM(IF(month(petty_date) = "10", petty_cash.price, 0)) as oktober,
        SUM(IF(month(petty_date) = "11", petty_cash.price, 0)) as november,
        SUM(IF(month(petty_date) = "12", petty_cash.price, 0)) as desember
        FROM petty_cash  WHERE YEAR(petty_date) = YEAR(CURRENT_DATE())');

        return $this->db->Single();
    }
}
