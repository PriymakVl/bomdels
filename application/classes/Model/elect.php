<?php defined('SYSPATH') or die('No direct script access.');

class Model_Elect extends Model {
    
    private $tableName = 'elect';
    
    public function get($user_id)
    {
       $sql = "SELECT * FROM $this->tableName WHERE `user_id` = :user_id ORDER BY `rating` DESC";
       $query = DB::query(Database::SELECT, $sql)->bind(':user_id', $user_id);
       return $query->execute()->as_array();
    }
    
}