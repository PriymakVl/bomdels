<?php defined('SYSPATH') or die('No direct script access.');

class Model_Elect extends Model {
    
    private $tableName = 'elect';
    
    public function get($user_id)
    {
       $sql = "SELECT * FROM $this->tableName WHERE `user_id` = :user_id AND `status` = :status ORDER BY `rating` DESC";
       $query = DB::query(Database::SELECT, $sql)->bind(':user_id', $user_id)->param(':status', 1);
       return $query->execute()->as_array();
    }
    
    public function add($user_id, $detail_id, $equipment)
    {
       $sql = "INSERT INTO $this->tableName (`user_id`, `detail_id`, `equipment`) VALUES (:user_id, :detail_id, :equipment)";
       $query = DB::query(Database::INSERT, $sql)->bind(':user_id', $user_id)->bind(':detail_id', $detail_id)->bind(':equipment', $equipment);
       return $query->execute();
    }
    
    public function delete($user_id, $id)
    {
       $sql = "UPDATE $this->tableName SET `status` = :status WHERE `user_id` = :user_id AND `id` = :id";
       $query = DB::query(Database::UPDATE, $sql)->bind(':user_id', $user_id)->bind(':id', $id)->param(':status', 0);
       return $query->execute();
    }
    
}