<?php defined('SYSPATH') OR die('No direct script access.');

class Object_Order extends Object_Object {
    

    public function __construct($id) {
        $this->data = Model::factory('Order')->getOrderById($id);
        if(!$this->data) exit('error object_order _contstruct');
        $this->getContent();
        $this->getDate();
        $this->cutNote(12);
        $this->getEquipment();
    } 
    
    public function getContent() 
    {
        $this->data['content'] = Model::factory('OrderContent')->getContentOfOrder($this->data['id']);
        return $this;
    }
    
    public function getDate() 
    {
        $this->data['date'] = date("d.m.y", $this->data['date']);
        return $this;
    }
    
    public function getEquipment() 
    {
        $category = Model::factory('Category')->getCategoryById($this->data['cat_id']);
        $this->data['equipment'] = $category['title'];
        return $this;
    }
    
    public function getFullNumberOfOrder() {
        $this->data['fullnumber'] = '27.'.$this->data['number'].'.1'; 
        return $this;
    }

}














