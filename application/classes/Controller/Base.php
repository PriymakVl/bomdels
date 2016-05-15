<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Base extends Controller_Template {

    public $template = 'total/v_base';
    protected $code;
    protected $cat_id;
    
    public function before()
    {
        parent::before();
        
        $this->template->title = 'стан 400/200';
        $this->code = Arr::get($_POST, 'code');
        $this->cat_id = Arr::get($_GET, 'cat_id');
        if(!$this->cat_id) $this->cat_id = 1;
        
        $this->template->styles = array('style.css', 'header.css');
        $this->template->scripts = array('jquery.js', 'add_active_item_header.js');
        
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
        if($equipment == 'danieli') $str = "<a href='/equipment/danieli'>Danieli</a>";
        else if($equipment == 'sundbirsta') $str = "<a href='/equipment/sundbirsta'>Sandbirsta</a>";
        $count = count($details);
        foreach ($details as $key => $detail) {
            if(!$detail['rus']) $detail['rus'] = $detail['eng'];
            if($key == $count - 1) $str .= "<span>{$detail['rus']}</span>";
            else $str .= "<a href='/specification?id={$detail['id']}&equipment={$detail['equipment']}'>{$detail['rus']}</a>";    
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


}