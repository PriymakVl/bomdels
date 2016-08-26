<?php defined('SYSPATH') or die('No direct script access.');

class Model_ApplicationContent extends Model {
    
    private $tableName = 'applications_content';
    
    public function getAll() {
        $sql = "SELECT * FROM $this->tableName WHERE `status` = :status";
        $query = DB::query(Database::SELECT, $sql)->param(':status', 1);
        return $query->execute()->as_array();
    }
    
    public function get($id) {
        $sql = "SELECT * FROM $this->tableName WHERE `id` = :id AND `status` = :status LIMIT 1";
        $query = DB::query(Database::SELECT, $sql)->bind(':id', $id)->param(':status', 1);
        $res = $query->execute()->as_array();
        if(!$res) return false;
        else return $res[0];    
    }
    
    public function getItemApplication($app_id, $product_id)
    {
       $sql = "SELECT * FROM $this->tableName WHERE `app_id` = :app_id AND `product_id` = :product_id AND `status` = :status LIMIT 1";
       $query = DB::query(Database::SELECT, $sql)->bind(':app_id', $app_id)->bind(':product_id', $product_id)->param(':status', 1);
       $res = $query->execute()->as_array();
       if(!$res) return false;
       else return $res[0];
    }
    
    public function getContentOfApplication($app_id)
    {
       $sql = "SELECT * FROM $this->tableName WHERE `app_id` = :app_id AND `status` = :status";
       $query = DB::query(Database::SELECT, $sql)->bind(':app_id', $app_id)->param(':status', 1);
       return $query->execute()->as_array();
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
    
    public function add($app_id, $product_id, $data)
    {
        $sql = "INSERT INTO $this->tableName (app_id, product_id, need, price)  VALUES (:app_id, :product_id, :need, :price)";
        $query = DB::query(Database::INSERT, $sql)->bind(':app_id', $app_id)->bind(':product_id', $product_id)->bind(':need', $data['need'])->bind(':price', $data['price']); 
        return $query->execute();
    }
}