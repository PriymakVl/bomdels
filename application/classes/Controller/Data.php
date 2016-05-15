<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Data extends Controller_Base {

    
    public function action_index()
    {   
        $scripts = array('jquery.js', 'add_active_item_header.js', 'auto_add_sundbirsta.js', 'data_show_box_sidebar.js', 'data_edit.js');
        $this->template->scripts = $scripts;
        
        $detail_id = $this->request->query('id');
        $equipment = $this->request->query('equipment');

        if(!(int) $detail_id) exit('id detail does not validation');
        
        if($equipment == 'sundbirsta') $detail = new Object_Sundbirsta($detail_id);
        if($equipment == 'danieli') $detail = new Object_danieli($detail_id);
        if(empty($detail)) exit('detail not been exist');
        //Arr::_print($detail);
        $detail->getParent();
        $breadcrumbs = $this->getBreadcrumbs($detail->code, $equipment);
        
        View::bind_global('detail', $detail);
        $this->template->block_header = View::factory('total/v_top_breadcrumbs')->bind('breadcrumbs', $breadcrumbs);
        $this->template->block_center = View::factory('data/v_data_content');
        $this->template->block_right = View::factory('data/v_data_menu');  
       
    }
    
    public function action_edit() {
        echo Model::factory('sundbirsta')->update($_POST);
        exit();
    }
   
    

}