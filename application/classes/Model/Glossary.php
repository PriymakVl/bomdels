<?php defined('SYSPATH') or die('No direct script access.');

class Model_Glossary extends Model {
    
    private $tableName = 'glossary';
    
     public function getAll()
    {
       $sql = "SELECT * FROM $this->tableName WHERE `status` = :status";
       $query = DB::query(Database::SELECT, $sql)->param(':status', 1);
       return $query->execute()->as_array();
    }
    
    public function getRus($eng)
    {
       $sql = "SELECT * FROM $this->tableName WHERE `eng` = :eng AND `status` = :status LIMIT 1";
       $query = DB::query(Database::SELECT, $sql)->bind(':eng', $eng)->param(':status', 1);
       return $query->execute()->as_array();
    }
    
    public function getEng($rus)
    {
       $sql = "SELECT * FROM $this->tableName WHERE `rus` = :rus AND `status` = :status LIMIT 1";
       $query = DB::query(Database::SELECT, $sql)->bind(':rus', $rus)->param(':status', 1);
       return $query->execute()->as_array();
    }
    
    public function insert($eng, $rus, $type)
    {
       $sql = "INSERT INTO $this->tableName (`eng`, `rus`, `type`) VALUES (:eng, :rus, :type)";
       $query = DB::query(Database::INSERT, $sql)->bind(':eng', $eng)->bind(':rus', $rus)->bind(':type', $type);
       return $query->execute();
    }
    
    public function addTranslation($eng, $rus)
    {
        $sql = "UPDATE $this->tableName SET `rus` = :rus WHERE `eng` = :eng";
        $query = DB::query(Database::UPDATE, $sql)->bind(':eng', $eng)->bind(':rus', $rus);
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