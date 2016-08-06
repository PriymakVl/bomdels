<?php defined('SYSPATH') or die('No direct script access.');

class Model_ElectUserList extends Model {
    
    private $tableName = 'elect_user_lists';
    
    public function getAll() {
        $sql = "SELECT * FROM $this->tableName WHERE `status` = :status";
        $query = DB::query(Database::SELECT, $sql)->param(':status', 1);
        return $query->execute()->as_array();
    }
    //get id list elect for create auto create object list
    public function getListIds($user_id)
    {
        $sql = "SELECT `list_id` as 'id' FROM $this->tableName WHERE `user_id` = :user_id AND `status` = :status";
        $query = DB::query(Database::SELECT, $sql)->bind(':user_id', $user_id)->param(':status', 1);
        return $query->execute()->as_array();
    }
    
    public function getListsOfEmployee($user_id)
    {
        $sql = "SELECT * FROM $this->tableName WHERE `user_id` = :user_id AND `status` = :status";
        $query = DB::query(Database::SELECT, $sql)->bind(':user_id', $user_id)->param(':status', 1);
        return $query->execute()->as_array();
    }
    
    public function getDefoltListIds()
    {
        $sql = "SELECT `list_id` as 'id' FROM $this->tableName WHERE `user_id` = '1' AND `status` = :status";
        $query = DB::query(Database::SELECT, $sql)->bind(':user_id', $user_id)->param(':status', 1);
        return $query->execute()->as_array();
    }
    
    public function delete($list_id)
    {
        $sql = "UPDATE $this->tableName SET `status` = '0' WHERE `list_id` = :list_id";
        $query = DB::query(Database::UPDATE, $sql)->bind(':list_id', $list_id);
        return $query->execute();
    }
    
    public function add($user_id, $list_id)
    {
        $sql = "INSERT INTO $this->tableName (user_id, list_id) VALUES (:user_id, :list_id)";
        $query = DB::query(Database::INSERT, $sql)->bind(':user_id', $user_id)->bind(':list_id', $list_id);
        return $query->execute();
    }
}