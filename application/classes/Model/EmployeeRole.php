<?php defined('SYSPATH') OR die('No direct script access.');

class Model_EmployeeRole extends  Model {
    
    private $tableName = 'employees_roles';
    
    public function get($employee_id) 
    {
       $sql = "SELECT `role` FROM $this->tableName WHERE `employee_id` = :employee_id LIMIT 1";
       $query = DB::query(Database::SELECT, $sql)->bind(':employee_id', $employee_id);
       $res = $query->execute()->as_array();
       if($res) return $res[0]['role'];
       else false;    
    }
    
    public function set($employee_id, $role = 'employee') {
        $sql = "INSERT INTO $this->tableName (role, employee_id) VALUES (:role, :employee_id)";
        $query = DB::query(Database::INSERT, $sql)->bind(':role', $role)->bind(':employee_id', $employee_id);
        return $query->execute();
    }
}















