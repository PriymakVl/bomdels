<?php

/**
 * User: Priymak Vladimir
 * Date: 17.04.2016
 */
 
class Hendler_Phpexcel extends Hendler_Base {
    
    private $arr;

    public function __construct($file)
    {
        require Kohana::find_file('libraries', 'PHPExcel/PHPExcel');
        $this->file = $file;
        $this->readExelFile($file);       
    } 
    
    private function readExelFile($file)
    {
        $this->arr = array(); //инициализируем массив
    
        $inputFileType = PHPExcel_IOFactory::identify($file);  // узнаем тип файла, excel может хранить файлы в разных форматах, xls, xlsx и другие
        $objReader = PHPExcel_IOFactory::createReader($inputFileType); // создаем объект для чтения файла
        $objPHPExcel = $objReader->load($file); // загружаем данные файла в объект
        $this->arr = $objPHPExcel->getActiveSheet()->toArray(); // выгружаем данные из объекта в массив
    }
    
    public function getDataWithKeys() 
    {
        //add keys in array
        $arr = array();
        
        for ($i = 0, $count = count($this->arr); $i < $count; $i++) {
            if($i == 0) continue;
            for ($j = 0; $j < count($this->arr[$i]); $j++) {
                $arr[$i][$this->arr[0][$j]] = $this->arr[$i][$j];  
            }
        }
        return $arr;    
    } 
    
    

}

















