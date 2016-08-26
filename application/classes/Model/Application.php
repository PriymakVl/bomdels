<?php defined('SYSPATH') or die('No direct script access.');

class Model_Application extends Model {
    
    private $tableName = 'applications';
    
    public function getAll($year, $service, $department) {
        if($department == 'all') $sql = "SELECT * FROM $this->tableName WHERE `year` = :year AND `service` = :service AND `status` = :status ORDER BY `number_ens` ASC";
        else $sql = "SELECT * FROM $this->tableName WHERE `year` = :year AND `service` = :service AND `department` = :department AND `status` = :status  ORDER BY `number_ens` ASC";
        $query = DB::query(Database::SELECT, $sql)->param(':status', 1)->bind(':year', $year)->bind(':service', $service)->bind(':department', $department);
        return $query->execute()->as_array();
    }
    
      public function getIds() {
        $sql = "SELECT `id` FROM $this->tableName WHERE `status` = :status ORDER BY `number_ens` DESC";
        $query = DB::query(Database::SELECT, $sql)->param(':status', 1);
        return $query->execute()->as_array();
    }
    
    public function checkIsApplication($number_ens, $year) {
        $sql = "SELECT * FROM $this->tableName WHERE `number_ens` = :number_ens AND `year` = :year AND `status` = :status LIMIT 1";
        $query = DB::query(Database::SELECT, $sql)->bind(':number_ens', $number_ens)->bind(':year', $year)->param(':status', 1);
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
        $sql = "SELECT * FROM $this->tableName WHERE `equipment` = :equipment AND `status` = :status ORDER BY `number_ens` DESC";
        $query = DB::query(Database::SELECT, $sql)->bind(':equipment', $equipment)->param(':status', 1); 
        $res = $query->execute()->as_array();    
        return $res;    
    }
    
    public function getApplicationByService($service) 
    {
        $sql = "SELECT * FROM $this->tableName WHERE `service` = :servive AND `status` = :status ORDER BY `number_ens` DESC";
        $query = DB::query(Database::SELECT, $sql)->bind(':service', $service)->param(':status', 1); 
        $res = $query->execute()->as_array(); 
        return $res;     
    }
    
    public function getApplicationByNumber($number) 
    {
        $sql = "SELECT * FROM $this->tableName WHERE `number` = :number AND `status` = :status ORDER BY `number_ens` DESC";
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
        $sql = "UPDATE $this->tableName SET  `service` = :service, `year` = :year, `title` = :title, `type_repair` = :type_repair, `number_ens` = :number_ens,  
            `outbound` = :outbound, `status` = :status, `equipment` = :equipment, `department` = :department, `executor` = :executor, `customer` = :customer,
            `created` = :created, `period` = :period, `date` = :date  WHERE `id` = :id";
        $query = DB::query(Database::UPDATE, $sql)->bind(':service', $data['service'])->bind(':year', $data['year'])->bind(':title', $data['title'])->bind(':type_repair', $data['type_repair'])
                ->bind(':number_ens', $data['number_ens'])->bind(':outbound', $data['outbound'])->bind(':status', $data['status'])->bind(':equipment', $data['equipment'])->bind(':department', $data['department'])
                ->bind(':executor', $data['executor'])->bind(':customer', $data['customer'])->bind(':created', $data['created'])->bind(':period', $data['period'])->bind(':date', $data['date'])->bind(':id', $data['app_id']);
        return $query->execute();
    }
    
    public function add($data)
    {
        $sql = "INSERT INTO $this->tableName (title, number_ens, service, department, equipment, created, customer, date, year, type_repair, period, executor, outbound) 
        VALUES (:title, :number_ens, :service, :department, :equipment, :created, :customer, :date, :year, :type_repair, :period, :executor, :outbound)";
        $query = DB::query(Database::INSERT, $sql)->bind(':title', $data['title'])->bind(':number_ens', $data['number_ens'])->bind(':service', $data['service'])
                ->bind(':department', $data['department'])->bind(':equipment', $data['equipment'])->bind(':created', $data['created'])->bind(':customer', $data['customer'])
                ->bind(':date', $data['date'])->bind(':year', $data['year'])->bind(':type_repair', $data['type_repair'])->bind(':period', $data['period'])
                ->bind(':executor', $data['executor'])->bind(':outbound', $data['outbound']);
        $res = $query->execute();
        if($res) return $res[0];
        else return false; 
    }
}