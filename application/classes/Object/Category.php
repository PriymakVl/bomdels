<?php defined('SYSPATH') OR die('No direct script access.');

class Object_Category extends Object_Object {
    

    public function __construct($id) {
        $this->data = Model::factory('Category')->getCategoryById($id);
        $this->getIdSub();
        $this->getCodeDetails();
    } 
    
    public function __get($name) 
    {
        if(isset($this->data[$name])) {
            return $this->data[$name];
        }
        return false;        
    } 
    
    //get id heirs
    private function getIdSub() 
    {
        $this->data['sub_id'] = Model::factory('Category')->getIdSubCategoriesByParentId($this->data['id']);
        return $this;
    }
    
    private function getCodeDetails() {
        $this->data['details'] = Model::factory('CategoryContent')->getCodeDetailsByCatId($this->data['id']);
        return $this;
    }
    
}














