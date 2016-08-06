<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Test extends Controller {
    
    //
    public function action_ex()
    {
        $draws = Model::factory('Drawing')->getPdf();
        //Arr::_print($draws);
        foreach ($draws as $draw) {
                $arr = explode('.', $draw['file']);
                $file = $arr[0].'.pdf';
                Model::factory('Drawing')->editPdf($draw['id'], $file);
            }

         exit('end'); 
	}
    
	public function action_clearcode()
    {
        $draws = Model::factory('Drawing')->getAll();
        foreach ($draws as &$draw) {
            $res = stripos($draw['code'], '/');
            if($res) {
                $arr = explode('/', $draw['code']);
                Model::factory('Drawing')->editCode($draw['id'], $arr[0]);
            }
                
        }
        
         exit('end'); 
	}
    
}
