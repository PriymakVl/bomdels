<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Electlist extends Controller_Base {

    
    public function action_index()
    {       
        $this->template->styles = array('style.css', 'header.css', 'elect.css');
        $scripts1 = array('jquery.js', 'elect/add_list_menu.js', 'elect/delete_list_menu.js', 'elect/show_elements_list.js', 'elect/sort_list_type.js');
        $scripts2 = array('elect/show_box_menu_electlist.js');
        $scripts = Arr::merge($scripts1, $scripts2);
        $this->template->scripts = $scripts;
        
        $user_id = $this->request->query('user_id');
        $type = $this->request->query('type');

        if($user_id) {
            $title_table = 'Перечень списков в вашем меню';
            if($type) $list_ids = Model::factory('ElectUserList')->sort($type, $user_id);
            else $list_ids = Model::factory('ElectUserList')->getListIds($user_id);
            $lists = $this->getArrayOfObjects($list_ids, 'Object_Electlist', array('getLoginUser'));
            $all_lists = false; //for show link all lists
        }
        else {
            $title_table = 'Перечень всех списков';
            if($type) $list_ids = Model::factory('ElectList')->sort($type);
            else $list_ids = Model::factory('ElectList')->getAll();
            $lists = $this->getArrayOfObjects($list_ids, 'Object_Electlist', array('getLoginUser'));
            $all_lists = true; //for show link all lists
        }
        //Arr::_print($lists);
        $this->template->block_header = View::factory('header/v_header_auth')->bind('code', $this->code);
        $this->template->block_center = View::factory('elect/v_electlist_content')->bind('lists', $lists)->bind('title_table', $title_table);
        $this->template->block_right = View::factory('elect/v_electlist_menu')->bind('all_lists', $all_lists);
        
    }
    
    //add list other user to lists user
    public function action_addListMenu() {
        $list_id = $this->request->post('list_id');
        $res = Model::factory('ElectUserList')->add($this->user->id, $list_id);
        if($res) echo $res[1];
        else echo 'not';
        exit();
    }
    
    public function action_deleteListMenu() {
        $list_id = $this->request->post('list_id');

        $res = Model::factory('ElectUserList')->delete($list_id);
        if($res) echo $res;
        else echo 'not';
        exit();
    }
    
    
    
}