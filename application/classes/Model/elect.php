<?php defined('SYSPATH') or die('No direct script access.');

class Model_Elect extends Model {
    
    private $tableName = 'elect';
    
    public function get($list_id)
    {
       $sql = "SELECT * FROM $this->tableName WHERE `list_id` = :list_id AND `status` = :status ORDER BY `rating` DESC";
       $query = DB::query(Database::SELECT, $sql)->bind(':list_id', $list_id)->param(':status', 1);
       return $query->execute()->as_array();
    }
    
    public function add($employee_id, $elem_id, $kind, $list_id, $description)
    {
       $sql = "INSERT INTO $this->tableName (`employee_id`, `elem_id`, `kind`, `list_id`, `description`) VALUES (:employee_id, :elem_id, :kind, :list_id, :description)";
       $query = DB::query(Database::INSERT, $sql)->bind(':employee_id', $employee_id)->bind(':elem_id', $elem_id)
       ->bind(':kind', $kind)->bind(':list_id', $list_id)->bind(':description', $description);
       return $query->execute();
    }
    
    public function delete($id)
    {
        $sql = "UPDATE $this->tableName SET `status` = :status WHERE `id` = :id";
        $query = DB::query(Database::UPDATE, $sql)->bind(':id', $id)->param(':status', 0);
        return $query->execute();
    }
    
    public function deleteAllElementsOfList($list_id)
    {
        $sql = "UPDATE $this->tableName SET `status` = :status WHERE `list_id` = :list_id";
        $query = DB::query(Database::UPDATE, $sql)->bind(':list_id', $list_id)->param(':status', 0);
        return $query->execute();
    }
    
    public function update($data)
    {
        $sql = "UPDATE $this->tableName SET `rating` = :rating, `description` = :description WHERE `id` = :id";
        $query = DB::query(Database::UPDATE, $sql)->bind(':id', $data['elect_id'])->bind(':rating', $data['rating'])->bind(':description', $data['description']);
        return $query->execute();
    }
    
}