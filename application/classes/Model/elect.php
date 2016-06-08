<?php defined('SYSPATH') or die('No direct script access.');

class Model_Elect extends Model {
    
    private $tableName = 'elect';
    
    public function getDefaultElect($list_id)
    {
        if(!$list_id) $list_id = 1;
        $sql = "SELECT * FROM $this->tableName WHERE `employee_id` = :employee_id AND `status` = :status AND `list_id` = :list_id ORDER BY `rating` DESC";
        $query = DB::query(Database::SELECT, $sql)->param(':employee_id', '1')->bind(':list_id', $list_id)->param(':status', 1);
        return $query->execute()->as_array();
    }
    
    public function getEmployeeElect($employee_id, $list_id)
    {
       $sql = "SELECT * FROM $this->tableName WHERE `employee_id` = :employee_id AND `status` = :status AND `list_id` = :list_id ORDER BY `rating` DESC";
       $query = DB::query(Database::SELECT, $sql)->param(':employee_id', $employee_id)->bind(':list_id', $list_id)->param(':status', 1);
       return $query->execute()->as_array();
    }

    
    public function add($employee_id, $elem_id, $kind, $list_id)
    {
       $sql = "INSERT INTO $this->tableName (`employee_id`, `elem_id`, `kind`, `list_id`) VALUES (:employee_id, :elem_id, :kind, :list_id)";
       $query = DB::query(Database::INSERT, $sql)->bind(':employee_id', $employee_id)->bind(':elem_id', $elem_id)->bind(':kind', $kind)->bind(':list_id', $list_id);
       return $query->execute();
    }
    
    public function delete($id)
    {
       $sql = "UPDATE $this->tableName SET `status` = :status WHERE `id` = :id";
       $query = DB::query(Database::UPDATE, $sql)->bind(':id', $id)->param(':status', 0);
       return $query->execute();
    }
    
}