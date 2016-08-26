<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Hendler extends Controller {

    
	public function action_danieli()
	{    
	   $obj = new Hendler_danieli('pinchcsv.csv');
       
        //$draws = $obj->getArrayStringFromFile()->getArrayFromArrayString('Member', "Title", ";");
        $str = $obj->getArrayStringFromFile();
        $arr = $obj->getArraydanieli();
        $arr = $obj->getNameFile();
        $arr = $obj->getVariant();
        
        //Arr::_print($arr);
        
        foreach ($arr->data as $data) {
            $draw_id = Model::factory('Drawingdanieli')->add($data); 
            //$arr[] = $draw_id;
            //$draw_id = $res[1];
            //Arr::_print($draw_id);
            if($draw_id) Model::factory('drawoptions')->add($draw_id, $data);   
        }
        //Arr::_print($arr);
        echo 'end';   
	}
    
}