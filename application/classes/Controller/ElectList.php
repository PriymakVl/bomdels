<?php defined('SYSPATH') or die('No direct script access.');

class Controller_ElectList extends Controller_Base {

    
    public function action_index()
    {       
        $this->template->styles = array('style.css', 'header.css', 'elect.css');
        $scripts = array('jquery.js');
        $this->template->scripts = $scripts;
        
        $lists = Model::factory('ElectList')->getAll();

        $this->template->block_header = View::factory('header/v_header_auth')->bind('code', $this->code)->bind('employee_name', $employee_name);
        $this->template->block_center = View::factory('elect/v_electlist_content')->bind('lists', $lists);
        $this->template->block_right = View::factory('elect/v_electlist_menu');
        
    }
    
    //add list other user to lists employee
    public function action_addList() {
        $list_id = $this->request->post('list_id');
        if(!$this->employee->id) exit('error - action_addList - not eployee');

        $res = Model::factory('ElectEmployeeList')->add($this->employee->id, $list_id);
        if(!$res) exit('error - action_addList - add list');
        else $this->redirect('/');
    }
    
    public function action_deleteListByAdmin() {
        $list_id = $this->request->post('list_id');
        $elem = Model::factory('Elect')->deleteAllElementsOfList($list_id);

        $res = Model::factory('ElectList')->delete($list_id);
        if($res) $res = Model::factory('ElectEmployeeList')->delete($list_id);
        echo $res;
        exit();
    }
    
    
    
}