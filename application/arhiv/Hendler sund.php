<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Hendler extends Controller {

    public function action_sundbirsta()
    {   
        $obj = new Hendler_Sundbirsta('media/files/sundbirsta/ex-1.txt');
       
        $obj->getArrayStringFromFile()->getArrayDataWithTable()->toUTF8()->fillingEmptyFieldCode();
        Arr::_print($obj->data);
        foreach ($obj->data as $data) {
            $res = Model::factory('sundbirsta')->addAutoSun($data, "80003401-01");    
        }
        Arr::_print($res);
        echo 'end';   
    }
     
}