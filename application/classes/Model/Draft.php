<?php defined('SYSPATH') or die('No direct script access.');

class Model_Draft extends Model_Drawing {
    
    public function __construct()
    {
        $this->tableName = 'drafts';    
    }
    
    public function getLastId()
    {
        $sql = "SELECT MAX(`id`) AS last_id FROM $this->tableName";
        $query = DB::query(Database::SELECT, $sql);
        $res = $query->execute()->as_array();
        if($res) return $res[0]['last_id'];
        else return 0;
    }
    
    public function add($data) 
    {
        $sql = "INSERT INTO $this->tableName (`file`, `code`, `detail_id`, `equipment`, `folder`) VALUES (:file, :code, :detail_id, :equipment, :folder)";
        $query = DB::query(Database::INSERT, $sql)->bind(':code', $data['code'])->bind(':file', $data['file'])
                            ->bind(':detail_id', $data['detail_id'])->bind(':equipment', $data['equipment'])->bind(':folder', $data['folder']);
        return $query->execute();
    }
    
}