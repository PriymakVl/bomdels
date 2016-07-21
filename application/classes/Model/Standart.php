<?php defined('SYSPATH') or die('No direct script access.');

class Model_Standart extends Model {
    
    private $tableName = 'standarts';
    
     public function getAll()
    {
       $sql = "SELECT * FROM $this->tableName WHERE `status` = :status";
       $query = DB::query(Database::SELECT, $sql)->param(':status', 1);
       return $query->execute()->as_array();
    }
    
    public function getItemByCode($code)
    {
       $sql = "SELECT * FROM $this->tableName WHERE `code` = :code AND `status` = :status LIMIT 1";
       $query = DB::query(Database::SELECT, $sql)->bind(':code', $code)->param(':status', 1);
       return $query->execute()->as_array();
    }
    
    public function getEng($rus)
    {
       $sql = "SELECT * FROM $this->tableName WHERE `rus` = :rus AND `status` = :status LIMIT 1";
       $query = DB::query(Database::SELECT, $sql)->bind(':rus', $rus)->param(':status', 1);
       return $query->execute()->as_array();
    }
    
    public function insert($data)
    {
       $sql = "INSERT INTO $this->tableName (`code`, `eng`, `origin`, `equipment`, `standart`, `standart_value`) VALUES (:code, :eng, :origin, :equipment, :standart, :standart_value)";
       $query = DB::query(Database::INSERT, $sql)->bind(':eng', $data['eng'])->bind(':origin', $data['origin'])->bind(':equipment', $data['equipment'])->bind(':standart', $data['standart'])
                ->bind(':standart_value', $data['standart_value'])->bind(':code', $data['code']);
       return $query->execute();
    }
    
    
    public function delete($id)
    {
        $sql = "UPDATE $this->tableName SET `status` = '0' WHERE `id` = :id";
        $query = DB::query(Database::UPDATE, $sql)->bind(':id', $id);
        return $query->execute();
    }
    
    public function getDataByType($type)
    {
        $sql = "SELECT * FROM $this->tableName WHERE `status` = :status AND `type` = :type ORDER BY `eng`";
        $query = DB::query(Database::SELECT, $sql)->param(':status', 1)->bind(':type', $type);
        return $query->execute()->as_array();    
    }
    
}