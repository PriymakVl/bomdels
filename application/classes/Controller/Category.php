<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Category extends Controller_Base {
    
    public function action_index() {
        $cat_id = $this->request->query('cat_id');
        
        if($cat_id) $cat =  Model::factory('Category')->getCategoryById($cat_id); 
        else exit('error not cat_id action_index');
        
        if($cat['equipment'] == 'danieli') $this->action_danieli();
        else if($cat['equipment'] == 'sundbirsta') $this->action_sundbirsta();    
    }

    
    public function action_danieli()
    {   
        $this->template->scripts = array('jquery.js', 'equipment_search_placeholder.js', 'equipment_check_search_form.js', 'elect/category_elect_add.js');
        
        $equipment = 'danieli';

        $cat_id = $this->request->query('cat_id');

        if(isset($cat_id)) {          
            $cats = Model::factory('Category')->getCategoriesByParentId($cat_id);
            $cat =  Model::factory('Category')->getCategoryById($cat_id); 
            $info = $cat['title'];   
        }
        else {
            $cats = Model::factory('Category')->getMainCategories($equipment);
            $info = 'перечень основного оборудования';    
        }

        if(isset($cats)) $cats = $this->getArrayOfObjects($cats, 'Object_Category');
        else exit('error - action_danieli');
        //Arr::_print($cats);
        View::bind_global('info', $info);
        View::bind_global('cat', $cat);
        View::bind_global('equipment', $equipment);

        $this->template->block_header = View::factory('header/v_header_search'); 
        $this->template->block_right = View::factory('category/v_category_menu');
        $this->template->block_center = View::factory('category/v_category_content')->bind('cats', $cats);  
    }
    
     public function action_content()
    {   
        $this->template->scripts = array('jquery.js', 'equipment_search_placeholder.js', 'equipment_check_search_form.js', 'elect/cat_content_elect_add.js');

        $cat_id = $this->request->query('cat_id');

        if($cat_id) {
            $cat = new Object_Category($cat_id);
            $info = $cat->title;    
        }
        else exit('Error not cat_id - action_content');

        $details = $this->getArrayNodes($cat);

        //Arr::_print($details);
        View::bind_global('info', $info);
        //View::bind_global('cat', $cat);
        View::set_global('equipment', 'danieli');

        $this->template->block_header = View::factory('header/v_header_search'); 
        $this->template->block_right = View::factory('category/v_category_menu');
        $this->template->block_center = View::factory('category/v_cat_content_content')->bind('details', $details);  
    }
    
}
    