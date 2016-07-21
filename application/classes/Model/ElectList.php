<?php defined('SYSPATH') or die('No direct script access.');

class Model_ElectList extends Model {
    
    private $tableName = 'elect_lists';
    
    public function getAll() {
        $sql = "SELECT * FROM $this->tableName WHERE `status` = :status";
        $query = DB::query(Database::SELECT, $sql)->param(':status', 1);
        return $query->execute()->as_array();
    }
    
    public function getListById($id)
    {
        if(!$id) $id = 1;
        $sql = "SELECT * FROM $this->tableName WHERE `id` = :id AND `status` = :status LIMIT 1";
        $query = DB::query(Database::SELECT, $sql)->bind(':id', $id)->param(':status', 1);
        $res = $query->execute()->as_array();
        if($res) return $res[0];
        else false;
    }
    
    public function getListsOfEmployee($employee_id)
    {
        $sql = "SELECT * FROM $this->tableName WHERE `employee_id` = :employee_id AND `status` = :status";
        $query = DB::query(Database::SELECT, $sql)->bind(':employee_id', $employee_id)->param(':status', 1);
        return $query->execute()->as_array();
    }
    
    public function getIdDefaultListOfEmployee($employee_id) 
    {
        $sql = "SELECT `id` FROM $this->tableName WHERE `employee_id` = :employee_id AND `name` = :name AND `status` = :status";
        $query = DB::query(Database::SELECT, $sql)->bind(':employee_id', $employee_id)->param(':name', 'мой список')->param(':status', 1); 
        return $query->execute()->get('id');   
    }
    
    public function getListsDefault()
    {
       $sql = "SELECT * FROM $this->tableName WHERE `employee_id` = :employee_id AND `status` = :status";
       $query = DB::query(Database::SELECT, $sql)->param(':employee_id', '1')->param(':status', 1);
       return $query->execute()->as_array();
    }
    
    public function delete($id)
    {
        $sql = "UPDATE $this->tableName SET `status` = '0' WHERE `id` = :id";
        $query = DB::query(Database::UPDATE, $sql)->bind(':id', $id);
        return $query->execute();
    }
    
    public function update($data)
    {
        $sql = "UPDATE $this->tableName SET  `name` = :name, `rating` = :rating, `description` = :description WHERE `id` = :id";
        $query = DB::query(Database::UPDATE, $sql)->bind(':id', $data['list_id'])->bind(':name', $data['listname'])->bind(':rating', $data['rating'])
                    ->bind(':description', $data['description']);
        return $query->execute();
    }
    
    public function add($employee_id, $name, $rating = 0, $description = '')
    {
        $sql = "INSERT INTO $this->tableName (name, rating, employee_id, description) VALUES (:name, :rating, :employee_id, :description)";
        $query = DB::query(Database::INSERT, $sql)->bind(':name', $name)->bind(':rating', $rating)->bind(':employee_id', $employee_id)
                            ->bind(':description', $description);
        return $query->execute();
    }
}