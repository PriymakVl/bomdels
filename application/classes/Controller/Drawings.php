<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Drawings extends Controller_Base {

    
    public function action_index()
    {   
        $this->template->styles = array('style.css', 'drawings.css', 'header.css');
        $script_1 = array('jquery.js', 'drawings/drawings_show_box.js', 'drawings/drawings_delete.js', 'drawings/drawings_add_note.js');
        $script_2 = array('drawings/drawings_add_draw.js');
        $script = array_merge($script_1, $script_2);
        $this->template->scripts = $script;
        
        $detail_id = $this->request->query('id');
        $equipment = $this->request->query('equipment');
        
        if(!(int) $detail_id) exit('id detail does not validation');
        if(!$equipment) exit('error not equipment');
        
        if($equipment == 'sundbirsta') $detail = new Object_Sundbirsta($detail_id);
        else if($equipment == 'danieli') $detail = new Object_danieli($detail_id); 
        else exit('equipment not been exist');
        if(empty($detail)) exit('detail not been exist');
        //$detail->getdrawings();
        $draws = $this->getArrayOfObjects($detail->drawings, 'Object_Drawing', array('cutNote'));
        //Arr::_print($draws);
        
        View::bind_global('detail', $detail);
        $breadcrumbs = $this->getBreadcrumbs($detail->code, $equipment);
        //Arr::_print($draw);
        $this->template->block_right = View::factory('drawings/v_drawings_menu');
        $this->template->block_center = View::factory('drawings/v_drawings_content')->bind('draws', $draws);
        $this->template->block_header = View::factory('header/v_header_breadcrumbs')->bind('breadcrumbs', $breadcrumbs);
    }
    
    public function action_addSundbirsta() {
        $detail_id = $this->request->post('id');
        $equipment = $this->request->post('equipment');
        $type = $this->request->post('type');
        $file_name = $_FILES['draw']['name'];
        
        $detail = new Object_Sundbirsta($detail_id);
        //move file on server
        $move = Object_Drawing::moveFilePDF($equipment, $file_name);
        if(!$move) exit('error move file');
        //add info file in database
        $draw = Model::factory('drawing')->getDrawingByNameFile($file_name);
        if($draw) {
            $this->redirect('/drawings?id='.$detail->id);    
        }
        else { 
            $res = Model::factory('drawing')->add($type, $file_name,  $folder, $detail->code, $detail->id, $equipment);
            if(!$res) exit('error add file');
            $this->redirect('/drawings?id='.$detail_id);    
        }
    }
    
    public function action_delete() {
        $draw_id = $this->request->query('draw_id');
        if(!(int)$draw_id) exit('not id draw'); 
        $draw = Model::factory('drawing')->getDrawingById($draw_id);
        if($draw['equipment'] == 'sundbirsta') $detail = new Object_Sundbirsta($draw['detail_id']);
        $res = Model::factory('drawing')->delete($draw_id);
        if(!$res) exit('error delete drawing');
        $this->redirect('/drawings?id='.$detail->id.'&equipment='.$draw['equipment']);
    }
    
    public function action_addNote() {
        $draw_id = $this->request->post('draw_id');
        $note = $this->request->post('note');
        if(!(int)$draw_id) exit('not id draw'); 
        $draw = Model::factory('drawing')->getDrawingById($draw_id);
        if($draw['equipment'] == 'sundbirsta') $detail = new Object_Sundbirsta($draw['detail_id']);
        if($draw['equipment'] == 'danieli') $detail = new Object_danieli($draw['detail_id']);
        if(!$detail) exit('error not create object detail');
        $res = Model::factory('drawing')->addNote($draw_id, $note);
        if(!$res) exit('error add note drawing');
        $this->redirect('/drawings?id='.$detail->id.'&equipment='.$draw['equipment']);    
    }
    
    public function action_addDraw() {
        //Arr::_print($_POST);
        $equipment = $this->request->post('equipment');
        $detail_id = $this->request->post('id');
        $filename = $this->request->post('file');
        $code = $this->request->post('code');
        $type = $this->request->post('type');
        $arr = explode(".", $filename);
        $folder = end($arr); //get extension file
        
        if($equipment == 'danieli') $res = Model::factory('Drawing')->add($type, $filename, $code, $detail_id, $equipment, $folder);
        if(!$res) exit('error add drawing');
        $this->redirect('/drawings?id='.$detail_id.'&equipment='.$equipment);
    }
    

}