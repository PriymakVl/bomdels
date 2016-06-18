<?php defined('SYSPATH') or die('No direct script access.');

class Model_OrderContent extends Model {
    
    private $tableName = 'orders_content';
    
    public function getContentOfOrder($order_id) {
        $sql = "SELECT * FROM $this->tableName WHERE `order_id` = :order_id AND `status` = :status ORDER BY `rating`";
        $query = DB::query(Database::SELECT, $sql)->param(':status', 1)->bind(':order_id', $order_id);
        return $query->execute()->as_array();
    }
    
      public function get($id) {
        $sql = "SELECT * FROM $this->tableName WHERE `id` = :id AND `status` = :status";
        $query = DB::query(Database::SELECT, $sql)->param(':status', 1)->bind(':id', $id);
        $res = $query->execute()->as_array();
        if($res) return $res[0];
        else return false;
    }
    
    public function delete($id)
    {
        $sql = "UPDATE $this->tableName SET `status` = '0' WHERE `id` = :id";
        $query = DB::query(Database::UPDATE, $sql)->bind(':id', $id);
        return $query->execute();
    }
    
    public function update($data)
    {
        $sql = "UPDATE $this->tableName SET  `title` = :title, `rating` = :rating, `count` = :count, `weight_one` = :weight_one, `weight_total` = :weight_total WHERE `id` = :id";
        $query = DB::query(Database::UPDATE, $sql)
        ->parameters(array(':title' => $data['tiltle'], ':rating' => $data['rating'], ':id' => $data['id'], ':count' => $data['count'], 
        'weight_one' => $data['weight_one'], 'weight_total' => $data['weight_total'],));
        return $query->execute();
    }
    
//    public function add($data)
//    {
//        $sql = "INSERT INTO $this->tableName (title, order_id, code, sheet, node, date, responsible) VALUES (:title, :number, :type, :equipment, :node, :date, :responsible)";
//        $query = DB::query(Database::INSERT, $sql)->bind(':title', $data['title'])->bind(':number', $data['number'])->bind(':type', $data['type'])
//                ->bind(':date', $data['date'])->bind(':equipment', $data['equipment'])->bind(':responsible', $data['responsible']);
//        return $query->execute();
//    }
}