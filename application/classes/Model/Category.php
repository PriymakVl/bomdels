<?php defined('SYSPATH') or die('No direct script access.');

class Model_Category extends Model {
    
    private $tableName = 'categories';
    
    public function getAll() {
        $sql = "SELECT * FROM $this->tableName WHERE `status` = :status";
        $query = DB::query(Database::SELECT, $sql)->param(':status', 1);
        return $query->execute()->as_array();
    }
    
    public function getCategoryById($id)
    {
       $sql = "SELECT * FROM $this->tableName WHERE `id` = :id AND `status` = :status";
       $query = DB::query(Database::SELECT, $sql)->bind(':id', $id)->param(':status', 1);
       $res = $query->execute()->as_array();
       if(empty($res)) return false;
       return $res[0];
    }
    
    public function getMainCategories($equipment) 
    {
        $sql = "SELECT * FROM $this->tableName WHERE `equipment` = :equipment AND `status` = :status AND `parent_id` = :parent_id ORDER BY `rating` DESC";
        $query = DB::query(Database::SELECT, $sql)->bind(':equipment', $equipment)->param(':status', 1)->param(':parent_id', 0); 
        $res = $query->execute()->as_array();
        return $res;        
    }
    
    public function getCategoriesByParentId($parent_id)
    {
        $sql = "SELECT * FROM $this->tableName WHERE `parent_id` = :parent_id AND `status` = :status ORDER BY `rating` DESC";
        $res = DB::query(Database::SELECT, $sql)->bind(':parent_id', $parent_id)->param(':status', 1);
        return $res->execute()->as_array();
    }
    
    public function getIdSubCategoriesByParentId($parent_id) {
        $sql = "SELECT `id` FROM $this->tableName WHERE `parent_id` = :parent_id AND `status` = :status ORDER BY `rating` DESC";
        $res = DB::query(Database::SELECT, $sql)->bind(':parent_id', $parent_id)->param(':status', 1);
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
        $sql = "UPDATE $this->tableName SET  `title` = :title, `rating` = :rating, `alias` = :alias WHERE `id` = :id";
        $query = DB::query(Database::UPDATE, $sql)->bind(':id', $data['id'])->bind(':title', $data['title'])
                                            ->bind(':rating', $data['rating'])->bind(':alias', $data['alias']);
        return $query->execute();
    }
    
    public function add($data)
    {
        $sql = "INSERT INTO $this->tableName (title, rating, parent_id, equipment, alias) VALUES (:title, :rating, :parent_id, :equipment, :alias)";
        $query = DB::query(Database::INSERT, $sql)->bind(':title', $data['title'])->bind(':rating', $data['rating'])->bind(':alias', $data['alias'])
                ->bind(':parent_id', $data['parent_id'])->bind(':equipment', $data['equipment']);
        return $query->execute();
    }
}