<?php defined('SYSPATH') OR die('No direct script access.');

class Object_Detail extends Object_Object {
    

    public function __construct($id, $equipment) {
        if($equipment == 'danieli') $this->data = Model::factory('Danieli')->getDetailById($id);
        else if($equipment == 'sundbirsta') $this->data = Model::factory('Sundbirsta')->getDetailById($id);
        else if($equipment == 'crane') $this->data = Model::factory('Crane')->getDetailById($id);
        if(!$this->data) exit('error object_detail __contsruct');
        $this->translateTitle();
        $this->getIdSub($equipment);
        $this->getDrawings(); 
        $this->countDrawings(); 
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
        if($equipment = 'danieli') $this->data['sub_id'] = Model::factory('Danieli')->getIdSubdetailsByCode($this->data['code']);
        if($equipment = 'sundbirsta') $this->data['sub_id'] = Model::factory('Sundbirsta')->getIdSubdetailsByCode($this->data['code']);
        if($equipment = 'crane') $this->data['sub_id'] = Model::factory('Crane')->getIdSubdetailsByCode($this->data['code']);
        return $this;
    }
    //get data of parent
    public function getParent() 
    {
        if($data['equipment'] = 'danieli') $parent = Model::factory('Danieli')->getDetailByCode($this->data['parent_code']);
        if($data['equipment'] = 'sundbirsta') $parent = Model::factory('Sundbirsta')->getDetailByCode($this->data['parent_code']);
        if($data['equipment'] = 'crane') $parent = Model::factory('Crane')->getDetailByCode($this->data['parent_code']);
        if($parent) {
            $this->data['parent'] = $parent;  
            if (!$this->data['parent']['rus']) $this->data['parent']['rus'] = $this->data['parent']['eng'];  
        }
        else $this->data['parent'] = false; 
    }
    
    public function getDrawings() {
        if($this->data['equipment'] == 'danieli') $this->data['drawings'] = Model::factory('Drawingdanieli')->get($this->code);
        if($this->data['equipment'] == 'sundbirsta') $this->data['drawings'] = Model::factory('Drawingssunbirsta')->get($this->code);
        if($this->data['equipment'] == 'crane') $this->data['drawings'] = Model::factory('Drawingcrane')->get($this->code);
        return $this;
    }
    
    public function countDrawings() 
    {
        if($this->data['drawings']) $this->data['count_draws'] = count($this->data['drawings']);
        else $this->data['count_draws'] = null;
        return $this;
    }
    
    public function updateRating($rating, $equipment) {
        Model::factory($equipment)->updateRating($this->data['id'], $rating); 
        return $this;   
    }

}













