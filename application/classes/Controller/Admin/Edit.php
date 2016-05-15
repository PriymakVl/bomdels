<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Edit extends Controller_Base {

    
    public function action_index()
    {   
        $code = Arr::get($_POST, 'code');
        
        if(isset($code)) {
            $draw = Model::factory('drawing')->search($code);
            if(!empty($draw['id'])) $draw_options = Model::factory('drawoptions')->get($draw['id']);    
        }
        
        
        Arr::_print($draw);
        
        $this->template->block_header = View::factory('admin/w_admin_header');
        $this->template->block_center = View::factory('admin/w_admin_edit_content')->bind('draw', $draw)->bind('options', $draw_options);
        $this->template->block_right = View::factory('admin/w_admin_menu');   
        
    }

}