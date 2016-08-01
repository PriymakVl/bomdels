<?php defined('SYSPATH') or die('No direct script access.');

class Model_Detail extends Model {
    
    protected $tableName;
    
    public function getAll() {
        $sql = "SELECT * FROM $this->tableName";
        $query = DB::query(Database::SELECT, $sql);
        return $query->execute()->as_array();
    }
    
    public function getDetailById($id)
    {
       $sql = "SELECT * FROM $this->tableName WHERE `id` = :id AND `status` = :status";
       $query = DB::query(Database::SELECT, $sql)->bind(':id', $id)->param(':status', 1);
       $res = $query->execute()->as_array();
       if(empty($res)) return false;
       return $res[0];
    }
    
    public function searchDetailByCode($code) 
    {
        if(!$code) return false;
        $code = "%".$code."%";
        $sql = "SELECT * FROM $this->tableName WHERE `code` LIKE :code";
        $query = DB::query(Database::SELECT, $sql)->bind(':code', $code); 
        return $query->execute()->as_array();
    }
    
    public function getDetailByCode($code) 
    {
        $sql = "SELECT * FROM $this->tableName WHERE `code` = :code LIMIT 1";
        $query = DB::query(Database::SELECT, $sql)->bind(':code', $code); 
        $res = $query->execute()->as_array();
        return $res;
    }
    
    public function getIdSubDetailsByCode($code) 
    {
        $sql = "SELECT `id` FROM $this->tableName WHERE `parent_code` = :code AND `status` = :status ORDER BY `item`";
        $query = DB::query(Database::SELECT, $sql)->bind(':code', $code)->param(':status', 1); 
        $res = $query->execute()->as_array();
        return $res;        
    }
    
    //that do not add file if heirs exist
    public function checkExistDetailsByParentCode($parent_code)
    {
       $sql = "SELECT * FROM $this->tableName WHERE `parent_code` = :parent_code LIMIT 1";
       $res = DB::query(Database::SELECT, $sql)->bind(':parent_code', $parent_code);
       return $res->execute()->as_array();
    }
    
    public function getDetailByType($type)
    {
        $sql = "SELECT * FROM $this->tableName WHERE `type` = :type";
        $res = DB::query(Database::SELECT, $sql)->bind(':type', $type);
        return $res->execute()->as_array();
    }
    
    public function delete($id)
    {
        $sql = "UPDATE $this->tableName SET `status` = '0' WHERE `id` = :id";
        $query = DB::query(Database::UPDATE, $sql)->bind(':id', $id);
        return $query->execute();
    }
    
    public function update($data)
    {
        $sql = "UPDATE $this->tableName SET `rus` = :rus, `weight` = :weight, `qty` = :qty, `material` = :material WHERE `id` = :id";
        $query = DB::query(Database::UPDATE, $sql)->bind(':id', $data['id'])->bind(':rus', $data['rus'])->bind(':weight', $data['weight'])
                    ->bind(':qty', $data['qty'])->bind(':material', $data['material']);
        return $query->execute();
    }
    
    public function addNote($id, $note)
    {
       $sql = "UPDATE $this->tableName SET `note` = :note WHERE `id` = :id";
       $query = DB::query(Database::UPDATE, $sql)->bind(':id', $id)->bind(':note', $note);
       return $query->execute();
    }
}