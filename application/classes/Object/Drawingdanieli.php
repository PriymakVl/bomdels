<?php defined('SYSPATH') OR die('No direct script access.');

class Object_Drawingdanieli extends Object_Drawing {
    
    public function __construct($id) {
        $this->data = Model::factory('Drawingdanieli')->getDrawingById($id);
        $this->getType();
        $this->cutNote();
    }
    
}















