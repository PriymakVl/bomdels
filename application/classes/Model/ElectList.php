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
    
    public function getListsOfUser($user_id)
    {
        $sql = "SELECT * FROM $this->tableName WHERE `user_id` = :user_id AND `status` = :status";
        $query = DB::query(Database::SELECT, $sql)->bind(':user_id', $user_id)->param(':status', 1);
        return $query->execute()->as_array();
    }
    
    public function sort($type) 
    {
        $sql = "SELECT * FROM $this->tableName WHERE `type` = :type AND `status` = :status";
        $query = DB::query(Database::SELECT, $sql)->bind(':user_id', $user_id)->bind(':type', $type)->param(':status', 1); 
        return $query->execute()->as_array();   
    }
//    
//    public function getListsDefault()
//    {
//       $sql = "SELECT * FROM $this->tableName WHERE `employee_id` = :employee_id AND `status` = :status";
//       $query = DB::query(Database::SELECT, $sql)->param(':employee_id', '1')->param(':status', 1);
//       return $query->execute()->as_array();
//    }

    public function checkListIsUser($user_id, $list_id) 
    {
        $sql = "SELECT * FROM $this->tableName WHERE `user_id` = :user_id AND `id` = :list_id LIMIT 1";
        $query = DB::query(Database::SELECT, $sql)->bind(':user_id', $user_id)->bind(':list_id', $list_id);
        $res = $query->execute()->as_array();
        if($res) return true;
        else return false;    
    }
    
    public function delete($id)
    {
        $sql = "UPDATE $this->tableName SET `status` = '0' WHERE `id` = :id";
        $query = DB::query(Database::UPDATE, $sql)->bind(':id', $id);
        return $query->execute();
    }
    
    public function update($data)
    {
        $sql = "UPDATE $this->tableName SET  `name` = :name, `rating` = :rating, `description` = :description, `type` = :type WHERE `id` = :id";
        $query = DB::query(Database::UPDATE, $sql)->bind(':id', $data['list_id'])->bind(':name', $data['listname'])->bind(':rating', $data['rating'])
                    ->bind(':description', $data['description'])->bind(':type', $data['typelist']);
        return $query->execute();
    }
    
    public function add($user_id, $data)
    {
        $data['rating'] = $data['rating'] ? $data['rating'] : 0;
        $sql = "INSERT INTO $this->tableName (`name`, `rating`, `user_id`, `description`, `type`) VALUES (:name, :rating, :user_id, :description, :type)";
        $query = DB::query(Database::INSERT, $sql)->bind(':name', $data['listname'])->bind(':rating', $data['rating'])->bind(':user_id', $user_id)
                            ->bind(':description', $data['description'])->bind(':type', $data['typelist']);
        $res = $query->execute();
        if($res) return $res[0];
        else return false;
    }
}