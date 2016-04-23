<?php defined('SYSPATH') or die('No direct script access.');

class Controller_View extends Controller_Base {

    
    public function action_index()
    {   
        $draw_id = Arr::get($_GET, 'id');
        if((int) $draw_id) $draw = new Object_Drawing($draw_id);
        
        //$this->template->block_topnav = View::factory('widgets/w_topnav')->bind('code', $this->code);
        //$this->template->block_right = View::factory('widgets/w_vernav');
        $this->template->block_center = View::factory('widgets/w_view_draw')->bind('draw', $draw);
    }
}
