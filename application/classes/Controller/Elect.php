<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Elect extends Controller_Base {

    
    public function action_index()
    {       
        $this->template->styles = array('style.css', 'header.css', 'elect.css');
        $scripts_1 = array('jquery.js', 'elect/elect_delete.js', 'elect/elect_edit.js', 'elect/show_box_elect.js', 'user/user_auth.js', 'user/user_registr.js');
        $scripts_2 = array('elect/list_elect_add.js', 'elect/list_elect_delete.js', 'elect/list_elect_edit.js', 'elect/show_box_list.js', 'elect/show_box_registr.js');
        $scripts_3 = Arr::merge($scripts_1, $scripts_2);
        $scripts_4 = array('elect/show_box_full_description_element.js');
        $scripts = Arr::merge($scripts_3, $scripts_4);
        $this->template->scripts = $scripts;

        //Cookie::set('list_default', 'сандбирста');
        $list_id = Cookie::get('list_id'); 
        if(!$list_id) $list_id = 1;//список планировка участков
        
        $elected = Model::factory('Elect')->get($list_id);
        
        $list = new Object_Electlist($list_id);  

        //get array default list for create of the menu
        $default_lists_ids = Model::factory('ElectUserList')->getDefoltListIds();
        $default_menu_lists = $this->getArrayOfObjects($default_lists_ids, 'Object_Electlist');

        if($this->user) {
            if($this->user->elect_lists != false)$user_menu_lists = $this->getArrayOfObjects($this->user->elect_lists, 'Object_Electlist');    
        }
        
        $elements = $this->getArrayElectElements($elected);

       // Arr::_print($info);
        $this->template->block_header = View::factory('header/v_header_auth')->bind('code', $this->code);
        $this->template->block_center = View::factory('elect/v_elect_content')->set('list', $list)->bind('elements', $elements)->bind('default_lists', $default_menu_lists)
                                                    ->bind('user_lists', $user_menu_lists);
        $this->template->block_right = View::factory('elect/v_elect_menu');
        
    }
    
    public function action_changeList() {
        $list_id = $this->request->query('list_id');
        Cookie::set('list_id', $list_id);
        $this->redirect('/');
    }
    
    public function action_addElectElement() {
        $list_id = Cookie::get('list_id');
        
        if(!$list_id) exit('error action_addElectElement - not list id');
        $user_id = $this->user->id;
        
        $check = Model::factory('ElectList')->checkListIsEmployee($user_id, $list_id); 
        if(!$check) exit('error action_addElectElement - check list');
       
        $elem_id = $this->request->query('elem_id');
        $kind = $this->request->query('kind');
        //add description from note detail

        if($kind  == 'danieli') $detail = Model::factory('Danieli')->getDetailById($elem_id);
        else if($kind  == 'sundbirsta') $detail = Model::factory('Sandbirsta')->getDetailById($elem_id);
        else $detail['note'] = '';
        
        $res = Model::factory('Elect')->add($user_id, $elem_id, $kind, $list_id, $detail['note']);
        if(!$res) exit('error add element in elect');
        $this->redirect('/');
    }
    
    //delete the element from list elect
    public function action_delete() {
        $elect_id = $this->request->query('elect_id');
        $res = Model::factory('Elect')->delete($elect_id);
        if(!$res) exit('error action_delete');
        $this->redirect('/');   
    }
    //add new list to lists elect
    public function action_addList() {
        $list_name = trim($this->request->post('listname'));
        $rating = trim($this->request->post('rating'));
        $description = trim($this->request->post('description'));
        if(!$this->employee->id) exit('error - action_addList - not user');
        
        $list_id = Model::factory('ElectList')->add($this->user->id, $list_name, $rating, $description);

        $res = Model::factory('ElectUserList')->add($this->user->id, $list_id);
        if(!$res) exit('error - action_addList - add list');
        else $this->redirect('/');
    }
    
    public function action_deleteList() {
        $list_id = $this->request->query('list_id');
        $elem = Model::factory('Elect')->get($list_id);
        if($elem) {
            echo 'full';
            exit();    
        }
        $res = Model::factory('ElectList')->delete($list_id);
        if($res) $res = Model::factory('ElectEmployeeList')->delete($list_id);
        echo $res;
        exit();
    }
    
    public function action_updateList() {
        $data = Arr::extract($_POST, array('list_id', 'listname', 'rating', 'description'));
        $data['rating'] = trim($data['rating']);
        $data['listname'] = trim($data['listname']);
        $data['description'] = trim($data['description']);
        $res = Model::factory('ElectList')->update($data);
        if(!$res) exit('error - action_updateList');
        else $this->redirect('/');
    }
    
    public function action_updateElement() {
        $data = Arr::extract($_POST, array('elect_id', 'rating', 'description')); 
        //Arr::_print($data);
        $res = Model::factory('Elect')->update($data);
        if(!$res) exit('error - action_updateElement');
        else $this->redirect('/');   
    }
    
    private function getArrayElectElements($elected) {
        $elements = array();
        foreach ($elected as $elect) {
            if ($elect['kind'] == 'sundbirsta') {
                $obj = new Object_Sundbirsta($elect['elem_id']); 
                $obj->setElectName($obj->rus);   
            }
            else if ($elect['kind'] == 'danieli') {
                $obj = new Object_Danieli($elect['elem_id']); 
                $obj->setElectName($obj->rus);   
            }
            else if ($elect['kind'] == 'category') {
                $obj = new Object_Category($elect['elem_id']); 
                $obj->setElectName($obj->title);   
            } 
            else exit('erorr select equipment');
            $obj->setElectId($elect['id']);
            $obj->setKindElect($elect['kind']);//for create link on page site
            $obj->setElectRatign($elect['rating']);
            $obj->setElectDescription($elect['description']);
            $obj->cutElectDescription($elect['description'], 25);
            $elements[] = $obj;
       }
        return $elements;
    }
    
}