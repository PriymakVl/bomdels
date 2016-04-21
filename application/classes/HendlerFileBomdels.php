<?php

/**
 * User: Priymak Vladimir
 * Date: 17.04.2016
 * Time: 10:11
 */
 
class HendlerFileBomdels extends HendlerFile
{
    
    public $data = array();

    //create array data from table exel
    public function getArrayBomdels($separator = ';')
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
    
    //extract the file name
    public function getNameFile() 
    {
        for ($i = 0, $count = count($this->data); $i < $count; $i++)
        {
            $file = $this->data[$i]['File'];
            $file = explode('\\', $file);
            $file = array_pop($file);
            $file = explode('.', $file);
            $this->data[$i]['image'] = $file[0];    
        } 
        return $this;   
    }
    
    public function getVariant() 
    {
        for ($i = 0, $count = count($this->data); $i < $count; $i++) {
            $pos = strpos($this->data[$i]['Member'], '/');
            if($pos === false) {
                $this->data[$i]['code'] = $this->data[$i]['Member'];
                $this->data[$i]['variant'] = 'нет';    
            }
            else {
                $arr = explode('/', $this->data[$i]['Member']);
                $this->data[$i]['code'] = $arr[0];
                $this->data[$i]['variant'] = $arr[1];  
            }
        }
        return $this;
    }

}



















