<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Base extends Controller_Template {

    public $template = 'v_base';
    
    public function before()
    {
        parent::before();
        
        $this->template->title = 'стан 400/200';
        
        $this->template->styles = array('style.css');
        $this->template->scripts = array('jquery.js', 'add_active_item_topnav.js');
        
        $this->template->block_topnav = View::factory('widgets/w_topnav');
        $this->template->block_right = null;
        $this->template->block_center = null;
        $this->template->block_footer = View::factory('widgets/w_footer');
    }


}
