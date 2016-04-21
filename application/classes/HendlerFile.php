<?php

/**
 * Created by PhpStorm.
 * User: Priymak Vladimir
 * Date: 03.02.2016
 * Time: 10:11
 */
class HendlerFile
{
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

}