<?php defined('SYSPATH') OR die('No direct script access.');

class Object_OrderItem extends Object_Object {
    

    public function __construct($id) {
        $this->data = Model::factory('OrderContent')->get($id);
        //Arr::_print($this->data);
        $this->countTotalWeight();
        $this->getPathFile();
    } 
    
    private function countTotalWeight() {
        $this->data['weight_total'] = $this->data['weight'] * $this->data['count'];
        return $this;
    }
    
    private function getPathFile() {
        if(!$this->data['drawing']) $this->data['path'] = false;
        else {
            $extension_folder = $this->getExtensionFile($this->data['drawing']);
            $this->data['path'] = '/media/drawings/'.$this->data['equipment'].'/'.$extension_folder.'/'.$this->data['drawing'];    
        }
        return $this;
    }
    
    
    
    
    
}














