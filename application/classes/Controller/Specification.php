<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Specification extends Controller_Base {

    
    public function action_index()
    {   
        $this->template->styles = array('style.css', 'specification_sidebar.css', 'header.css');
        $scripts_1 = array('jquery.js', 'sort_details_sundbirsta.js', 'sort_sundbirsta_checked_all.js');//, 'specification_show_box_sidebar.js'
        $scripts_2 = array('elect_add.js', 'sort_danieli.js', 'specification_show_danieli_box.js');
        $scripts = Arr::merge($scripts_1, $scripts_2);
        $this->template->scripts = $scripts;
        
        $detail_id = $this->request->query('id');
        $equipment = $this->request->query('equipment');
        
        if(!(int) $detail_id) exit('id detail does not validation');
        if($equipment == 'sundbirsta') {
            $detail = new Object_Sundbirsta($detail_id);
            $class_name = 'Object_Sundbirsta';
            $template_content = 'specification/v_specification_content_sundbirsta';
            $template_menu = 'specification/v_specification_menu_sundbirsta';    
        }
        if($equipment == 'danieli') {
            $detail = new Object_Danieli($detail_id);
            $class_name = 'Object_Danieli';
            $template_content = 'specification/v_specification_content_danieli'; 
            $template_menu = 'specification/v_specification_menu_danieli';   
        }
        //Arr::_print($detail);
        if(empty($detail)) exit('detail not been exist');
        
        $breadcrumbs = $this->getBreadcrumbs($detail->code, $equipment);
        View::bind_global('detail', $detail);
        
        $details = $this->getArrayOfObjects($detail->sub_id, $class_name);

        $this->template->block_header = View::factory('total/v_top_breadcrumbs')->bind('breadcrumbs', $breadcrumbs);
        $this->template->block_right = View::factory($template_menu);
        $this->template->block_center = View::factory($template_content)->bind('details', $details);
                       
    }
    
}
    