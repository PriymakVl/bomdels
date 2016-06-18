<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Equipment extends Controller_Base {

    
    public function action_danieli()
    {   
        $this->template->scripts = array('jquery.js', 'equipment_search_placeholder.js', 'equipment_check_search_form.js');
        
        $equipment = 'danieli';
        //get all details which has not parent
        //$all = Model::factory('danieli')->getAll();
        //$all = Model::factory('danieli')->getDetailByType('schema');
        //Arr::_print($main);
        $cat_id = $this->request->query('cat_id');
        $code = $this->request->query('code');

//        else 
        if(isset($code)) {
            $sub_ids = Model::factory('Danieli')->getIdSubDetailsByCode($code);
            $cat =  Model::factory('Category')->getCategoryById($cat_id); 
            $info = $cat['title'];       
        }
        else if(isset($cat_id)) {
            
            $cats = Model::factory('Category')->getCategoriesByParentId($cat_id);
            $cat =  Model::factory('Category')->getCategoryById($cat_id); 
            $info = $cat['title'];   
        }
        else {
            $cats = Model::factory('Category')->getMainCategories($equipment);
            $info = 'перечень основного оборудования';    
        }

        if(isset($cats)) $cats = $this->getArrayOfObjects($cats, 'Object_Category');
        else if(isset($sub_ids)) $elements = $this->getArrayOfObjects($sub_ids, 'Object_Danieli');
        else exit('error - action_danieli');
        
        View::bind_global('info', $info);
        View::bind_global('equipment', $equipment);
        //Arr::_print($details);
        //$main = $this->getMain($all, 'Object_Danieli');
        //Arr::_print($main);
        $this->template->block_header = View::factory('header/v_header_search'); 
        $this->template->block_right = View::factory('equipment/v_equipment_menu');
        if(isset($cats)) $this->template->block_center = View::factory('equipment/v_equipment_categories')->bind('cats', $cats);
        else if(isset($elements)) $this->template->block_center = View::factory('equipment/v_equipment_content')->bind('elements', $elements);  
        else exit('error not array data - action_danieli');   
    }
    
    private function getMain($all, $class_name) {
        $main = array();
        foreach ($all as $item) {
            $parent = Model::factory('danieli')->getDetailByCode($item['parent_code']);
            if(!$parent) $main[] = new $class_name($item['id']);
        }
        return $main;
    }
    
}
    