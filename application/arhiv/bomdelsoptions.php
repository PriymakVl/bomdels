<?php defined('SYSPATH') or die('No direct script access.');

class Model_DrawOptions extends Model {
    
    private $tableName = 'draw_options';
    
    public function getOptionsByIdDraw($id)
    {
       $sql = "SELECT * FROM ".$this->tableName." WHERE `id` = :id";
       //return DB::select('*')->from('words')->limit($limit)->execute('alternate');
       $query = DB::query(Database::SELECT, $sql)->bind(':id', $id);
       $res = $query->execute()->as_array();
       return $res[0];
    }
    
      public function add($draw_id, $data)
    {     
        $sql = "INSERT INTO ".$this->tableName." (member, sheet, sheets, size, assembly, weight, quantity, total, mu, costruction,          draw_id) VALUES (:member, :sheet, :sheets, :size, :assembly, :weight, :quantity, :total, :mu, :construction, :draw_id)";
        $query = DB::query(Database::INSERT, $sql);
        $query->bind(':member', $data['Member'])->bind(':sheet', $data['Sheet'])->bind(':sheets', $data['Sheets']);
        $query->bind(':size', $data['Size'])->bind(':assembly', $data['Assembly'])->bind(':weight', $data['Weight']);
        $query->bind(':quantity', $data['Quantity'])->bind(':total', $data['Total'])->bind(':mu', $data['MU']);
        $query->bind(':construction', $data['Costruction'])->bind(':draw_id', $draw_id);
        $res = $query->execute();
        return $res[0];
    }
    
    public function delete($draw_id)
    {
        $sql = "UPDATE ".$this->tableName."SET `status` = '0' WHERE `id` = :id";
        $query = DB::query(Database::UPDATE, $sql)->bind(':id', $id);
        return $query->execute();
    }
    
    public function update($draw_id, $data)
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