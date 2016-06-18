<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Profile extends Controller_Base {
    
    public function action_index() {
        
        $this->template->styles = array('style.css', 'header.css', 'profile.css');
        $this->template->scripts =  array('jquery.js', 'employee/show_box_profile.js');
        
        $employee_name = $this->employee->getFullNameEmployee();
        
        $this->template->block_header = View::factory('header/v_header_profile')->bind('employee_name', $employee_name); 
        $this->template->block_right = View::factory('profile/v_profile_menu');
        $this->template->block_center = View::factory('profile/v_profile_content');         
    }
    
    public function action_editdata() {
        $data = Arr::extract($_POST, array('firstname', 'patronymic', 'email', 'employee_id'));
        $res = Model::factory('Employee')->updateData($data);
        if ($res) $this->redirect('/profile');
        else exit('error action_editdata');
    }
    
}
    