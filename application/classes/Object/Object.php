<?php defined('SYSPATH') OR die('No direct script access.');

class Object_Object {
    
    protected $data;
    
    //for create link on page elected
    public function setKindElect($kind) {
        $this->data['kind_elect'] = $kind;
        return $this;    
    }
    
    public function setElectId($elect_id) {
        $this->data['elect_id'] = $elect_id;        
    }
    
    public function setElectName($name) {
        $this->data['name_elect'] = $name;        
    }
    
    public function setElectRatign($rating) {
        $this->data['rating_elect'] = $rating;        
    }
    
    public function setElectDescription($description) {
        $this->data['description_elect'] = $description;        
    }
    
    public function cutElectDescription($description, $max) {
        $lenth = UTF8::strlen($description);
        if($lenth > $max) {
            $description = UTF8::substr($description, 0, $max);
            $this->data['cut_des_elect'] = $description. ' ...';
        }      
    }
    
    public function __get($name) 
    {
        if(isset($this->data[$name])) {
            return $this->data[$name];
        }
        return false;        
    } 
    
     public function cutNote($max = 30, $postfix = false) {
        $lenth = UTF8::strlen($this->data['note']);
        if($lenth > $max) $this->data['note_cut'] = UTF8::substr($this->data['note'], 0, $max);
        if($postfix && isset($this->data['note_cut'])) $this->data['note_cut'] = $this->data['note_cut']. ' ...';
        return $this;     
    }
    
    public function getExtensionFile($filename) {
        $info = new SplFileInfo($filename);
        return $info->getExtension();
    }
    
    public function transformDate($time, $format = 'd.m.y', $postfix = 'г.') {
        return date($format, $time).$postfix;    
    }

}














