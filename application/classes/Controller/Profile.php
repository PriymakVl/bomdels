<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Profile extends Controller_Base {
    
    public function action_index() {
        
        $this->template->styles = array('style.css', 'header.css', 'profile.css');
        $this->template->scripts =  array('jquery.js', 'user/show_box_profile.js');
        
        $user_name = $this->user->getFullNameUser();
        
        $this->template->block_header = View::factory('header/v_header_profile')->bind('user_name', $user_name); 
        $this->template->block_right = View::factory('profile/v_profile_menu');
        $this->template->block_center = View::factory('profile/v_profile_content');         
    }
    
    public function action_editdata() {
        $data = Arr::extract($_POST, array('firstname', 'patronymic', 'email'));
        $data['user_id'] = $this->user->id;
        $res = Model::factory('User')->updateData($data);
        if ($res) $this->redirect('/profile');
        else exit('error action_editdata');
    }
    
}
    