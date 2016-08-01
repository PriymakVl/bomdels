<?php defined('SYSPATH') OR die('No direct script access.');

class Object_Detail extends Object_Object {
    

    public function __construct($id, $equipment) {
        $this->data = Model::factory($equipment)->getDetailById($id);
        if(!$this->data) exit('error object_detail __contsruct');
        $this->translateTitle();
        $this->getIdSub($equipment);
        $this->getDrawings();  
    } 
    
//    private function checkdrawing() 
//    { 
//        $length = strlen($this->data['drawing']);
//        if($length !== 8) $this->data['drawing'] = false;
//    }
    
    /*
    *   if not rushin title find in table translate if not change on enlish
    */
    private function translateTitle()
    {
        if(!$this->data['rus']) $this->data['rus'] = $this->data['eng'];
        return $this; 
        //$name = Model::factory('Glossary')->getRus($this->data['eng']);
//        if(!$name) $this->data['rus'] = $this->data['eng'];
//        else $this->data['rus'] = UTF8::ucfirst($name[0]['rus']);//first letter big 
//        return $this;    
    }
    
    //get id heirs
    private function getIdSub($equipment) 
    {
        $this->data['sub_id'] = Model::factory($equipment)->getIdSubdetailsByCode($this->data['code']);
        return $this;
    }
    //get data of parent
    public function getParent() 
    {
        $detail = Model::factory($this->equipment)->getDetailByCode($this->data['parent_code']);
        if (empty($detail)) $this->data['parent'] = false;    
        else {
            $this->data['parent'] = $detail[0];
            if (!$this->data['parent']['rus']) $this->data['parent']['rus'] = $this->data['parent']['eng'];
        }
    }
    
    public function getDrawings() {
        $this->data['drawings'] = Model::factory('Drawing')->get($this->code);
    }
    
    public function updateRating($rating, $equipment) {
        Model::factory($equipment)->updateRating($this->data['id'], $rating); 
        return $this;   
    }

}














