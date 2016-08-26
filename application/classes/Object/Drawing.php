<?php defined('SYSPATH') OR die('No direct script access.');

class Object_Drawing extends Object_Object {
    
    public static function moveFile($data) 
    { 
        $path = "media/drawings/{$data['equipment']}/{$data['folder']}/".$data['file'];
        if(is_uploaded_file($_FILES["draw"]["tmp_name"]))
        {
            move_uploaded_file($_FILES["draw"]["tmp_name"], $path);
            return true;
        } 
        else return false;        
    }
    
    protected function getType()
    {
        switch($this->data['type']){
            case 'vender': $this->data['type'] = 'Произодитель'; break;
            case 'works': $this->data['type'] = 'ПКО'; break;
            case 'draft': $this->data['type'] = 'Цех'; break;
            case 'standard': $this->data['type'] = 'Стандарт'; break;
            case 'other': $this->data['type'] = 'Другое'; break; 
        }
    }
    
}















