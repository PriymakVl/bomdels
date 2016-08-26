<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Software_Product extends Controller_Base {
    
    public function action_index()
    {   
        $this->template->styles = array('style.css', 'header.css', 'application.css');
        $scripts = array('jquery.js');
        $this->template->scripts = $scripts;
        
        $product_id = $this->request->query('product_id');
        $app_id = $this->request->query('app_id');
        //if($item_id) $item = Model::factory('ApplicationContent')->get($product_id);
        //else exit('error method action_index');
        
        $app = new Object_Application($app_id);
        $product = new Object_Product($product_id);
        
        //Arr::_print($app);
        
        $this->template->block_center = View::factory('software/application/v_product_content')->set('product', $product)->set('app', $app);
        $this->template->block_right = View::factory('software/application/v_product_menu');      
        $this->template->block_header = View::factory('header/v_header_auth');
       
    }
    
    //public function action_edit() {
//        $equipment = $this->request->post('equipment');
//        if($equipment == 'sundbirsta') $res = Model::factory('Sundbirsta')->update($_POST);
//        else if($equipment == 'danieli') $res = Model::factory('Danieli')->update($_POST);
//        echo $res;
//        exit();
//    }
//    
//    public function action_addNote() {
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
//    public function action_addDetail() {
//        $data = Arr::extract($_POST, array('code', 'parent', 'equipment', 'rus'));
//        //Arr::_print($data);
//        if($data['equipment'] == 'sundbirsta') $detail_id = Model::factory('Sandbirsta')->addDetail($data);
//        else if($data['equipment'] == 'danieli') $detail_id = Model::factory('Danieli')->addDetail($data);
//        if(!$detail_id) exit('error action addDetail');
//        
//        $this->redirect('/data?id='.$detail_id.'&equipment='.$data['equipment']); 
//    }
   
    

}