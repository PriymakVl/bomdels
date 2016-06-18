<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_CategoryContent extends Controller_Base {

    private $cats;

    public function action_index() 
    {
        $this->template->styles = array('style.css', 'header.css', 'category.css');
        $scripts_1 = array('jquery.js', 'admin/content/content_cat_show_box.js', 'admin/content/content_cat_delete.js', 'admin/content/content_cat_add.js');
        $scripts_2 = array('admin/content/content_cat_edit.js');
        $scripts = array_merge($scripts_1, $scripts_2);
        $this->template->scripts = $scripts;
        
        $title = "Редактирование контента категорий";
        $cat_id = $this->request->query('cat_id');
        if($cat_id) $cat = new Object_Category($cat_id);
        else exit('Error not cat_id - action_index');
        
        View::bind_global('cat', $cat);
        $details = $this->getArrayNodes($cat);
        //Arr::_print($details);
        
        $this->template->block_header = View::factory('header/v_header_title')->bind('title', $title);
        $this->template->block_center = View::factory('category_admin/v_cat_content_content')->bind('details', $details);
        $this->template->block_right = View::factory('category_admin/v_cat_content_menu');
    }
    
    public function action_delete() {
        $res = Model::factory('CategoryContent')->delete($_POST);
        echo $res;
        exit();  
    }
    
    public function action_add() {
        $cat_id = $this->request->post('cat_id');
        $heir = Model::factory('Category')->getIdSubCategoriesByParentId($cat_id);
        if($heir) {
            echo 'not empty';
            exit();
        }
        $res = Model::factory('CategoryContent')->add($_POST);
        echo $res[1];  
        exit();
    } 
    
    public function action_edit() {
        $res = Model::factory('CategoryContent')->update($_POST);
        echo $res;
        exit();
    }
    
}