<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Test extends Controller {
    

    
	public function action_index()
    {
        $obj = new Object_Drawing(1);
        Arr::_print($obj->code);
          
	}
    
}
