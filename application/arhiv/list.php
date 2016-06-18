<?php defined('SYSPATH') or die('No direct script access.');

class Model_List extends Model {
    
    private $tableName = 'list';
    
    public function getDetailById($id)
    {
       $sql = "SELECT * FROM ".$this->tableName." WHERE `id` = :id";
       //return DB::select('*')->from('words')->limit($limit)->execute('alternate');
       $query = DB::query(Database::SELECT, $sql)->bind(':id', $id);
       $res = $query->execute()->as_array();
       return $res[0];
    }
    
    public function getDrawsByParentId($id)
    {
       $sql = "SELECT * FROM ".$this->tableName." WHERE `parent_id` = :id";
       $res = DB::query(Database::SELECT, $sql)->bind(':id', $id);
       return $res->execute()->as_array();
    }
    
    public function getMain()
    {
        $parent = 0;
        $sql = "SELECT * FROM ".$this->tableName." WHERE `parent_id` = :parent";
        $res = DB::query(Database::SELECT, $sql)->bind(':parent', $parent);
        return $res->execute()->as_array();
    }
    
    public function add($data)
    {
        $data['parent_id'] = 1;
        $data['note'] = 'note drawing';
        $data['rating'] = 4;
        $data['type'] = 1;
        $data['category'] = 1;
        
        $sql = "INSERT INTO ".$this->tableName." (image, code, variant, eng, rus, cat_id, item, parent_id, parent_code, type, note, rating) 
        VALUES (:image, :code, :variant, :eng, :rus, :cat, :item, :parent_id, :parent_code, :type, :note, :rating)";
        $query = DB::query(Database::INSERT, $sql);
        $query->bind(':code', $data['code'])->bind(':eng', $data['Title'])->bind(':image', $data['image']);
        $query->bind(':cat', $data['category'])->bind(':rus', $data['Title'])->bind(':item', $data['Item']);
        $query->bind(':type', $data['type'])->bind(':variant', $data['variant'])->bind(':rating', $data['rating']);
        $query->bind(':parent_code', $data['Owner'])->bind(':parent_id', $data['parent_id'])->bind(':note', $data['note']);
        $res = $query->execute();
        return $res[0];
    }
    
    public function delete($id)
    {
        $sql = "UPDATE ".$this->tableName."SET `status` = '0' WHERE `id` = :id";
        $query = DB::query(Database::UPDATE, $sql)->bind(':id', $id);
        return $query->execute();
    }
    
    public function update($data)
    {
        $sql = "UPDATE ".$this->tableName."SET `code` = :code, `eng` = :eng, `rus` = :rus, `image` = :image,
        `cat_id` = :cat, `type` = :type, `item` = :item, `code_parent` = :code_parent, `sheets` = :sheets, `note` = :note,
         WHERE `id` = :id";
        $query = DB::query(Database::UPDATE, $sql)->bind(':id', $data['id'])->bind(':item', $data['item']);
        $query->bind(':code', $data['code'])->bind(':eng', $data['eng'])->bind(':image', $data['image']);
        $query->bind(':cat', $data['category'])->bind(':rus', $data['rus'])->type(':type', $data['type']);
        $query->bind(':code_parent', $data['code_parent'])->bind(':sheets', $data['sheets'])->bind(':note', $data['note']);
        return $query->execute();
    }
}