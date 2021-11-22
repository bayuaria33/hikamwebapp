<?php
class User_model
{
    private $db;
    private $table = 'users';
    public function __construct()
    {
        $this->db = new Database;
    }

    function dd($variable)
    {
        echo '<pre>';
        die(var_dump($variable));
        echo '</pre>';
    }

    public function getAllUsers()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getUserById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function editPassUser($data)
    {
        $row = $this->getUserById($data['id']);
        $current = password_hash($_POST['currentPassword'], PASSWORD_DEFAULT);
        if ($current == $row["password"]) {
            $hashed = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
            $query = "UPDATE " . $this->table . " SET password='" . $hashed . "' WHERE id=:id";
            $this->db->query($query);
            $this->db->bind('id', $_POST['id']);
            // $this->dd($data, $row, $current, $_POST);
            $this->db->execute();
            return $this->db->rowCount();
        }
        // $this->dd($data, $row, $current, $_POST);
    }

    public function register($data)
    {
        $this->db->query('INSERT INTO users (username, level_user, password) VALUES(:username, :level_user, :password)');

        //Bind values
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':level_user', $data['level_user']);
        $this->db->bind(':password', $data['password']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($username, $password)
    {
        $this->db->query('SELECT * FROM users WHERE username = :username');

        //Bind value
        $this->db->bind(':username', $username);

        $row = $this->db->single();

        $hashedPassword = $row['password'];

        if (password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }

    //Find user by level_user. Level is passed in by the Controller.
    public function findUserByLevel($level_user)
    {
        //Prepared statement
        $this->db->query('SELECT * FROM users WHERE level_user = :level_user');

        //Level param will be binded with the level_user variable
        $this->db->bind(':level_user', $level_user);

        //Check if level_user is already registered
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
