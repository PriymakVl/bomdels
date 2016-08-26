<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Software_Application extends Controller_Base {

    public $equipment;
    
    public function action_index()
    {   
        $this->template->styles = array('style.css', 'header.css', 'application.css');
        $scripts = array('jquery.js', 'application/set_active_category.js');
        $this->template->scripts = $scripts;

        $active_year = Cookie::get('active_year', date('Y'));
        $active_service = Cookie::get('active_service', 'Механики');
        $active_department = Cookie::get('active_department', 'all');

        $apps = Model::factory('Application')->getAll($active_year, $active_service, $active_department);

        $this->template->block_center = View::factory('software/application/v_app_all_content')
            ->set('active_year', $active_year)->set('apps', $apps)->set('active_service', $active_service)->set('active_department', $active_department);
        $this->template->block_right = View::factory('software/application/v_app_all_menu');    

        $this->template->block_header = View::factory('header/v_header_auth');
    }
    
    public function action_setActiveYear() 
    {
        $year = $this->request->query('active_year');
        if(!$year) exit('error action setActiveYear');
        Cookie::set('active_year', $year);
        $this->redirect('/software/application');
    }
    
    public function action_setActiveService() 
    {
        $service = $this->request->query('active_service');
        if(!$service) exit('error action setActiveService');
        Cookie::set('active_service', $service);
        $this->redirect('/software/application');
    }
    
    public function action_setActiveDepartment() 
    {
        $department = $this->request->query('active_department');
        if(!$department) exit('error action setActiveDepartment');
        Cookie::set('active_department', $department);
        $this->redirect('/software/application');
    }

//    
//    public function action_addNote() 
//    {
//        $detail_id = $this->request->post('detail_id');
//        $note = $this->request->post('note');
//        $equipment = $this->request->post('equipment');
//        
//        $res = false;
//        if($equipment == 'sundbirsta') $res = Model::factory('Sandbirsta')->addNote($detail_id, $note);
//        if($equipment == 'danieli') $res = Model::factory('Danieli')->addNote($detail_id, $note);
//        if(!$res) exit('error action addNote');
//        
//        $this->redirect('/data?id='.$detail_id.'&equipment='.$equipment);    
//    }
//    
//    public function action_addDetail() 
//    {
//        $data = Arr::extract($_POST, array('code', 'parent', 'equipment', 'rus'));
//        //Arr::_print($data);
//        if($data['equipment'] == 'sundbirsta') $detail_id = Model::factory('Sandbirsta')->addDetail($data);
//        else if($data['equipment'] == 'danieli') $detail_id = Model::factory('Danieli')->addDetail($data);
//        if(!$detail_id) exit('error action addDetail');
//        
//        $this->redirect('/data?id='.$detail_id.'&equipment='.$data['equipment']); 
//    }
   
    

}