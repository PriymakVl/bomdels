<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Data extends Controller_Base {

    
    public function action_index()
    {   
        $scripts = array('jquery.js', 'add_active_item_topnav.js', 'auto_add_sundbirsta.js', 'data_show_box_sidebar.js', 'data_edit.js');
        $this->template->scripts = $scripts;
        
        $detail_id = $this->request->query('id');

        if(!(int) $detail_id) exit('error<br><a href="/">главная</a>');
        
        $detail = new Object_Sundbirsta($detail_id);
        //Arr::_print($detail);
        $detail->getParent();
        $breadcrumbs = $this->getBreadcrumbs($detail->code);
        
        View::bind_global('detail', $detail);
        $this->template->block_topnav = View::factory('total/v_top_breadcrumbs')->bind('breadcrumbs', $breadcrumbs);
        $this->template->block_center = View::factory('data/v_data_detail');
        $this->template->block_right = View::factory('data/v_data_menu');  
       
    }
    
    public function action_edit() {
        echo Model::factory('sundbirsta')->update($_POST);
        exit();
    }
   
    

}
