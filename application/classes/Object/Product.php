<?php defined('SYSPATH') OR die('No direct script access.');

class Object_Product extends Object_Object {
    

    public function __construct($id) 
    {
        $this->data = Model::factory('ApplicationEns')->get($id);
        if(!$this->data) exit('error object_application method _contstruct');
        $this->getIdDetail();
    } 
    
    public function getNeededCount($app_id) 
    {
        $app_item = Model::factory('ApplicationContent')->getItemApplication($app_id, $this->data['id']);
        if(!$app_item) $this->data['count'] = 0;
        else $this->data['count'] = $app_item['need'].' '.$this->data['units'];
        return $this;
    }
    
    private function getIdDetail() 
    {
        if($this->data['equipment'] == 'danieli') $detail = Model::factory('Danieli')->getDetailByCode($this->data['code']);
        else if($this->data['equipment'] == 'sundbirsta') $detail = Model::factory('Sundbirsta')->getDetailByCode($this->data['code']);
        if(isset($detail)) $this->data['detail_id'] = $detail['id'];
        else $this->data['detail_id'] = false;
        return $this;
    }

}














