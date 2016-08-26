<?php defined('SYSPATH') OR die('No direct script access.');

class Object_Drawingsundbirsta extends Object_Drawing {
    
    public function __construct($id) {
        if($id) $this->data = Model::factory('Drawingsundbirsta')->getDrawingById($id);
        $this->getType();
        $this->cutNote();
    }
    
}















