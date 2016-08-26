<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Specification extends Controller_Base {

    
    public function action_index()
    {   
        $this->template->styles = array('style.css', 'specification_sidebar.css', 'header.css');
        $scripts_1 = array('jquery.js', 'sort_details_sundbirsta.js', 'sort_sundbirsta_checked_all.js');//, 'specification_show_box_sidebar.js'
        $scripts_2 = array('elect/specification_elect_add.js', 'sort_danieli.js', 'specification_show_danieli_box.js', 'specification/delete_detail.js');
        $scripts = Arr::merge($scripts_1, $scripts_2);
        $this->template->scripts = $scripts;
        
        $detail_id = $this->request->query('id');
        $equipment = $this->request->query('equipment');

        if($equipment == 'sundbirsta') {
            $detail = new Object_Sundbirsta($detail_id);
            $details = $this->getArrayOfObjects($detail->sub_id, 'Object_Sundbirsta');   
        }
        else if($equipment == 'danieli') {
            $detail = new Object_Danieli($detail_id);
            $details = $this->getArrayOfObjects($detail->sub_id, 'Object_Danieli');
        }
        else if ($equipment == 'crane') {
            $detail = new Object_Crane($detail_id);
            $details = $this->getArrayOfObjects($detail->sub_id, 'Object_Crane');       
        }
        //Arr::_print($detail);
        if(empty($detail)) exit('error action_index');

        $breadcrumbs = $this->getBreadcrumbs($detail->code, $equipment);
        View::bind_global('detail', $detail);
        
       

        $this->template->block_header = View::factory('header/v_header_breadcrumbs')->bind('breadcrumbs', $breadcrumbs);
        $this->template->block_right = View::factory('/specification/v_specification_menu');
        $this->template->block_center = View::factory('/specification/v_specification_content')->bind('details', $details);
                       
    }
    
}
    