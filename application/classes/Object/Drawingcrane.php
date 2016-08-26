<?php defined('SYSPATH') OR die('No direct script access.');

class Object_Drawingcrane extends Object_Drawing {
    
    public function __construct($id) {
        if($id) $this->data = Model::factory('Drawingcrane')->getDrawingById($id);
        $this->getType();
        $this->cutNote();
    }
    
}















