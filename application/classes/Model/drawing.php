<?php defined('SYSPATH') or die('No direct script access.');

class Model_Drawing extends Model {
    
    private $tableName = 'drawings';
    
    public function get($code)
    {
       $sql = "SELECT *  FROM $this->tableName WHERE `code` = :code AND `status` = :status ORDER BY `rating`";
       $query = DB::query(Database::SELECT, $sql)->bind(':code', $code)->param(':status', 1);
       return $query->execute()->as_array();
    }
    
    public function countDrawOfDetail($code) {
        $sql = "SELECT COUNT(`id`) AS count  FROM $this->tableName WHERE `code` = :code AND `status` = :status";
        $query = DB::query(Database::SELECT, $sql)->bind(':code', $code)->param(':status', 1);
        return $query->execute()->get('count');
    }
    
    public function getDrawingByNameFile($file) {
        $sql = "SELECT *  FROM $this->tableName WHERE `file` = :file AND `status` = :status";
        $query = DB::query(Database::SELECT, $sql)->bind(':file', $file)->param(':status', 1);
        return $query->execute()->as_array();
    }
    
    public function getDrawingById($id) {
        $sql = "SELECT *  FROM $this->tableName WHERE `id` = :id LIMIT 1";
        $query = DB::query(Database::SELECT, $sql)->bind(':id', $id);
        $res = $query->execute()->as_array(); 
        if(!$res) return false;  
        return $res[0];  
    } 
    
    public function add($type, $file, $folder, $code, $detail_id, $equipment) 
    {
        $sql = "INSERT INTO $this->tableName (`type`, `file`, `folder`, `code`, `detail_id`, `equipment`) VALUES (:type, :file, :folder, :code)";
        $query = DB::query(Database::INSERT, $sql)->bind(':code', $code)->bind(':type', $type)->bind(':file', $file)->bind(':folder', $folder)
                            ->bind(':detail_id', $detail_id)->bind(':equipment', $equipment);
        return $query->execute();
    }
    
}