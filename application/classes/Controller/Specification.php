<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Specification extends Controller_Base {

    
    public function action_index()
    {   
        $this->template->styles = array('style.css', 'specification_sidebar.css');
        $scripts = array('jquery.js', 'sort_details_sundbirsta.js', 'sort_sundbirsta_checked_all.js', 'specification_show_box_sidebar.js');
        $this->template->scripts = $scripts;
        
        $detail_id = $this->request->query('id');

        if((int) $detail_id) $detail = new Object_Sundbirsta($detail_id);
        else $this->redirect('404');
        
        $breadcrumbs = $this->getBreadcrumbs($detail->code);
        View::bind_global('detail', $detail);
        
        $details = $this->getArrayOfObjects($detail->sub_id, 'Object_Sundbirsta');
        $this->template->block_topnav = View::factory('total/v_top_breadcrumbs')->bind('breadcrumbs', $breadcrumbs);
        $this->template->block_right = View::factory('specification/v_specification_menu');
        $this->template->block_center = View::factory('specification/v_specification_detail')->bind('details', $details);
                       
    }
    
}
    
