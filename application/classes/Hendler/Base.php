<?php

/**
 * Created by PhpStorm.
 * User: Priymak Vladimir
 * Date: 03.02.2016
 * Time: 10:11
 */
class Hendler_Base {
    
    private $file;
    public $str_arr = array();

    /**
     * HendlerFile constructor.
     * @param $file
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * @return array
     */
    public function getArrayStringFromFile()
    {
        $handle = @fopen($this->file, "r");
        if ($handle) {
                while (($buffer = fgets($handle, 4096)) !== false) {
                $this->str_arr[] = $buffer;
            }
            if (!feof($handle)) {
                echo "Error: unexpected fgets() fail\n";
            }
            fclose($handle);
        }
        $first_str = substr($this->str_arr[0],0,-2);
        $first_str = $first_str.";\n";
        $this->str_arr[0] = $first_str;
        return $this;
    }

    /**
     * @param $key1
     * @param $key2
     * @param $separator
     * @return array
     */
    public function getArrayFromArrayString($key1, $key2, $separator)
    {
        $data = array();
        for ($i = 0, $count = count($this->str_arr); $i < $count; $i++) {
            $bin = explode($separator, $this->str_arr[$i]);
            $data[$i][$key1] = $bin[0];
            $data[$i][$key2] = $bin[1];
        }
        return $data;
    }
    
    public $data = array();

    //create array data from table exel
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
    
    public function toUTF8($key) 
    {
        for ($i = 0, $count = count($this->data); $i < $count; $i++) {
            $this->data[$i][$key] = mb_convert_encoding($this->data[$i][$key], "UTF-8", "windows-1251");
        }
        return $this;
    }

}