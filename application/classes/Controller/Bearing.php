<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Bearing extends Controller_Base {

    
    public function action_index()
    {   
        $this->template->styles = array('style.css', 'header.css', 'bearing.css');
        $this->template->scripts = array('jquery.js', 'bearing_show_box.js');
        
        $bearings = Model::factory('Bearing')->getAll();

        //$elements = $this->getArrayElectElements($elected);
        //Arr::_print($names);

        $info = 'Подшипники';
        
       // Arr::_print($info);
        $this->template->block_header = View::factory('header/v_header_search_bearings');
        $this->template->block_center = View::factory('bearings/v_bearings_content')->set('info', $info)->bind('bearings', $bearings);
        $this->template->block_right = View::factory('bearings/v_bearings_menu');
        
    }
    
    public function action_updateFromDanieli() 
    {
        //$names = Model::factory('Danieli')->getAll();
        $data = Model::factory('Danieli')->getDetailByType('standart');
        $data = $this->getBearings($data);
        Arr::_print($data);
        foreach ($data as $item) {
            $res = Model::factory('Bearing')->getItemByCode($item['code']);
            if($res) continue;
            Model::factory('Bearing')->insert($item);
        }
        $this->action_index();
    }
    
    private function getBearings($data) 
    {
        for ($i = 0, $count = count($data); $i < $count; $i++) {

            $name = strtolower($data[$i]['eng']);
            //Arr::_print($name);
            $res = strpos($name, 'bearing');
            if(!$res) continue;
            $bearings[] = $data[$i];
        }
        return $bearings;
    }
    
   
    

}