<?php defined('SYSPATH') or die('No direct script access.');

class Controller_View extends Controller_Base {

    public $template = 'view/v_base_view';
    
    public function action_index()
    {           
        $this->template->styles = array('view.css');
        $this->template->scripts = array('jquery.js', "view_show_list_draws.js" , "view_show_specification.js");
        
        $draw_id = $this->request->query('draw_id');
        if(!(int) $draw_id) exit('error');
        
        
        
        $detail = new Object_Detail($draw[0]['detail_id']);
        $draw = Model::factory('drawing')->getDrawingByCode($detail->code);
        
        //get children for of list specification
        if($detail->sub_id) $details = $this->getArrayOfObjects($detail->sub_id, 'Object_Detail');
        else $details = null;
        //for show full of drawing
        $drawing = $draw[0]['file'];
        $draws = $detail->drawings;

        if($detail->cat_id == 4) View::set_global('folder', 'sundbirsta');
        //Arr::_print($detail->drawings);
        View::bind_global('detail', $detail);
        
        $count_img = count($detail->drawings);
        //Arr::_print($detail);

        $this->template->block_topnav = View::factory('view/v_view_topnav')->bind('count_img', $count_img);
        $this->template->block_specification = View::factory('view/v_view_specification')->bind('details', $details);
        $this->template->block_full_drawing = View::factory('view/v_view_drawing')->bind('drawing', $drawing);
        $this->template->block_list = View::factory('view/v_view_list')->bind('draws', $draws);
        $this->template->block_footer = null;
    }
}