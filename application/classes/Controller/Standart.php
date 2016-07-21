<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Standart extends Controller_Base {

    
    public function action_index()
    {   
        $this->template->styles = array('style.css', 'header.css', 'standart.css');
        $this->template->scripts = array('jquery.js', 'standart_show_box.js');
        
        $data = Model::factory('Standart')->getAll();

        //$elements = $this->getArrayElectElements($elected);
        //Arr::_print($names);

        $info = 'Стандартные изделия';
        
       // Arr::_print($info);
        $this->template->block_header = View::factory('header/v_header_search_standart');
        $this->template->block_center = View::factory('standart/v_standart_content')->set('info', $info)->bind('data', $data);
        $this->template->block_right = View::factory('standart/v_standart_menu');
        
    }
    
    public function action_updateFromDanieli() 
    {
        //$names = Model::factory('Danieli')->getAll();
        $data = Model::factory('Danieli')->getDetailByType('standart');
        $data = $this->getStandart($data);
        //Arr::_print($data);
        foreach ($data as $item) {
            $res = Model::factory('Standart')->getItemByCode($item['code']);
            if($res) continue;
            Model::factory('Standart')->insert($item);
        }
        $this->action_index();
    }
    
    private function getStandart($data) {
        for ($i = 0, $count = count($data); $i < $count; $i++) {
            $data[$i]['origin'] = $data[$i]['eng'];
            $name = strtolower($data[$i]['eng']);
            //Arr::_print($name);
            $iso = strpos($name, ' iso ');
            if($iso) {
                $arr_iso = explode(' iso ', $name);
                $data[$i]['eng'] = trim($arr_iso[0]);
                if($data[$i]['eng'][0] == '"') $data[$i]['eng'] = trim(substr($data[$i]['eng'], 1));
                $data[$i]['standart'] = 'iso';
                //get value standart from second part origin name
                $stand_arr = explode(' ', $arr_iso[1]);
                $data[$i]['standart_value'] = preg_replace("/[^0-9]/", '', $stand_arr[0]);
                continue;
            }
            $uni = strpos($name, ' uni ');  
            if($uni) {
                $arr_uni = explode(' uni ', $name);
                //Arr::_print($arr_uni);
                $data[$i]['eng'] = trim($arr_uni[0]);
                if($data[$i]['eng'][0] == '"') $data[$i]['eng'] = trim(substr($data[$i]['eng'], 1));
                $data[$i]['standart'] = 'uni';
                //get value standart from second part origin name
                $stand_arr = explode(' ', $arr_uni[1]);
                $data[$i]['standart_value'] = preg_replace("/[^0-9]/", '', $stand_arr[0]);
                continue;
            }
            $uni = strpos($name, ' din ');  
            if($uni) {
                $arr_din = explode(' din ', $name);
                //Arr::_print($arr_uni);
                $data[$i]['eng'] = trim($arr_din[0]);
                if($data[$i]['eng'][0] == '"') $data[$i]['eng'] = trim(substr($data[$i]['eng'], 1));
                $data[$i]['standart'] = 'din';
                //get value standart from second part origin name
                $stand_arr = explode(' ', $arr_din[1]);
                $data[$i]['standart_value'] = preg_replace("/[^0-9]/", '', $stand_arr[0]);
                continue;
            } 
            if(empty($data[$i]['standart']))  $data[$i]['standart'] = 'not found';
            if(empty($data[$i]['standart_value']))  $data[$i]['standart_value'] = 'not found';      
        }
        return $data;
    }
    
   
    

}