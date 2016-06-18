<?php defined('SYSPATH') OR die('No direct script access.');

class Object_Object {
    
    protected $data;
    
    //for create link on page elected
    public function setKindElect($kind) {
        $this->data['kind'] = $kind;
        return $this;    
    }
    
    public function setElectId($elect_id) {
        $this->data['elect_id'] = $elect_id;        
    }
    
    public function __get($name) 
    {
        if(isset($this->data[$name])) {
            return $this->data[$name];
        }
        return false;        
    } 
    
     public function cutNote($max = 30) {
        $lenth = UTF8::strlen($this->data['note']);
        if($lenth > $max) $this->data['note_cut'] = UTF8::substr($this->data['note'], 0, $max);
        return $this;     
    }
    
    public function getExtensionFile($filename) {
        $info = new SplFileInfo($filename);
        return $info->getExtension();
    }

}














