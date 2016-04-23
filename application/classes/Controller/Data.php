<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Data extends Controller_Base {

    
    public function action_index()
    {   
        $this->template->block_right = View::factory('widgets/w_vernav');
        
        $id = $this->code ? Model::factory('drawing')->getIdDrawByCode($this->code) : Arr::get($_REQUEST, 'id');
        //Arr::_print($id);
        if (!$id) {
            $this->template->block_center = View::factory('widgets/w_draw_not_found')->set('info', 'Результат поиска');   
        }
        else {
            $draw = new Object_Drawing($id);
            $draw->getParent();
            $this->template->block_topnav = View::factory('widgets/w_top_breadcrumbs')->bind('draw', $draw);
            $this->template->block_center = View::factory('widgets/w_data_draw')->bind('draw', $draw);  
        }   
    }

}
