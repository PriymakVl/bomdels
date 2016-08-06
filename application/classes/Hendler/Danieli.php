<?php

/**
 * User: Priymak Vladimir
 * Date: 17.04.2016
 * Time: 10:11
 */
 
class Hendler_Danieli extends Hendler_Base {

    //create array data from table exel
    public function getArrayDanieli($separator = ';')
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
    
    //extract the file name image
    public function getNameFile() 
    {
        for ($i = 0, $count = count($this->data); $i < $count; $i++)
        {
            $file = $this->data[$i]['File'];
            $pos = strpos($file, 'No');//parts string No File Found
            if($pos) {
                $this->data[$i]['file'] = '';    
            }
            else {
                $file = explode('\\', $file);
                $this->data[$i]['file'] = array_pop($file);      
            }
              
        } 
        return $this;   
    }
    
    public function getVariant() 
    {
        for ($i = 0, $count = count($this->data); $i < $count; $i++) {
            $pos = strpos($this->data[$i]['Member'], '/');
            if($pos === false) {
                $this->data[$i]['code'] = $this->data[$i]['Member'];
                $this->data[$i]['variant'] = '';    
            }
            else {
                $arr = explode('/', $this->data[$i]['Member']);
                $this->data[$i]['code'] = $arr[0];
                $this->data[$i]['variant'] = $arr[1];  
            }
        }
        return $this;
    }
    //clear parent code to variant
    public function clearParentCode() 
    {
        for ($i = 0, $count = count($this->data); $i < $count; $i++) {
            $pos = strpos($this->data[$i]['Owner'], '/');
            if($pos === false) {
                $this->data[$i]['parent_code'] = trim($this->data[$i]['Owner']);    
            }
            else {
                $arr = explode('/', $this->data[$i]['Owner']);
                $this->data[$i]['parent_code'] = $arr[0];  
            }
        }
        return $this;    
    }
    
    public function getEngName() 
    {
        for ($i = 0, $count = count($this->data); $i < $count; $i++) {
            //$this->data[$i]['eng'] = str_replace('ш', '35', $this->data[$i]['Title']);
            $this->data[$i]['eng'] = ucfirst(strtolower($this->data[$i]['Title'])); 
               
        }
        return $this;
    }
    
    public function getItem()
    {
        for ($i = 0, $count = count($this->data); $i < $count; $i++) {
            $this->data[$i]['item'] = (int)$this->data[$i]['Item'];    
        }
        return $this;    
    }
    
    public function getSheets() 
    {
        for ($i = 0, $count = count($this->data); $i < $count; $i++) {
            $this->data[$i]['sheet'] = (int)$this->data[$i]['Sheet'];
            $this->data[$i]['sheets'] = (int)$this->data[$i]['Sheets'];    
        }
        return $this; 
    } 
    
    public function getSize() 
    {
        for ($i = 0, $count = count($this->data); $i < $count; $i++) {
            $this->data[$i]['size'] = $this->data[$i]['Size'];   
        }
        return $this; 
    }
    
    public function getQuantity() 
    {
        for ($i = 0, $count = count($this->data); $i < $count; $i++) {
            $this->data[$i]['qty'] = (int)$this->data[$i]['Quantity'];   
        }
        return $this; 
    }  
    
    public function getWeight() 
    {
        for ($i = 0, $count = count($this->data); $i < $count; $i++) {
            $this->data[$i]['weight'] = $this->data[$i]['Weight'];   
        }
        return $this; 
    } 
    
    public function getType() 
    {
        for ($i = 0, $count = count($this->data); $i < $count; $i++) {
            $code = $this->data[$i]['code'];
            $point = strpos($code, '.');
            if(!$point) {
                $this->data[$i]['type'] = 'assembly';    
            } 
            else {
                $first_letter = $code[0];
                switch($first_letter) {
                    case 8: $this->data[$i]['type'] = 'component'; break; 
                    case 4: $this->data[$i]['type'] = 'detail'; break;
                    case 6: $this->data[$i]['type'] = 'schema'; break;
                    case 0: $this->data[$i]['type'] = 'standart'; break;
                    default: $this->data[$i]['type'] = 'not found';
                }  
            }
        }
        return $this;    
    }  

}

















