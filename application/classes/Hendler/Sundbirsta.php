<?php

/**
 * User: Priymak Vladimir
 * Date: 24.04.2016
 * Time: 10:57
 */
 
class Hendler_Sundbirsta extends Hendler_Base {
    

     public function fillingEmptyFieldCode() 
    {
        for ($i = 0, $count = count($this->data); $i < $count; $i++) {
            //echo $i + 1;
            if($this->data[$i]['code'] == '') $this->data[$i]['code'] = "empty_".rand();
        }
        return $this;
    } 
    
    public function trimStr() 
    {
        for ($i = 0, $count = count($this->data); $i < $count; $i++) {
            echo $i + 1;
            $this->data[$i]['weight'] = trim($this->data[$i]['weight']);
            $this->data[$i]['item'] = trim($this->data[$i]['item']);
            $this->data[$i]['code'] = trim($this->data[$i]['code']);
            $this->data[$i]['rus'] = trim($this->data[$i]['rus']);
            $this->data[$i]['qty'] = trim($this->data[$i]['qty']);
        }
        return $this;        
    }
    
    

}



















