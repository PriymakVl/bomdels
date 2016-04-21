<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin extends Controller_Base {

    public function action_add()
    {   
        $this->template->title = 'Админка';
        
        $this->template->scripts = array();
        $this->template->styles = array('admin.css');
        
        $message = Cookie::get('message');
        if($message) Cookie::delete('message');
        $post = Cookie::get('post');
        if($post) {
            $post = json_decode($post, true);   
            Cookie::delete('post'); 
        }
        
        $this->template->block_header = null;
        $this->template->block_topnav = null;
        $this->template->block_right = null;
        $this->template->block_center = View::factory('admin/v_admin_add')->bind('message', $message)->bind('draw', $post);
        $this->template->block_right = View::factory('admin/v_admin_nav');
        $this->template->block_footer = null;    
    }
    
    public function action_addDrawing() 
    {
            //$res = Model::factory('drawing')->add($_POST); 
//            if($res[0] == 1) Cookie::set('message', Kohana::message('message', 'success_add_drawing'));
//            else Cookie::set('message', Kohana::message('message', 'unknow_error'));
//            $this->redirect('/admin/add'); 
        try {
            $res = Model::factory('drawing')->add($_POST); 
            if(!empty($res[0])) Cookie::set('message', Kohana::message('message', 'success_add_drawing'));
            else Cookie::set('message', Kohana::message('message', 'unknow_error'));
            $this->redirect('/admin/add'); 
        }
        catch(Database_Exception $e) {
            if ($e->getCode() == 23000) {
                Cookie::set('message', Kohana::message('message', 'duplicate_drawing')); //23000 code pdo duplicate
                $post = json_encode($_POST);
                Cookie::set('post', $post); //return data post for insert in field input 
                $this->redirect('/admin/add');
            }
        }     
    }
    
    public function action_edit()
    {         
        $this->template->title = 'Админка';      
        $this->template->scripts = array();
        $this->template->styles = array('admin.css');
        
        $code = Arr::get($_POST, 'code');
        
        if(isset($code)) $draw = Model::factory('drawing')->search($code);
        Arr::_print($draw);
        
        $this->template->block_header = null;
        $this->template->block_topnav = null;
        $this->template->block_right = null;
        $this->template->block_center = View::factory('admin/v_admin_edit')->bind('draw', $draw);
        $this->template->block_right = View::factory('admin/v_admin_nav');
        $this->template->block_footer = null;    
    }
    
}
