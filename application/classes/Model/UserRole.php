<?php defined('SYSPATH') OR die('No direct script access.');

class Model_UserRole extends  Model {
    
    private $tableName = 'users_role';
    
    public function get($user_id) 
    {
       $sql = "SELECT `role` FROM $this->tableName WHERE `user_id` = :user_id LIMIT 1";
       $query = DB::query(Database::SELECT, $sql)->bind(':user_id', $user_id);
       $res = $query->execute()->as_array();
       if($res) return $res[0]['role'];
       else false;    
    }
    
    public function set($user_id, $role = 'user') {
        $sql = "INSERT INTO $this->tableName (role, user_id) VALUES (:role, :user_id)";
        $query = DB::query(Database::INSERT, $sql)->bind(':role', $role)->bind(':user_id', $user_id);
        return $query->execute();
    }
}















