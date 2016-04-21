<?php defined('SYSPATH') OR die('No direct script access.');

class Arr extends Kohana_Arr {
    
    public static function _print($array, $end = true) {
        echo '<p style="color:red">start of script</p>';
        if($array === NULL || $array === FALSE) var_dump($array);
        else {
            echo '<pre>';
            print_r($array); 
            echo '</pre>';
        }
        if($end) exit('<p style="color:red">end of script</p>');
    }
}
