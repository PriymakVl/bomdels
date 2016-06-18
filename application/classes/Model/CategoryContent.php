<?php defined('SYSPATH') or die('No direct script access.');

class Model_CategoryContent extends Model {
    
    private $tableName = 'category_content';
    
    public function getAll() {
        $sql = "SELECT * FROM $this->tableName WHERE `status` = :status";
        $query = DB::query(Database::SELECT, $sql)->param(':status', 1);
        return $query->execute()->as_array();
    }
    
    public function getContentByCatId($cat_id)
    {
       $sql = "SELECT * FROM $this->tableName WHERE `cat_id` = :cat_id AND `status` = :status";
       $query = DB::query(Database::SELECT, $sql)->bind(':cat_id', $cat_id)->param(':status', 1);
       $res = $query->execute()->as_array();
       return $res;
    }
    
    public function getCodeDetailsByCatId($cat_id)
    {
       $sql = "SELECT `code` FROM $this->tableName WHERE `cat_id` = :cat_id AND `status` = :status";
       $query = DB::query(Database::SELECT, $sql)->bind(':cat_id', $cat_id)->param(':status', 1);
       $res = $query->execute()->as_array();
       return $res;
    }
    
    public function delete($data)
    {
        $sql = "UPDATE $this->tableName SET `status` = '0' WHERE `cat_id` = :cat_id AND `code` = :code";
        $query = DB::query(Database::UPDATE, $sql)->bind(':cat_id', $data['cat_id'])->bind(':code', $data['code']);
        return $query->execute();
    }
    
    public function update($data)
    {
        $sql = "UPDATE $this->tableName SET  `code` = :code_new WHERE `cat_id` = :cat_id AND `code` = :code LIMIT 1";
        $query = DB::query(Database::UPDATE, $sql)->bind(':cat_id', $data['cat_id'])->bind(':code', $data['code'])->bind(':code_new', $data['code_new']);
        return $query->execute();
    }
    
    public function add($data)
    {
        $sql = "INSERT INTO $this->tableName (cat_id, code) VALUES (:cat_id, :code)";
        $query = DB::query(Database::INSERT, $sql)->bind(':cat_id', $data['cat_id'])->bind(':code', $data['code']);
        return $query->execute();
    }
}