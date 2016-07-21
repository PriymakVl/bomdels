<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Elect extends Controller_Base {

    
    public function action_index()
    {       
        $this->template->styles = array('style.css', 'header.css', 'elect.css');
        $scripts_1 = array('jquery.js', 'elect/elect_delete.js', 'elect/elect_edit.js', 'elect/show_box_elect.js', 'employee/employee_auth.js', 'employee/employee_registr.js');
        $scripts_2 = array('elect/list_elect_add.js', 'elect/list_elect_delete.js', 'elect/list_elect_edit.js', 'elect/show_box_list.js', 'elect/show_box_registr.js');
        $scripts_3 = Arr::merge($scripts_1, $scripts_2);
        $scripts_4 = array('elect/show_box_full_description_element.js');
        $scripts = Arr::merge($scripts_3, $scripts_4);
        $this->template->scripts = $scripts;

        //Cookie::set('list_default', 'сандбирста');
        $list_default_id = Cookie::get('list_default');
        $list_employee_id = Cookie::get('list_employee');

        //if ($user_id && $list_user)$elected = Model::factory('Elect')->get($user_id, $list_user);
//        else if ($list_default) $elected = Model::factory('Elect')->get('1', $list_default);
//        else $elected = Model::factory('Elect')->get('1', $list_default); 
        
        if($list_employee_id) {
            $elected = Model::factory('Elect')->getEmployeeElect($this->employee->id, $list_employee_id);
            $type_list = 'employee';
            $list = Model::factory('ElectList')->getListById($list_employee_id);  
        }
        else  {
            $elected = Model::factory('Elect')->getDefaultElect($list_default_id);
            $type_list = 'default'; 
            $list = Model::factory('ElectList')->getListById($list_default_id);  
        }
        
        $default_lists = Model::factory('ElectList')->getListsDefault();
        //Arr::_print($default_lists);
        $employee_lists = $this->employee->elect_lists;
        //Arr::_print($employee_lists);
        $employee_name = $this->employee->getFullNameEmployee();
        //Arr::_print($this->employee);
        $elements = $this->getArrayElectElements($elected);
        //Arr::_print($list);
        
        $lists_for_edit = ($this->employee->role == 'admin') ? $default_lists : $employee_lists;
       // Arr::_print($info);
        $this->template->block_header = View::factory('header/v_header_auth')->bind('code', $this->code)->bind('employee_name', $employee_name);
        $this->template->block_center = View::factory('elect/v_elect_content')->set('list', $list)->bind('elements', $elements)->bind('default_lists', $default_lists)
                                                    ->bind('employee_lists', $employee_lists)->bind('type_list', $type_list)->bind('lists_edit', $lists_for_edit);
        $this->template->block_right = View::factory('elect/v_elect_menu');
        
    }
    
    public function action_changeDefaultList() {
        $list_id = $this->request->query('list_id');
        Cookie::set('list_default', $list_id);
        Cookie::delete('list_employee');
        $this->redirect('/');
    }
    
     public function action_changeEmployeeList() {
        $list_id = $this->request->query('list_id');
        Cookie::set('list_employee', $list_id);
        Cookie::delete('list_default');
        $this->redirect('/');
    }
    
    public function action_addEmployee() {
        $list_id = Cookie::get('list_employee');
        
        if(!$list_id) {
            $list_id = Model::factory('ElectList')->getIdDefaultListOfEmployee($this->employee->id); 
            Cookie::set('list_employee', $list_id);   
        }
        $elem_id = $this->request->query('elem_id');
        $kind = $this->request->query('kind');
        $employee_id = $this->employee->id;
        
        $res = Model::factory('Elect')->add($employee_id, $elem_id, $kind, $list_id);
        if(!$res) exit('error add element in elect');
        $this->redirect('/');
    }
    
        public function action_addDefault() {
//        $user_id = Cookie::get('user_id');
//        $user_id = $user_id ? $user_id : 1;
        $list_id = Cookie::get('list_default');
        $list_id = $list_id ? $list_id : 1;
        
        $elem_id = $this->request->query('elem_id');
        $kind = $this->request->query('kind');
        $employee_id = $this->employee->id;
        
        $res = Model::factory('Elect')->add($employee_id, $elem_id, $kind, $list_id);
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
        
        $res = Model::factory('ElectList')->add($this->employee->id, $list_name, $rating, $description);
        if(!$res) exit('error - action_addList');
        else $this->redirect('/');
    }
    
    public function action_deleteList() {
        $list_id = $this->request->query('list_id');
        $elem = Model::factory('Elect')->getElectByListId($list_id);
        if($elem) {
            echo 'full';
            exit();    
        }
        $res = Model::factory('ElectList')->delete($list_id);
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