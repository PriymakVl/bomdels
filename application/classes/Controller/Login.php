<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Login extends Controller_Base {

    
    public function action_index()
    {   
        
        $this->template->title = 'Админка';
        
        $this->template->styles = array('login.css');
        $this->template->scripts = array('jquery.js', 'login_admin.js');
        
        $this->template->block_header = null;
        $this->template->block_header = null;
        $this->template->block_right = null;
        $this->template->block_center = View::factory('admin/v_login');
        $this->template->block_footer = null;
        
    }
    

}