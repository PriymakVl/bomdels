<?php defined('SYSPATH') or die('No direct script access.');

class Model_Drawingcrane extends Model_Drawing {
    
    public function __construct()
    {
        $this->tableName = 'drawings_cranes';    
    }
    
}