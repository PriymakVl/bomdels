<?php defined('SYSPATH') OR die('No direct script access.');

class Object_Electlist extends Object_Object {
    

    public function __construct($id) {
        $this->data = Model::factory('ElectList')->getListById($id);
    } 
    
    public function getLoginUser() {
         $user = Model::factory('User')->get($this->data['user_id']);
         $this->data['login'] = $user['login'];
    }
    
}














