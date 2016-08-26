<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Drawings extends Controller_Base {

    
    public function action_index()
    {   
        $this->template->styles = array('style.css', 'drawings.css', 'header.css');
        $script_1 = array('jquery.js', 'drawings/drawings_show_box.js', 'drawings/drawings_delete.js', 'drawings/drawings_add_note.js');
        $script_2 = array('drawings/drawings_add_draw.js', 'drawings/drawings_edit_rating.js');
        $script = array_merge($script_1, $script_2);
        $this->template->scripts = $script;
        
        $detail_id = $this->request->query('id');
        $equipment = $this->request->query('equipment');

        if(!(int) $detail_id || !$equipment) exit('error action_index');
        
        if($equipment == 'sundbirsta') {
            $detail = new Object_Sundbirsta($detail_id);  
            $draws = $this->getArrayOfObjects($detail->drawings, 'Object_Drawingsundbirsta', array('cutNote'), array('cutNote' => 50));  
        }
        else if($equipment == 'danieli') {
            $detail = new Object_Danieli($detail_id);
            $draws = $this->getArrayOfObjects($detail->drawings, 'Object_Drawingdanieli', array('cutNote'), array('cutNote' => 50));   
        } 
        else if($equipment == 'crane') {
            $detail = new Object_Crane($detail_id); 
            $draws = $this->getArrayOfObjects($detail->drawings, 'Object_Drawingcrane', array('cutNote'), array('cutNote' => 50));        
        } 

        if(empty($detail)) exit('error action_index');
        //$detail->getdrawings();
        
        View::bind_global('detail', $detail);
        $breadcrumbs = $this->getBreadcrumbs($detail->code, $equipment);

        $this->template->block_right = View::factory('drawings/v_drawings_menu');
        $this->template->block_center = View::factory('drawings/v_drawings_content')->bind('draws', $draws);
        $this->template->block_header = View::factory('header/v_header_breadcrumbs')->bind('breadcrumbs', $breadcrumbs);
    }
    
//    public function action_addSundbirsta() {
//        $detail_id = $this->request->post('id');
//        $equipment = $this->request->post('equipment');
//        $type = $this->request->post('type');
//        $file_name = $_FILES['draw']['name'];
//        
//        $detail = new Object_Sundbirsta($detail_id);
//        //move file on server
//        $move = Object_Drawing::moveFilePDF($equipment, $file_name);
//        if(!$move) exit('error move file');
//        //add info file in database
//        $draw = Model::factory('Drawingdanieli')->getDrawingByNameFile($file_name);
//        if($draw) {
//            $this->redirect('/drawings?id='.$detail->id);    
//        }
//        else { 
//            $res = Model::factory('Drawingdanieli')->add($type, $file_name,  $folder, $detail->code, $detail->id, $equipment);
//            if(!$res) exit('error add file');
//            $this->redirect('/drawings?id='.$detail_id);    
//        }
//    }
    
    public function action_addDraw() 
    {
        $data = Arr::extract($_POST, array('equipment', 'detail_id', 'code', 'file', 'type'));
        $this->addDraw($data);
    }
    
    public function action_delete() {
        $draw_id = $this->request->query('draw_id');
        if(!(int)$draw_id) exit('not id draw'); 
        $draw = Model::factory('Drawingdanieli')->getDrawingById($draw_id);
        if($draw['equipment'] == 'sundbirsta') $detail = new Object_Sundbirsta($draw['detail_id']);
        else if($draw['equipment'] == 'danieli') $detail = new Object_Danieli($draw['detail_id']);
        $res = Model::factory('Drawingdanieli')->delete($draw_id);
        if(!$res) exit('error delete drawing');
        $this->redirect('/drawings?id='.$detail->id.'&equipment='.$draw['equipment']);
    }
    
    public function action_addNote() {
        $draw_id = $this->request->post('draw_id');
        $note = $this->request->post('note');
        if(!(int)$draw_id) exit('not id draw'); 
        $draw = Model::factory('Drawingdanieli')->getDrawingById($draw_id);
        if($draw['equipment'] == 'sundbirsta') $detail = new Object_Sundbirsta($draw['detail_id']);
        if($draw['equipment'] == 'danieli') $detail = new Object_Danieli($draw['detail_id']);
        if(!$detail) exit('error not create object detail');
        $res = Model::factory('Drawingdanieli')->addNote($draw_id, $note);
        if(!$res) exit('error add note drawing');
        $this->redirect('/drawings?id='.$detail->id.'&equipment='.$draw['equipment']);    
    }
    
    public function action_updateRating() {
        $draw_id = $this->request->post('draw_id');
        $rating = $this->request->post('rating');
        $res = Model::factory('Drawingdanieli')->editRating($draw_id, $rating);
        echo $res;
        exit();       
    }
    

}