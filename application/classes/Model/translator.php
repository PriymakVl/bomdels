<?php defined('SYSPATH') or die('No direct script access.');

class Model_Translator extends Model {
    
    private $tableName = 'translator';
    
    public function get($eng)
    {
       $sql = "SELECT `rus` FROM $this->tableName WHERE `eng` = :eng AND `status` = :status LIMIT 1";
       $query = DB::query(Database::SELECT, $sql)->bind(':eng', $eng)->param(':status', 1);
       return $query->execute()->get('rus');
    }
    
}