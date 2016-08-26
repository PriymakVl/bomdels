<?php defined('SYSPATH') or die('No direct script access.');

class Model_Crane extends Model_Detail {
    
    public function __construct()
    {
        $this->tableName = 'cranes';
    }
    
//    public function addDetail($data) 
//    {
//        $sql = "INSERT INTO $this->tableName (`code`, `parent_code`, `rus`, `item`, `equipment`) VALUES (:code, :parent, :rus, :item, :equipment)";
//        $query = DB::query(Database::INSERT, $sql)->bind(':code', $data['code'])->bind(':parent', $data['parent'])->bind(':rus', $data['rus'])
//                ->bind(':item', $data['item'])->bind(':equipment', $data['equipment']);
//        $res = $query->execute();
//        if($res) return $res[0];
//        else return false;
//    }
    
}