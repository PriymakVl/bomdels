<?php defined('SYSPATH') or die('No direct script access.');

class Model_Drawing extends Model {
    
    private $tableName = 'drawings';
    
    public function getAll($limit = '') {
        if($limit) $limit = ' LIMIT '.$limit;
        $sql = "SELECT *  FROM $this->tableName".$limit;
        $query = DB::query(Database::SELECT, $sql);
        return $query->execute()->as_array();    
    }
    
    public function get($code)
    {
       $sql = "SELECT *  FROM $this->tableName WHERE `code` = :code AND `status` = :status ORDER BY `rating`";
       $query = DB::query(Database::SELECT, $sql)->bind(':code', $code)->param(':status', 1);
       return $query->execute()->as_array();
    }
    
    public function countDrawOfDetail($code) {
        $sql = "SELECT COUNT(`id`) AS count  FROM $this->tableName WHERE `code` = :code AND `status` = :status";
        $query = DB::query(Database::SELECT, $sql)->bind(':code', $code)->param(':status', 1);
        return $query->execute()->get('count');
    }
    
    public function getDrawingByNameFile($file) {
        $sql = "SELECT *  FROM $this->tableName WHERE `file` = :file AND `status` = :status";
        $query = DB::query(Database::SELECT, $sql)->bind(':file', $file)->param(':status', 1);
        return $query->execute()->as_array();
    }
    
    public function getDrawingById($id) {
        $sql = "SELECT *  FROM $this->tableName WHERE `id` = :id LIMIT 1";
        $query = DB::query(Database::SELECT, $sql)->bind(':id', $id);
        $res = $query->execute()->as_array(); 
        if(!$res) return false;  
        return $res[0];  
    } 
    
    public function add($data, $folder) 
    {
        $sql = "INSERT INTO $this->tableName (`type`, `file`, `code`, `detail_id`, `equipment`, `folder`) VALUES (:type, :file, :code, :detail_id, :equipment, :folder)";
        $query = DB::query(Database::INSERT, $sql)->bind(':code', $data['code'])->bind(':type', $data['type'])->bind(':file', $data['file'])
                            ->bind(':detail_id', $data['detail_id'])->bind(':equipment', $data['equipment'])->bind(':folder', $folder);
        return $query->execute();
    }
    
     public function addDanieli($data, $detail_id) 
    {
        $sql = "INSERT INTO $this->tableName (`type`, `file`, `code`, `detail_id`, `equipment`, `sheet`, `sheets`, `size`, `folder`)
                         VALUES (:type, :file, :code, :detail_id, :equipment, :sheet, :sheets, :size, :folder)";
        $query = DB::query(Database::INSERT, $sql)->bind(':code', $data['Member'])->param(':type', 'производитель')
                            ->bind(':file', $data['file'])->param(':folder', 'tif')->bind(':size', $data['size'])
                            ->bind(':detail_id', $detail_id)->param(':equipment', 'danieli')->bind(':sheet', $data['sheet'])->bind(':sheets', $data['sheets']);
        return $query->execute();
    }
    
    public function delete($id)
    {
       $sql = "UPDATE $this->tableName SET `status` = :status WHERE `id` = :id";
       $query = DB::query(Database::UPDATE, $sql)->bind(':id', $id)->param(':status', 0);
       return $query->execute();
    }
    
    public function addNote($id, $note)
    {
       $sql = "UPDATE $this->tableName SET `note` = :note WHERE `id` = :id";
       $query = DB::query(Database::UPDATE, $sql)->bind(':id', $id)->bind(':note', $note);
       return $query->execute();
    }
    
    public function editFile($id, $file)
    {
       $sql = "UPDATE $this->tableName SET `file` = :file WHERE `id` = :id";
       $query = DB::query(Database::UPDATE, $sql)->bind(':id', $id)->bind(':file', $file);
       return $query->execute();
    }
    
      public function editCode($id, $code)
    {
       $sql = "UPDATE $this->tableName SET `code` = :code WHERE `id` = :id";
       $query = DB::query(Database::UPDATE, $sql)->bind(':id', $id)->bind(':code', $code);
       return $query->execute();
    }
    
    
    
}