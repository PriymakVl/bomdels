<?php defined('SYSPATH') or die('No direct script access.');

class Model_Employee extends Model {
    
    private $tableName = 'employees';
    
    public function getAll() {
        $sql = "SELECT * FROM $this->tableName";
        $query = DB::query(Database::SELECT, $sql);
        return $query->execute()->as_array();
    }
    
    public function get($id) 
    {
       $sql = "SELECT * FROM $this->tableName WHERE `id` = :id LIMIT 1";
       $query = DB::query(Database::SELECT, $sql)->bind(':id', $id);
       $res = $query->execute()->as_array();
       if($res) return $res[0];
       else false;    
    }
    
    public function auth($login, $password)
    {
       $sql = "SELECT `id` FROM $this->tableName WHERE `login` = :login AND `password` = :password LIMIT 1";
       $query = DB::query(Database::SELECT, $sql)->bind(':login', $login)->bind(':password', $password);
       $res = $query->execute()->as_array();
       if($res) return $res[0]['id'];
       else false;
    }
    
    public function updatePassword($password, $employee_id)
    {
        $sql = "UPDATE $this->tableName SET `password` = :password WHERE `id` = :id";
        $query = DB::query(Database::UPDATE, $sql)->bind(':password', $password)->bind(':id', $employee_id);
        return $query->execute();
    }
    
      public function updateData($data)
    {
        $sql = "UPDATE $this->tableName SET `firstname` = :firstname, `patronymic` = :patronymic, `email` = :email WHERE `id` = :id";
        $query = DB::query(Database::UPDATE, $sql)->bind(':firstname', $data['firstname'])->bind(':patronymic', $data['patronymic'])
                                            ->bind(':email', $data['email'])->bind(':id', $data['employee_id']);
        return $query->execute();
    }
    
    public function add($data)
    {
        $sql = "INSERT INTO $this->tableName (login, password) VALUES (:login, :password)";
        $query = DB::query(Database::INSERT, $sql)->bind(':login', $data['login'])->bind(':password', $data['password']);
        $res = $query->execute();
        if($res) return $res[0];//return last id
        else false;
    }
    
    public function getEmployeeByLogin($login) 
    {
        $sql = "SELECT * FROM $this->tableName WHERE `login` = :login LIMIT 1";
        $query = DB::query(Database::SELECT, $sql)->bind(':login', $login);
        $res = $query->execute()->as_array();
        if($res) return $res[0];
        else false;          
    }
}










