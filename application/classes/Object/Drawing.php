<?php defined('SYSPATH') OR die('No direct script access.');

class Object_Drawing extends Object_Object {
    
    public function __construct($id) {
        $this->data = Model::factory('drawing')->getDrawingById($id);
        //$this->cutNote();
    }
    
    public static function moveFile($folder, $file_name) 
    { 
        $path = "media/drawings/{$folder}/".$file_name;
        if(is_uploaded_file($_FILES["draw"]["tmp_name"]))
        {
            move_uploaded_file($_FILES["draw"]["tmp_name"], $path);
            return true;
        } 
        else return false;        
    }
    
    public static function moveFilePDF($folder, $file_name) 
    { 
        $path = "media/drawings/{$folder}/pdf/".$file_name;
        if(file_exists($path)) return true; 
        
        if(is_uploaded_file($_FILES["draw"]["tmp_name"]))
        {
            move_uploaded_file($_FILES["draw"]["tmp_name"], $path);
            return true;
        } 
        else return false;        
    }
    
    public function cutNote($max = 30) {
        $lenth = UTF8::strlen($this->data['note']);
        if($lenth > $max) $this->data['note_cut'] = UTF8::substr($this->data['note'], 0, $max);
        return $this;     
    }
    
}















