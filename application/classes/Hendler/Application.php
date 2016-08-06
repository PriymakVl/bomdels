<?php

/**
 * User: Priymak Vladimir
 * Date: 17.04.2016
 */
 
class Hendler_Application extends Hendler_Base {

    public function __construct($file)
    {
        parent::__construct($file);
        $this->getArrayStringFromFile();
        $this->getArrayDataWithTable();
    } 
    
    public function getArrayDataWithTable($separator = ';')
    {   
        for ($i = 0, $count = count($this->str_arr); $i < $count; $i++) {
            if($i == 0) {
                $keys = explode($separator, $this->str_arr[$i]); //create array keys    
            }
            else {
                $this->data[$i - 1] = $this->assignKeys($keys, $this->str_arr[$i], $separator);      
            }
        }
        return $this;
    }
    
    private function assignKeys($keys, $string, $separator) 
    {
        $bin = explode($separator, $string);
        $data_col = array();
        
        for ($i = 0, $count = count($bin); $i < $count; $i++) {
            $key = mb_convert_encoding($keys[$i], "UTF-8", "windows-1251");
            $value = mb_convert_encoding($bin[$i], "UTF-8", "windows-1251");
            $data_col[$key] = $value;     
        } 
        return $data_col;  
    } 

}

















