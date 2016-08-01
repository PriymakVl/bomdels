<?php defined('SYSPATH') or die('No direct script access.');

class Model_ElectEmployeeList extends Model {
    
    private $tableName = 'elect_employees_lists';
    
    public function getAll() {
        $sql = "SELECT * FROM $this->tableName WHERE `status` = :status";
        $query = DB::query(Database::SELECT, $sql)->param(':status', 1);
        return $query->execute()->as_array();
    }
    //get id list elect for create auto create object list
    public function getListIds($employee_id)
    {
        $sql = "SELECT `list_id` as 'id' FROM $this->tableName WHERE `employee_id` = :employee_id AND `status` = :status";
        $query = DB::query(Database::SELECT, $sql)->bind(':employee_id', $employee_id)->param(':status', 1);
        return $query->execute()->as_array();
    }
    
    public function getListsOfEmployee($employee_id)
    {
        $sql = "SELECT * FROM $this->tableName WHERE `employee_id` = :employee_id AND `status` = :status";
        $query = DB::query(Database::SELECT, $sql)->bind(':employee_id', $employee_id)->param(':status', 1);
        return $query->execute()->as_array();
    }
    
    public function getDefoltListIds()
    {
        $sql = "SELECT `list_id` as 'id' FROM $this->tableName WHERE `employee_id` = '1' AND `status` = :status";
        $query = DB::query(Database::SELECT, $sql)->bind(':employee_id', $employee_id)->param(':status', 1);
        return $query->execute()->as_array();
    }
    
    public function delete($list_id)
    {
        $sql = "UPDATE $this->tableName SET `status` = '0' WHERE `list_id` = :list_id";
        $query = DB::query(Database::UPDATE, $sql)->bind(':list_id', $list_id);
        return $query->execute();
    }
    
    public function add($employee_id, $list_id)
    {
        $sql = "INSERT INTO $this->tableName (employee_id, list_id) VALUES (:employee_id, :list_id)";
        $query = DB::query(Database::INSERT, $sql)->bind(':employee_id', $employee_id)->bind(':list_id', $list_id);
        return $query->execute();
    }
}