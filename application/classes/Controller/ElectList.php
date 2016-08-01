<?php defined('SYSPATH') or die('No direct script access.');

class Controller_ElectList extends Controller_Base {

    
    public function action_index()
    {       
        $this->template->styles = array('style.css', 'header.css', 'elect.css');
        $scripts = array('jquery.js', 'elect/add_list_menu.js', 'elect/delete_list_menu.js', 'elect/show_elements_list.js');
        $this->template->scripts = $scripts;
        
        $employee_id = $this->request->query('employee_id');
        
        if($employee_id) {
            $title_table = 'Перечень списков в вашем меню';
            $list_ids = Model::factory('ElectEmployeeList')->getListIds($employee_id);
            $lists = $this->getArrayOfObjects($list_ids, 'Object_Electlist', array('getLoginEmployee'));
            $all_lists = false; //for show link all lists
        }
        else {
            $title_table = 'Перечень всех списков';
            $list_ids = Model::factory('ElectList')->getAll();
            $lists = $this->getArrayOfObjects($list_ids, 'Object_Electlist', array('getLoginEmployee'));
            $all_lists = true; //for show link all lists
        }
        //Arr::_print($lists);
        $this->template->block_header = View::factory('header/v_header_auth')->bind('code', $this->code)->bind('employee_name', $employee_name);
        $this->template->block_center = View::factory('elect/v_electlist_content')->bind('lists', $lists)->bind('title_table', $title_table);
        $this->template->block_right = View::factory('elect/v_electlist_menu')->bind('all_lists', $all_lists);
        
    }
    
    //add list other user to lists employee
    public function action_addListMenu() {
        $list_id = $this->request->post('list_id');
        $res = Model::factory('ElectEmployeeList')->add($this->employee->id, $list_id);
        if($res) echo $res[1];
        else echo 'not';
        exit();
    }
    
    public function action_deleteListMenu() {
        $list_id = $this->request->post('list_id');

        $res = Model::factory('ElectEmployeeList')->delete($list_id);
        if($res) echo $res;
        else echo 'not';
        exit();
    }
    
    
    
}