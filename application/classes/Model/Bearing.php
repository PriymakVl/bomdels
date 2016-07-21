<?php defined('SYSPATH') or die('No direct script access.');

class Model_Bearing extends Model {
    
    private $tableName = 'bearings';
    
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
    
//    public function insert($data)
//    {
//       $sql = "INSERT INTO $this->tableName (`code`, `outside_diam`, `inner_diam`, `thickness`, `equipment`, `origin`) VALUES (:code, :outside_diam, :inner_diam, :thickness, :equipment, :origin)";
//       $query = DB::query(Database::INSERT, $sql)->bind(':origin', $data['eng'])->bind(':equipment', $data['equipment'])->bind(':outside_diam', $data['outside_diam'])
//                ->bind(':inner_diam', $data['inner_diam'])->bind(':code', $data['code'])->bind(':thickness', $data['thickness']);
//       return $query->execute();
//    }
    
    public function insert($data)
    {
       $sql = "INSERT INTO $this->tableName (`code`, `origin`) VALUES (:code, :origin)";
       $query = DB::query(Database::INSERT, $sql)->bind(':origin', $data['eng'])->bind(':code', $data['code']);           
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