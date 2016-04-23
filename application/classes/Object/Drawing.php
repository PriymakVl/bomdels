<?php defined('SYSPATH') OR die('No direct script access.');

class Object_Drawing {
    
    private $draw;

    public function __construct($id) {
        $this->draw = Model::factory('drawing')->getDrawById($id);
        $this->checkImage(); 
        $this->translateTitle();
        $this->getIdSub();   
    } 
    
    public function __get($name) 
    {
        if(isset($this->draw[$name])) {
            return $this->draw[$name];
        }
        return false;        
    } 
    
    private function checkImage() 
    {
        $length = strlen($this->draw['image']);
        if($length !== 8) $this->draw['image'] = false;
    }
    
    /*
    *   if not rushin title find in table translate if not change on enlish
    */
    private function translateTitle()
    {
        $rus = Model::factory('translator')->get(strtolower($this->draw['eng']));
        if ($rus) $this->draw['rus'] = UTF8::ucfirst($rus);//first letter big
        else $this->draw['rus'] = $this->draw['eng'];
    }
    
    //get id heirs
    private function getIdSub() 
    {
        $this->draw['sub_id'] = Model::factory('drawing')->getIdSubDrawsByCode($this->draw['code']);
    }
    
    public function getParent() 
    {
        $draw = Model::factory('drawing')->getDrawByCode($this->draw['parent_code']);
        if ($draw) {
            $this->draw['parent'] = $draw;
            if (!$this->draw['parent']['rus']) $this->draw['parent']['rus'] = $this->draw['parent']['eng'];
        }
        else $this->draw['parent'] = false;
    }

}
















