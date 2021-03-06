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
       $sql = "SELECT * FROM $this->tableName WHERE `id` = :id AND `status` = :status LIMIT 1" ;
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
        if($res) return $res[0];
        return false;
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
    
    public function delete($data)
    {
        $sql = "UPDATE $this->tableName SET `status` = '0' WHERE `id` = :id AND `parent_code` = :parent_code";
        $query = DB::query(Database::UPDATE, $sql)->bind(':id', $data['detail_id'])->bind(':parent_code', $data['parent_code']);
        return $query->execute();
    }
    
    public function update($data)
    {
        $sql = "UPDATE $this->tableName SET `parent_code` = :parent, `rus` = :rus, `weight` = :weight, `item` = :item, `qty` = :qty, `material` = :material, `ens` = :ens WHERE `id` = :id";
        $query = DB::query(Database::UPDATE, $sql)->bind(':id', $data['id'])->bind(':rus', $data['rus'])->bind(':weight', $data['weight'])->bind(':parent', $data['parent'])
                    ->bind(':qty', $data['qty'])->bind(':material', $data['material'])->bind(':variant', $data['variant'])->bind(':ens', $data['ens'])->bind(':item', $data['item']);
        return $query->execute();
    }
    
    public function addNote($id, $note)
    {
       $sql = "UPDATE $this->tableName SET `note` = :note WHERE `id` = :id";
       $query = DB::query(Database::UPDATE, $sql)->bind(':id', $id)->bind(':note', $note);
       return $query->execute();
    }
    
    public function addDetail($data) {
        $sql = "INSERT INTO $this->tableName (`code`, `rus`) VALUES (:code, :rus)";
        $query = DB::query(Database::INSERT, $sql)->bind(':code', $data['code'])->bind(':rus', $data['rus']);
        $res = $query->execute();
        if($res) return $res[0];
        else return false;
    }
}