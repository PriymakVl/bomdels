<?php defined('SYSPATH') or die('No direct script access.');

class Model_ApplicationEns extends Model {
    
    private $tableName = 'applications_ens';
    
    public function getAll() {
        $sql = "SELECT * FROM $this->tableName WHERE `status` = :status ORDER BY `ens` DESC";
        $query = DB::query(Database::SELECT, $sql)->param(':status', 1);
        return $query->execute()->as_array();
    }
    
      public function getIds() {
        $sql = "SELECT `id` FROM $this->tableName WHERE `status` = :status ORDER BY `ens` DESC";
        $query = DB::query(Database::SELECT, $sql)->param(':status', 1);
        return $query->execute()->as_array();
    }
    
    public function getGoodById($id)
    {
       $sql = "SELECT * FROM $this->tableName WHERE `id` = :id AND `status` = :status LIMIT 1";
       $query = DB::query(Database::SELECT, $sql)->bind(':id', $id)->param(':status', 1);
       $res = $query->execute()->as_array();
       if(empty($res)) return false;
       return $res[0];
    }
    
    public function getGoodByEquipment($equipment) 
    {
        $sql = "SELECT * FROM $this->tableName WHERE `equipment` = :equipment AND `status` = :status ORDER BY `ens` DESC";
        $query = DB::query(Database::SELECT, $sql)->bind(':equipment', $equipment)->param(':status', 1); 
        $res = $query->execute()->as_array();    
        return $res;    
    }
    
    public function getGoodByEns($ens) 
    {
        $sql = "SELECT * FROM $this->tableName WHERE `ens` = :ens AND `status` = :status ORDER BY `number` DESC";
        $query = DB::query(Database::SELECT, $sql)->bind(':ens', $ens)->param(':status', 1); 
        $res = $query->execute()->as_array(); 
        return $res;     
    }
    
    public function getGoodByCode($code) 
    {
        $sql = "SELECT * FROM $this->tableName WHERE `code` = :code AND `status` = :status LIMIT 1";
        $query = DB::query(Database::SELECT, $sql)->bind(':code', $code)->param(':status', 1); 
        $res = $query->execute()->as_array();
        return $res;      
    }
    
    public function getGoodByCustomer($customer) 
    {
        $sql = "SELECT * FROM $this->tableName WHERE `customer` = :customer AND `status` = :status LIMIT 1";
        $query = DB::query(Database::SELECT, $sql)->bind(':customer', $customer)->param(':status', 1); 
        $res = $query->execute()->as_array();
        return $res;      
    }

    
    public function delete($id)
    {
        $sql = "UPDATE $this->tableName SET `status` = '0' WHERE `id` = :id";
        $query = DB::query(Database::UPDATE, $sql)->bind(':id', $id);
        return $query->execute();
    }
    
//    public function update($data)
//    {
//        $sql = "UPDATE $this->tableName SET  `title` = :title, `number` = :number, `node` = :node, `responsible` = :responsible WHERE `id` = :id";
//        $query = DB::query(Database::UPDATE, $sql)->bind(':id', $data['id'])->bind(':title', $data['title'])->bind(':node', $data['node'])
//                                ->bind(':responsible', $data['responsible'])->bind(':date', $data['date'])->bind(':weight', $data['weight']);
//        return $query->execute();
//    }
    
    public function add($data)
    {
        $sql = "INSERT INTO $this->tableName (ens, code, name, price, units, need, department, equipment,  created, customer, executor) 
        VALUES (:ens, :code, :name, :price, :units, :need, :department, :equipment, :created, :customer, :executor)";
        $query = DB::query(Database::INSERT, $sql)->bind(':ens', $data['ens'])->bind(':code', $data['code'])->bind(':name', $data['name'])->bind(':price', $data['price'])
                ->bind(':units', $data['units'])->bind(':need', $data['need'])->bind(':department', $data['department'])->bind(':equipment', $data['equipment'])
                ->bind(':created', $data['created'])->bind(':customer', $data['customer'])->bind(':executor', $data['executor']); 
        $res = $query->execute();
        if($res) return $res[0];
        else return false; 
    }
}