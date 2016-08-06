<?php defined('SYSPATH') or die('No direct script access.');

class Model_Application extends Model {
    
    private $tableName = 'applications';
    
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
    
    public function getApplicationById($id)
    {
       $sql = "SELECT * FROM $this->tableName WHERE `id` = :id AND `status` = :status LIMIT 1";
       $query = DB::query(Database::SELECT, $sql)->bind(':id', $id)->param(':status', 1);
       $res = $query->execute()->as_array();
       if(empty($res)) return false;
       return $res[0];
    }
    
    public function getApplicationByEquipment($equipment) 
    {
        $sql = "SELECT * FROM $this->tableName WHERE `equipment` = :equipment AND `status` = :status ORDER BY `number` DESC";
        $query = DB::query(Database::SELECT, $sql)->bind(':equipment', $equipment)->param(':status', 1); 
        $res = $query->execute()->as_array();    
        return $res;    
    }
    
    public function getApplicationByService($service) 
    {
        $sql = "SELECT * FROM $this->tableName WHERE `service` = :servive AND `status` = :status ORDER BY `number` DESC";
        $query = DB::query(Database::SELECT, $sql)->bind(':service', $service)->param(':status', 1); 
        $res = $query->execute()->as_array(); 
        return $res;     
    }
    
    public function getApplicationByNumber($number) 
    {
        $sql = "SELECT * FROM $this->tableName WHERE `number` = :number AND `status` = :status ORDER BY `number` DESC";
        $query = DB::query(Database::SELECT, $sql)->bind(':number', $number)->param(':status', 1); 
        $res = $query->execute()->as_array();
        return $res;      
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
        $sql = "INSERT INTO $this->tableName (title, number_ens, service, department, equipment, created, customer, date, year, type_repair, period, executor) 
        VALUES (:title, :number_ens, :service, :department, :equipment, :created, :customer, :date, :year, :type_repair, :period, :executor)";
        $query = DB::query(Database::INSERT, $sql)->bind(':title', $data['title'])->bind(':number_ens', $data['number_ens'])->bind(':service', $data['service'])
                ->bind(':department', $data['department'])->bind(':equipment', $data['equipment'])->bind(':created', $data['created'])->bind(':customer', $data['customer'])
                ->bind(':date', $data['date'])->bind(':year', $data['year'])->bind(':type_repair', $data['type_repair'])->bind(':period', $data['period'])
                ->bind(':executor', $data['executor']);
        $res = $query->execute();
        if($res) return $res[0];
        else return false; 
    }
}