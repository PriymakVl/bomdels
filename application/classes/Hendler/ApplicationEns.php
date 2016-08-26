<?php

/**
 * User: Priymak Vladimir
 * Date: 17.04.2016
 */
 
class Hendler_ApplicationEns extends Hendler_Base {

    public function __construct($file)
    {
        $obj = new Hendler_Phpexcel($file);
        $this->data = $obj->getDataWithKeys();
        $this->getProductName();
        $this->getCodeEnsProduct();
        $this->getCodeProduct();
        $this->getNeededProduct();
        $this->getWeightProduct();
        $this->getPriceProduct();
        $this->getExecutor();
        $this->getCreatedApplication();
        $this->getUnits();//единицы измерения
    } 
    
 
    
    //extract the name product
    public function getProductName() 
    {
        for ($i = 1, $count = count($this->data); $i < $count; $i++) {
            $this->data[$i]['name'] = $this->data[$i]['Наименование материалов, оборудования, узлов и деталей']; 
               
        }
        return $this;
    }
    
    //extract the code ens
    public function getCodeEnsProduct() 
    {
        for ($i = 1, $count = count($this->data); $i < $count; $i++) {
            $this->data[$i]['ens'] = $this->data[$i]['Код ЕНС']; 
        }
        return $this;
    }
    
    //extract the code or number draw product
    public function getCodeProduct() 
    {
        for ($i = 1, $count = count($this->data); $i < $count; $i++) {
            $this->data[$i]['code'] = $this->data[$i]['№ чертежа/ формат']; 
        }
        return $this;
    }
    
      //extract the count needed the buy in year
    public function getNeededProduct() 
    {
        for ($i = 1, $count = count($this->data); $i < $count; $i++) {
            $this->data[$i]['need'] = $this->data[$i]['Потреб- ность']; 
        }
        return $this;
    }
    
    public function getWeightProduct() 
    {
        for ($i = 1, $count = count($this->data); $i < $count; $i++) {
            $this->data[$i]['weight'] = $this->data[$i]['Вес, тн.|шт.']; 
        }
        return $this;
    }
    
    public function getPriceProduct() 
    {
        for ($i = 1, $count = count($this->data); $i < $count; $i++) {
            $this->data[$i]['price_$'] = $this->data[$i]['Цена с НДС, $'];
            $this->data[$i]['price_€'] = $this->data[$i]['Цена с НДС, EURO'];  
            $this->data[$i]['price'] = $this->data[$i]['Цена с НДС, грн.'];  
        }
        return $this;
    }
    //get who buy good
    public function getExecutor()
    {
        for ($i = 1, $count = count($this->data); $i < $count; $i++) {
            $this->data[$i]['executor'] = $this->data[$i]['Ответственный групповод']; 
        }
        return $this;
    }
    
    public function getCreatedApplication()
    {
        for ($i = 1, $count = count($this->data); $i < $count; $i++) {
            $this->data[$i]['created'] = $this->data[$i]['Кто ввёл']; 
        }
        return $this;
    }
    
    public function getUnits()//единицы измерения
    {
        for ($i = 1, $count = count($this->data); $i < $count; $i++) {
            $this->data[$i]['units'] = $this->data[$i]['Ед. изм.']; 
        }
        return $this;
    }
    
    public function getNumberOfApplication($filename)
    {
        $arr = explode('_', $filename);
        $number = $arr[0];
        if($number) return '027/'.$number;
        else return false;    
    }
    //parse filename
    public function getCreationDateTheApplication($filename) 
    {
        $arr = explode('_', $filename);
        $arr = explode('.', $arr[1]);
        $arr_date = explode('-', $arr[0]);
        $str = $arr_date[2].'-'.$arr_date[1].'-'.$arr_date[0];
        $date = strtotime($str);
        if($date) return $date;
        else return false;    
    }
    
    public function getTypeRepairFromNameFile($filename)
    {
        $pos = strpos($filename, 'КР');
        if($pos === false) return 'Текущий';
        else return 'Капитальный';   
    }

}

















