<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Base extends Controller_Template {

    public $template = 'total/v_base';
    protected $employee;
    
    public function before()
    {
        parent::before();
        
        $this->template->title = 'ЦРМO СПС';
        
        $employee_id = Cookie::get('employee_id');
        
        $role = null;
        $employee = null;
        
        if($employee_id) {
            $this->employee = new Object_Employee($employee_id); 
            $employee = $this->employee; 
            $role = $this->employee->role;  
            $employee_name = $this->employee->getFullNameEmployee();
        }
        
        View::bind_global('employee_name', $employee_name);
        View::bind_global('employee', $employee);
        View::bind_global('role', $role);    
        
        $this->template->styles = array('style.css', 'header.css');
        $this->template->scripts = array('jquery.js');
        
        $this->template->block_header = null;
        $this->template->block_right = null;
        $this->template->block_center = null;
        $this->template->block_footer = View::factory('total/v_footer');
    }
    
    protected function getNameCategory($cat_id) 
    {
        switch ($cat_id) {
            case 1: return 'Механика';
            case 2: return 'Гидравлика';
            case 3: return 'Смазка';
            case 4: return 'Узлы';
        }
    }
    
    protected function getArrayOfObjects($array, $class, $methods = false) 
    {
        $obj_array = array();
        foreach ($array as $item) {
            $obj = new $class ($item['id']);
            if($methods) {
                foreach ($methods as $method) {
                    $obj->$method();
                } 
                $obj_array[] = $obj;   
            } 
            else $obj_array[] = $obj;    
        } 
        return $obj_array;   
    }
    
    protected function getBreadcrumbs($code, $equipment) {
        $details = $this->getArrayParents($code, $equipment);
        $details = array_reverse($details);
        if($equipment == 'danieli') $str = "<a href='/category/danieli'>Danieli</a>";
        else if($equipment == 'sundbirsta') $str = "<a href='/equipment/sundbirsta'>Sandbirsta</a>";
        $count = count($details);
        foreach ($details as $key => $detail) {
            if(!$detail['rus']) $detail['rus'] = $detail['eng'];
            if($key == $count - 1) $str .= "<span>{$detail['rus']}</span>";
            else $str .= "<a href='/data?id={$detail['id']}&equipment={$detail['equipment']}'>{$detail['rus']}</a>";    
        }
        return $str;
    }
    
    //for create breadcrumbs
    protected static function getArrayParents($code, $equipment)
    {
        $parents = array();
        $detail = Model::factory($equipment)->getDetailByCode($code);
        if(!$detail) return $parents;
        $parents[] = $detail[0];
        $detail = Model::factory($equipment)->getDetailByCode($detail[0]['parent_code']);
        if(!$detail) return $parents;
        $parents[] = $detail[0];
        $detail = Model::factory($equipment)->getDetailByCode($detail[0]['parent_code']);
        if(!$detail) return $parents;
        $parents[] = $detail[0];
        $detail = Model::factory($equipment)->getDetailByCode($detail[0]['parent_code']);
        if(!$detail) return $parents;
        $parents[] = $detail[0];
        $detail = Model::factory($equipment)->getDetailByCode($detail[0]['parent_code']);
        if(!$detail) return $parents;
        $parents[] = $detail[0];
        $detail = Model::factory($equipment)->getDetailByCode($detail[0]['parent_code']);
        if(!$detail) return $parents;
        $parents[] = $detail[0];
        $detail = Model::factory($equipment)->getDetailByCode($detail[0]['parent_code']);
        if(!$detail) return $parents;
    }
    
    //get array obj details which input in category
    protected function getArrayNodes($cat) {
        $details = array();
        foreach($cat->details as $code) {
            if($cat->equipment == 'danieli') {
                $detail = Model::factory('Danieli')->getDetailByCode($code);
                if($detail) $details[] = $detail[0]; 
            }  
            else  {
                $details[] = Model::factory('Sundbirsta')->getDetailByCode($code);
                $details[] = $detail[0];    
            } 
        }
        if($cat->equipment == 'danieli') return $this->getArrayOfObjects($details, 'Object_Danieli');
        else  return $this->getArrayOfObjects($details, 'Object_Sundbirsta'); 
    }


}