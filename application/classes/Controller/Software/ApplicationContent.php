<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Software_Applicationcontent extends Controller_Base {

    public $equipment;
    
    public function action_index()
    {   
        $this->template->styles = array('style.css', 'header.css', 'application.css');
        $scripts = array('jquery.js', 'application/application_one_show_box.js', 'application/app_update.js');
        $this->template->scripts = $scripts;
        
        $app_id = $this->request->query('app_id');
        
        if($app_id) $app = new Object_Application($app_id);
        else exit('error method action_index');

        $product_ids = $this->getArrayItem($app->content, 'id', 'product_id');//create array id product

        $products = $this->getArrayOfObjects($product_ids, 'Object_Product', array('getNeededCount'), array('getNeededCount' => $app_id));

        //Arr::_print($products);
        
        $this->template->block_center = View::factory('software/application/v_app_one_content')
                        ->set('products', $products)->set('app', $app)->set('number_position', 1);
        $this->template->block_right = View::factory('software/application/v_app_one_menu');      

        $this->template->block_header = View::factory('header/v_header_auth');
       
    }
    
    public function action_updateApp() 
    {
        $data = $_POST;
        $data['date'] = strtotime($data['date']);
        $res = Model::factory('Application')->update($data);
        if($res) $this->redirect("/software/applicationcontent?app_id={$data['app_id']}");
        else exit('error action_updateApp');
    }
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