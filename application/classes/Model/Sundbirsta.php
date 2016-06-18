<?php defined('SYSPATH') or die('No direct script access.');

class Model_Sundbirsta extends Model_Detail {
    
    public function __construct()
    {
        $this->tableName = 'sundbirsta';
    }
    
    public function addAutoSun($data, $parent_code, $cat_id = 4)
    {
        $sql = "INSERT INTO $this->tableName (qty, code, rus, item, cat_id, parent_code, weight) VALUES (:qty, :code, :rus, :item, :cat_id, :parent_code, :weight)";
        $query = DB::query(Database::INSERT, $sql)->bind(':code', $data['code'])->bind(':qty', $data['qty'])
                ->bind(':cat_id', $cat_id)->bind(':rus', $data['rus'])->bind(':item', $data['item'])
                ->bind(':parent_code', $parent_code)->bind(':weight', $data['weight']);
        return $query->execute();
    }
}