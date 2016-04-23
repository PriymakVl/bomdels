<?php defined('SYSPATH') or die('No direct script access.');

class Model_Elect extends Model {
    
    private $tableName = 'elect';
    
    public function get($user_id, $cat_id)
    {
       $sql = "SELECT `draw_id` AS id FROM ".$this->tableName." WHERE `user_id` = :user_id AND `cat_id` = :cat_id ORDER BY `rating` DESC";
       $query = DB::query(Database::SELECT, $sql)->bind(':user_id', $user_id)->bind(':cat_id', $cat_id);
       return $query->execute()->as_array();
    }
    
}