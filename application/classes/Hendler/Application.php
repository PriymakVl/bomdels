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
    
    //extract the name good
    public function getGoodName() 
    {
        for ($i = 0, $count = count($this->data); $i < $count; $i++) {
            $this->data[$i]['name'] = $this->data[$i]['Наименование материалов, оборудования, узлов и деталей']; 
               
        }
        return $this;
    }
    
    //extract the code ens
    public function getEns() 
    {
        for ($i = 0, $count = count($this->data); $i < $count; $i++) {
            $this->data[$i]['ens'] = $this->data[$i]['Код ЕНС']; 
        }
        return $this;
    }
    
    //extract the code or number draw good
    public function getCodeGood() 
    {
        for ($i = 0, $count = count($this->data); $i < $count; $i++) {
            $this->data[$i]['code'] = $this->data[$i]['№ чертежа/ формат']; 
        }
        return $this;
    }
    
      //extract the count needed the buy in year
    public function getNeededGood() 
    {
        for ($i = 0, $count = count($this->data); $i < $count; $i++) {
            $this->data[$i]['need'] = $this->data[$i]['Потреб- ность']; 
        }
        return $this;
    }
    
    public function getWeightGood() 
    {
        for ($i = 0, $count = count($this->data); $i < $count; $i++) {
            $this->data[$i]['weight'] = $this->data[$i]['Вес, тн.|шт.']; 
        }
        return $this;
    }
    
    public function getPriceGood() 
    {
        for ($i = 0, $count = count($this->data); $i < $count; $i++) {
            $this->data[$i]['price_$'] = $this->data[$i]['Цена с НДС, $'];
            $this->data[$i]['price_€'] = $this->data[$i]['Цена с НДС, EURO'];  
            $this->data[$i]['price'] = $this->data[$i]['Цена с НДС, грн.'];  
        }
        return $this;
    }
    //get who buy good
    public function getExecutor()
    {
        for ($i = 0, $count = count($this->data); $i < $count; $i++) {
            $this->data[$i]['executor'] = $this->data[$i]['Ответственный групповод']; 
        }
        return $this;
    }
    
    public function getCreatedCodeEns()
    {
        for ($i = 0, $count = count($this->data); $i < $count; $i++) {
            $this->data[$i]['created'] = $this->data[$i]['Кто ввёл']; 
        }
        return $this;
    }
    
    public function getUnits()//единицы измерения
    {
        for ($i = 0, $count = count($this->data); $i < $count; $i++) {
            $this->data[$i]['units'] = $this->data[$i]['Ед. изм.']; 
        }
        return $this;
    }

}

















