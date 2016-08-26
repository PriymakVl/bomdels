<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Auto_Data extends Controller_Base {


    public function action_index() 
    {
        $title = "Выберите в какую базу добавлять";
        
        $this->template->block_header = View::factory('header/v_header_title')->bind('title', $title);
        $this->template->block_right = View::factory('auto/v_auto_add_main_menu');
    }
    
    public function action_application() 
    {
         $this->template->styles = array('style.css', 'header.css', 'admin_auto_add.css');
         $this->template->scripts = array('jquery.js', 'admin/app_add.js');
        
        $title = "Добавление заявок в базу";
        $list_files = unserialize(Cookie::get('list_files'));
        
        $this->template->block_header = View::factory('header/v_header_title')->bind('title', $title);
        $this->template->block_center = View::factory('auto/v_auto_add_application')->bind('files', $list_files);
        $this->template->block_right = View::factory('auto/v_auto_add_application_menu');    
    }
    
     public function action_danieli() 
     {
        $this->template->styles = array('style.css', 'header.css', 'admin_auto_add.css');
         $this->template->scripts = array('jquery.js', 'admin/admin_add_show_box.js');
        
        $title = "Добавление данных danieli в базу";
        $list_files = unserialize(Cookie::get('list_files'));
        
        $this->template->block_header = View::factory('header/v_header_title')->bind('title', $title);
        $this->template->block_center = View::factory('auto/v_auto_add_danieli')->bind('files', $list_files);
        $this->template->block_right = View::factory('auto/v_auto_add_main_menu');   
    }
    
    public function action_crane() 
    {
        $this->template->styles = array('style.css', 'header.css', 'admin_auto_add.css');
         $this->template->scripts = array('jquery.js', 'admin/admin_add_show_box.js');
        
        $title = "Добавление данных по кранам в базу";
        $list_files = unserialize(Cookie::get('list_files'));
        
        $this->template->block_header = View::factory('header/v_header_title')->bind('title', $title);
        $this->template->block_center = View::factory('auto/v_auto_add_crane')->bind('files', $list_files);
        $this->template->block_right = View::factory('auto/v_auto_add_main_menu');   
    }
    
    protected function createListAddedFiles() 
    {
        $list = Cookie::get('list_files');
        $list = unserialize($list);
        $list[] = $_FILES['table']['name'];
        $list = serialize($list);
        Cookie::set('list_files', $list);   
    }
    
    public function action_deleteListFiles() 
    {
        Cookie::delete('list_files');
        $this->action_index();   
    }
    
}