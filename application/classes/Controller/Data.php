<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Data extends Controller_Base {

    public $equipment;
    
    public function action_index()
    {   
        $this->template->styles = array('style.css', 'header.css', 'data.css');
        $scripts = array('jquery.js', 'data_show_box.js', 'data_edit.js');//'auto_add_sundbirsta.js'
        $this->template->scripts = $scripts;
        
        $detail_id = $this->request->query('id');
        $equipment = $this->request->query('equipment');

        if(!(int) $detail_id) exit('id detail does not validation');
        
        if($equipment == 'sundbirsta') $detail = new Object_Sundbirsta($detail_id);
        if($equipment == 'danieli') $detail = new Object_danieli($detail_id);
        if(empty($detail)) exit('detail not been exist');
        //Arr::_print($detail);
        $detail->getParent();
        //Arr::_print($detail);
        $breadcrumbs = $this->getBreadcrumbs($detail->code, $equipment);
        
        View::bind_global('detail', $detail);
        $this->template->block_header = View::factory('header/v_header_breadcrumbs')->bind('breadcrumbs', $breadcrumbs);
        $this->template->block_center = View::factory('data/v_data_content');
        $this->template->block_right = View::factory('data/v_data_menu');  
       
    }
    
    public function action_edit() {
        $equipment = $this->request->post('equipment');
        if($equipment == 'sundbirsta') $res = Model::factory('Sundbirsta')->update($_POST);
        else if($equipment == 'danieli') $res = Model::factory('Danieli')->update($_POST);
        var_dump($res);
        exit();
    }
   
    

}