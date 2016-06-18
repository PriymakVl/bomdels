<?php

/**
 * User: Priymak Vladimir
 * Date: 17.04.2016
 * Time: 10:11
 */
 
class Hendler_Glossary extends Hendler_Base
{
    
    public $data = array();

    //create array data from table exel
    public function getArrayTranslate($separator = ';')
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
    
    //assign keys array
    private function assignKeys($keys, $string, $separator) 
    {
        $bin = explode($separator, $string);
        $data_col = array();
        
        for ($i = 0, $count = count($bin); $i < $count; $i++) {
            $data_col[$keys[$i]] = $bin[$i];     
        } 
        return $data_col;  
    } 

}

















