<?php defined('SYSPATH') or die('No direct script access.');

class Model_Order extends Model {
    
    private $tableName = 'orders';
    
    public function getAll() {
        $sql = "SELECT * FROM $this->tableName WHERE `status` = :status ORDER BY `number` DESC";
        $query = DB::query(Database::SELECT, $sql)->param(':status', 1);
        return $query->execute()->as_array();
    }
    
      public function getIds() {
        $sql = "SELECT `id` FROM $this->tableName WHERE `status` = :status ORDER BY `number` DESC";
        $query = DB::query(Database::SELECT, $sql)->param(':status', 1);
        return $query->execute()->as_array();
    }
    
    public function getOrderById($id)
    {
       $sql = "SELECT * FROM $this->tableName WHERE `id` = :id AND `status` = :status";
       $query = DB::query(Database::SELECT, $sql)->bind(':id', $id)->param(':status', 1);
       $res = $query->execute()->as_array();
       if(empty($res)) return false;
       return $res[0];
    }
    
    public function getOrderByEquipment($equipment) 
    {
        $sql = "SELECT * FROM $this->tableName WHERE `equipment` = :equipment AND `status` = :status ORDER BY `number` DESC";
        $query = DB::query(Database::SELECT, $sql)->bind(':equipment', $equipment)->param(':status', 1); 
        $res = $query->execute()->as_array();
        if($res) return $res[0]; 
        return false;        
    }
    
    public function getOrderByType($type) 
    {
        $sql = "SELECT * FROM $this->tableName WHERE `type` = :type AND `status` = :status ORDER BY `number` DESC";
        $query = DB::query(Database::SELECT, $sql)->bind(':type', $type)->param(':status', 1); 
        $res = $query->execute()->as_array();
        if($res) return $res[0]; 
        return false;       
    }
    
    public function getOrderByNumber($number) 
    {
        $sql = "SELECT * FROM $this->tableName WHERE `number` = :number AND `status` = :status ORDER BY `number` DESC";
        $query = DB::query(Database::SELECT, $sql)->bind(':number', $number)->param(':status', 1); 
        $res = $query->execute()->as_array();
        if($res) return $res[0]; 
        return false;        
    }
    //fro create of hext number order
    public function getLatestNumberOfOrders($year) 
    {
        $sql = "SELECT Max(number) FROM $this->tableName WHERE `year` = :year AND `status` = :status";
        $query = DB::query(Database::SELECT, $sql)->bind(':year', $year)->param(':status', 1); 
        $res = $query->execute()->as_array();
        if($res) return $res[0]; 
        return false;         
    }
    
    public function delete($id)
    {
        $sql = "UPDATE $this->tableName SET `status` = '0' WHERE `id` = :id";
        $query = DB::query(Database::UPDATE, $sql)->bind(':id', $id);
        return $query->execute();
    }
    
    public function update($data)
    {
        $sql = "UPDATE $this->tableName SET  `title` = :title, `number` = :number, `node` = :node, `responsible` = :responsible WHERE `id` = :id";
        $query = DB::query(Database::UPDATE, $sql)->bind(':id', $data['id'])->bind(':title', $data['title'])->bind(':node', $data['node'])
                                ->bind(':responsible', $data['responsible'])->bind(':date', $data['date'])->bind(':weight', $data['weight']);
        return $query->execute();
    }
    
    public function add($data)
    {
        $sql = "INSERT INTO $this->tableName (title, number, type, equipment, node, date, responsible) VALUES (:title, :number, :type, :equipment, :node, :date, :responsible)";
        $query = DB::query(Database::INSERT, $sql)->bind(':title', $data['title'])->bind(':number', $data['number'])->bind(':type', $data['type'])
                ->bind(':date', $data['date'])->bind(':equipment', $data['equipment'])->bind(':responsible', $data['responsible']);
        return $query->execute();
    }
}