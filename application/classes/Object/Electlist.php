<?php defined('SYSPATH') OR die('No direct script access.');

class Object_Electlist extends Object_Object {
    

    public function __construct($id) {
        $this->data = Model::factory('ElectList')->getListById($id);
    } 
    
    public function getLoginEmployee() {
         $employee = Model::factory('Employee')->get($this->data['employee_id']);
         $this->data['login'] = $employee['login'];
    }
    
}














