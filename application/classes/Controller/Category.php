<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Category extends Controller_Base {
    
    public function action_index() 
    {
        $this->template->styles = array('style.css', 'header.css', 'category.css');
        
        $cat_id = $this->request->query('cat_id', null);
        $equipment = $this->request->query('equipment', null);
        
  
        if(isset($cat_id)) {          
            $cats = Model::factory('Category')->getCategoriesByParentId($cat_id);
            $cat =  new Object_Category($cat_id); 
            $info = $this->getCategoryBreadcrumbs($cat); 
            if($cat->equipment == 'danieli') $section = 'Danieli';
            else if($cat->equipment == 'sundbirsta') $section = 'Sundbirsta';
            else if($cat->equipment == 'crane') $section = 'Грузоподъемное';  
        }
        else if($equipment) {
            $cats = Model::factory('Category')->getMainCategories($equipment);
            $info = 'перечень основного оборудования'; 
            if($equipment == 'danieli') $section = 'Danieli';
            else if($equipment == 'sundbirsta') $section = 'Sundbirsta';
            else if($equipment == 'crane') $section = 'Грузоподъемное';   
        }
        else exit('error action_index');

        if(isset($cats)) $cats = $this->getArrayOfObjects($cats, 'Object_Category');
        else exit('error - action_index');
        
        
        //Arr::_print($cats);
        View::bind_global('info', $info);
        View::bind_global('section', $section);

        $this->template->block_header = View::factory('header/v_header_search')->bind('equipment', $equipment); 
        $this->template->block_right = View::factory('category/v_category_menu');
        $this->template->block_center = View::factory('category/v_category_content')->bind('cats', $cats);    
    }
    
     public function action_content()
    {   
        $this->template->styles = array('style.css', 'header.css', 'category.css');
        $this->template->scripts = array('jquery.js', 'equipment_search_placeholder.js', 'equipment_check_search_form.js', 'elect/cat_content_elect_add.js');

        $cat_id = $this->request->query('cat_id');

        if($cat_id) {
            $cat = new Object_Category($cat_id);
            $info = $this->getCategoryBreadcrumbs($cat);
            $equipment = $cat->equipment;    
        }
        else exit('Error not cat_id - action_content');

        $details = $this->getArrayNodes($cat);

        if($cat->equipment == 'danieli') $section = 'Danieli';
        else if($cat->equipment == 'sundbirsta') $section = 'Sundbirsta';
        else if($cat->equipment == 'crane') $section = 'Грузоподъемное';
        //Arr::_print($details);
        View::bind_global('info', $info);
        View::bind_global('cat', $cat);
        View::set_global('section', $section);

        $this->template->block_header = View::factory('header/v_header_search')->bind('equipment', $equipment); 
        $this->template->block_right = View::factory('category/v_category_menu');
        $this->template->block_center = View::factory('category/v_cat_content_content')->bind('details', $details)->bind('cat', $cat);  
    }
    
    private function getCategoryBreadcrumbs($cat)
    {
        if(!$cat->parent_id) return $cat->title;
        $cats = array();
        $cats[] = $cat;
        $cat = new Object_Category($cat->parent_id); 
        $cats[] = $cat;
        if(!$cat->parent_id) return $this->createStringBreadcrumbs($cats);
        $cat = new Object_Category($cat->parent_id); 
        $cats[] = $cat;
        if(!$cat->parent_id) return $this->createStringBreadcrumbs($cats);
        $cat = new Object_Category($cat->parent_id); 
        $cats[] = $cat;
        if(!$cat->parent_id) return $this->createStringBreadcrumbs($cats);
        $cat = new Object_Category($cat->parent_id); 
        $cats[] = $cat->alias ? $cat->alias : $cat->title;
        return $this->createStringBreadcrumbs($cats);
    }
    
    private function createStringBreadcrumbs($cats)
    {
        //Arr::_print($cats);
        $breadcrubs = '';
        $cats = array_reverse($cats);
        foreach ($cats as $cat) {
            $alias = $cat->alias ? $cat->alias : $cat->title;
            $breadcrubs .=  '<a href="/category?cat_id='.$cat->id.'">'.$alias.'</a>';       
        }
        return $breadcrubs;
    }
    
}
    