<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Category extends Controller_Base {

    private $cats;

    public function action_index() 
    {
        
        $this->template->styles = array('style.css', 'header.css', 'category.css');
        $scripts = array('jquery.js', 'admin/category_delete.js', 'admin/category_add.js', 'admin/category_show_box.js', 'admin/category_edit.js', 'admin/category_add_content.js');
        
        $this->template->scripts = $scripts;
        $title = "Редактирование категорий";
        $this->template->title = $title;
        
        $cat_id = $this->request->query('cat_id', null);
        $equipment = $this->request->query('equipment', null);
        
        if($cat_id) {
            $cat = new Object_Category($cat_id);
            $cats = $cat->sub_id; 
            $equipment = $cat->equipment;    
        }
        else if($equipment) $cats = Model::factory('Category')->getMainCategories($equipment);
        else exit('error action_index');
        
        $this->cats = $this->getArrayOfObjects($cats, 'Object_Category');

        View::set_global('equipment', $equipment); 
        View::bind_global('category', $cat);
        View::set_global('info', "Перечень основных категорий <span>$equipment</span>");
        
        $this->template->block_header = View::factory('header/v_header_title')->bind('title', $title);
        if(isset($this->cats))$this->template->block_center = View::factory('category_admin/v_category_content')->bind('cats', $this->cats);
        else $this->template->block_center = View::factory('category_admin/v_category_not_content');
        $this->template->block_right = View::factory('category_admin/v_category_menu');
    }
    
    public function action_delete() {
        $cat_id = $this->request->post('cat_id');
        $heir = Model::factory('Category')->getIdSubCategoriesByParentId($cat_id);
        if($heir) {
            echo 'not empty';
            exit();
        }
        $res = Model::factory('Category')->delete($cat_id);
        echo $res;
        exit();  
    }
    
    public function action_add() {
        $res = Model::factory('Category')->add($_POST);
        echo $res[1];  
        exit();
    } 
    
    public function action_edit() {
        $res = Model::factory('Category')->update($_POST);
        echo $res[0];
        exit();
    }
    
    public function action_getSubCategories() {
        $cat_id = $this->request->post('cat_id');
        $res = Model::factory('Category')->getCategoriesByParentId($cat_id);
        if($res) echo json_encode($res);
        else false;
        exit();
    }
}