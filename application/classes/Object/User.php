<?php defined('SYSPATH') OR die('No direct script access.');

class Object_User extends Object_Object {
    
    public function __construct($id) {
        $this->data = Model::factory('User')->get($id);
        if(empty($this->data)) return false;
        $this->getRole();
        $this->getElectListIds();
    }
    
    private function getRole() {
        $this->data['role'] = Model::factory('UserRole')->get($this->data['id']);
        return $this;
    }
    
    public function getFullNameUser() {
        return trim($this->data['firstname'].' '.$this->data['patronymic']);
    }
    
    public function getElectListIds() {
        if ($this->data['id'] == 1) $this->data['elect_lists'] = false;//not create list employee for admin
        else $this->data['elect_lists'] = Model::factory('ElectUserList')->getListIds($this->data['id']); 
        return $this;
    }
    
    
}














