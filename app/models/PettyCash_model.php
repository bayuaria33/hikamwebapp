<?php 
    class PettyCash_model
    {
        private $table = "petty_cash"; //nama table di db
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllPettyCash()
    {
        $this->db->query('SELECT * FROM ' . $this->table. ' ORDER BY petty_date DESC');
        return $this->db->resultSet();
    }

    public function getPettyCashId()
    {
        $this->db->query("SELECT petty_id FROM " . $this->table);
        return $this->db->resultSet();
    }


    public function tambahDataPettyCash($data)
    {
        $IdArray = $this->getPettyCashId();
        if (empty($IdArray)) {
            $newIdInt = "1001";
        } else {
            $lastId = max($IdArray);
            $lastIdInt = (int)$lastId['petty_id'];
            $newIdInt = $lastIdInt + 1;
        }


        $query = "INSERT INTO " . $this->table . " VALUES(:petty_id, :name, :petty_date, :price) ";
        $this->db->query($query);
        $this->db->bind('petty_id', $newIdInt);
        $this->db->bind('name', $data['name']);
        $this->db->bind('petty_date', $data['petty_date']);
        $this->db->bind('price', $data['price']);
        
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function hapusDataPettyCash($petty_id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE petty_id = :petty_id";
        $this->db->query($query);
        $this->db->bind('petty_id', $petty_id);

        $this->db->execute();

        return $this->db->rowCount();
    }


    }

?>