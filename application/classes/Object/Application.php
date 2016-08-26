<?php defined('SYSPATH') OR die('No direct script access.');

class Object_Application extends Object_Object {
    

    public function __construct($id) 
    {
        $this->data = Model::factory('Application')->getApplicationById($id);
        if(!$this->data) exit('error object_application method _contstruct');
        $this->getContent();
        $this->getCreatedDate();
        $this->countGoods();
    } 
    
    private function getContent() 
    {
        $this->data['content'] = Model::factory('ApplicationContent')->getContentOfApplication($this->data['id']);
        return $this;
    }
    
    private function getCreatedDate()
    {
        $this->data['date_transform'] = $this->transformDate($this->data['date']);
        return $this;
    }
    
    private function countGoods() 
    {
        $this->data['count_item'] = count($this->data['content']);
        return $this;    
    }

}














