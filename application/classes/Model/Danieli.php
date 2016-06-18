<?php defined('SYSPATH') or die('No direct script access.');

class Model_Danieli extends Model_Detail {
    
    public function __construct()
    {
        $this->tableName = 'danieli';
    }
    
    public function addAutoDanieli($data, $cat_id = 2)
    {
        $sql = "INSERT INTO $this->tableName (qty, code, eng, rus, item, variant, parent_code, weight, type) VALUES (:qty, :code, :eng, :rus, :item, :variant, :parent_code, :weight, :type)";
        $query = DB::query(Database::INSERT, $sql)->bind(':code', $data['code'])->bind(':qty', $data['qty'])->bind(':variant', $data['variant'])->param(':rus', '')
                ->bind(':eng', $data['eng'])->bind(':item', $data['item'])->bind('cat_id', $cat_id)->bind(':type', $data['type'])
                ->bind(':parent_code', $data['parent_code'])->bind(':weight', $data['weight']);
        return $query->execute();
    }
}