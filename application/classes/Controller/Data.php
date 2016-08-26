<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Data extends Controller_Base {

    public $equipment;
    
    public function action_index()
    {   
        $this->template->styles = array('style.css', 'header.css', 'data.css');
        $scripts = array('jquery.js', 'data/data_show_box.js', 'data/data_edit.js', 'elect/data_elect_add.js');//'auto_add_sundbirsta.js'
        $this->template->scripts = $scripts;
        
        $detail_id = $this->request->query('id');
        $equipment = $this->request->query('equipment');

        if(!(int) $detail_id) exit('id detail does not validation');
        
        if($equipment == 'sundbirsta') $detail = new Object_Sundbirsta($detail_id);
        if($equipment == 'danieli') $detail = new Object_Danieli($detail_id);
        if($equipment == 'crane') $detail = new Object_Crane($detail_id);
        if(empty($detail)) exit('error action_index');
        $detail->getParent();
        $detail->cutNote(50, true);
        //Arr::_print($detail);
        //Arr::_print($detail);
        $breadcrumbs = $this->getBreadcrumbs($detail->code, $equipment);
        
        View::bind_global('detail', $detail);
        $this->template->block_header = View::factory('header/v_header_breadcrumbs')->bind('breadcrumbs', $breadcrumbs);
        $this->template->block_center = View::factory('data/v_data_content');
        $this->template->block_right = View::factory('data/v_data_menu');  
       
    }
    
    public function action_edit() {
        $equipment = $this->request->post('equipment');
        if($equipment == 'sundbirsta') $res = Model::factory('Sundbirsta')->update($_POST);
        else if($equipment == 'danieli') $res = Model::factory('Danieli')->update($_POST);
        else if($equipment == 'crane') $res = Model::factory('Crane')->update($_POST);
        echo $res;
        exit();
    }
    
    public function action_addNote() {
        $detail_id = $this->request->post('detail_id');
        $note = $this->request->post('note');
        $equipment = $this->request->post('equipment');
        
        $res = false;
        if($equipment == 'sundbirsta') $res = Model::factory('Sandbirsta')->addNote($detail_id, $note);
        else if($equipment == 'danieli') $res = Model::factory('Danieli')->addNote($detail_id, $note);
        else if($equipment == 'crane') $res = Model::factory('Crane')->addNote($detail_id, $note);
        if(!$res) exit('error action_addNote');
        
        $this->redirect('/data?id='.$detail_id.'&equipment='.$equipment);    
    }
    
//    public function action_addDetail() {
//        $data = Arr::extract($_POST, array('code', 'parent', 'equipment', 'rus'));
//
//        if($data['equipment'] == 'sundbirsta') $detail_id = Model::factory('Sandbirsta')->addDetail($data);
//        else if($data['equipment'] == 'danieli') $detail_id = Model::factory('Danieli')->addDetail($data);
//        if(!$detail_id) exit('error action addDetail');
//        
//        $this->redirect('/data?id='.$detail_id.'&equipment='.$data['equipment']); 
//    }
    
    public function action_addDetail()
    {
        $data = Arr::extract($_POST, array('code', 'rus', 'equipment'));
        if($data['rus'] == '') $data['rus'] = 'Название детали(узла) не указано';
        
        if($data['equipment'] == 'crane') $data['detail_id'] = Model::factory('Crane')->addDetail($data);
        else if($data['equipment'] == 'danieli') $data['detail_id'] = Model::factory('Danieli')->addDetail($data);
        else if ($data['equipment'] == 'sundbirsta') $data['detail_id'] = Model::factory('Sundbirsta')->addDetail($data);

        if (!$data['detail_id']) exit('error action_addDetail');
    }
    
    //private function addDetailCrane($data, $draw = null) 
//    {
//        if($draw) $data['item'] = $this->getItemDetailCranes($draw);
//        else $data['item'] = 0;
//        $detail_id = Model::factory('Crane')->addDetail($data);
//        if(!$detail_id) exit('error addDetailCrane'); 
//        if($draw) $this->addDraw($draw, $data, $detail_id); 
//        return $detail_id;             
//    }
//    
//    private function addDetailDanieli($data, $draw = null) 
//    {
//        if($draw) $data['item'] = $this->getItemDetailCranes($draw);
//        else $data['item'] = 0;
//        $detail_id = Model::factory('Danieli')->addDetail($data);
//        if(!$detail_id) exit('error addDetailDanieli'); 
//        if($draw) $this->addDraw($draw, $data, $detail_id); 
//        return $detail_id;             
//    }
//    
//    private function addDetailSundbirsta($data, $draw = null) 
//    {
//        if($draw) $data['item'] = $this->getItemDetailCranes($draw);
//        else $data['item'] = 0;
//        $detail_id = Model::factory('Sundbirsta')->addDetail($data);
//        if(!$detail_id) exit('error addDetailSundbirsta'); 
//        if($draw) $this->addDraw($draw, $data, $detail_id); 
//        return $detail_id;             
//    }
    
 //   public function addDraw($draw = '', $data, $detail_id) 
//    {
//        $data['file'] = $draw;
//        $data['detail_id'] = $detail_id;
//        
//        $arr = explode(".", $draw);
//        $folder = end($arr); 
//        $folder = strtolower($folder);//get extension file
//        if($data['equipment'] == 'cranes') $directory = '/media/drawings/cranes/'.$folder;
//        //Upload::save($_FILES, null, $directory);
//        if($data['equipment'] == 'danieli') $res = Model::factory('Drawingdanieli')->add($data, $folder);
//        else if($data['equipment'] == 'crane') $res = Model::factory('Drawingcrane')->add($data, $folder);
//        else if($data['equipment'] == 'sundbirsta') $res = Model::factory('Drawingsunbirsta')->add($data, $folder);
//        if(!$res) exit('error addDraw');
//        $obj_draw = new Object_Drawing();
//        $obj_draw->moveFile($folder, $draw, $data['equipment']);
//    }
//    
//    public function getItemDetailCranes($draw) 
//    {
//        if(!stripos($draw, '_')) return 0;
//        $sub = explode("_", $draw);
//        $str = explode('.', $sub[1]);    
//        return (int) $str[0];      
//    }
    
    public function action_deleteDetail()
    {
        $data = Arr::extract($_POST, array('detail_id', 'equipment', 'parent_code'));

        if($data['equipment'] == 'danieli') {
            $res = Model::factory('Danieli')->delete($data);
            if($res) $res = Model::factory('Drawingdanieli')->deleteDrawByDetail($data['detail_id']);
        }
        else if ($data['equipment'] == 'sundbirsta') {
            $res = Model::factory('Sundbirsta')->delete($data);
            if($res) $res = Model::factory('Drawingsundbirsta')->deleteDrawByDetail($data['detail_id']);    
        }
        else if ($data['equipment'] == 'crane') {
            $res = Model::factory('Crane')->delete($data);
            if($res) $res = Model::factory('Drawingcrane')->deleteDrawByDetail($data['detail_id']);    
        }
        echo $res;
        exit();
    }
   
    

}