<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Base extends Controller_Template {

    public $template = 'v_base';
    protected $code;
    protected $cat_id;
    
    public function before()
    {
        parent::before();
        
        $this->template->title = 'стан 400/200';
        $this->code = Arr::get($_POST, 'code');
        $this->cat_id = Arr::get($_GET, 'cat_id');
        if(!$this->cat_id) $this->cat_id = 1;
        
        $this->template->styles = array('style.css');
        $this->template->scripts = array('jquery.js', 'add_active_item_topnav.js');
        
        $this->template->block_topnav = null;
        $this->template->block_right = null;
        $this->template->block_center = null;
        $this->template->block_footer = View::factory('widgets/w_footer');
    }
    
    protected function getNameCategory() 
    {
        switch ($this->cat_id) {
            case 1: return 'Механика';
            case 2: return 'Гидравлика';
            case 3: return 'Смазка';
            case 4: return 'Узлы';
        }
    }
    
    protected function getArrayOfObjects($array, $class) 
    {
        $obj_array = array();
        foreach ($array as $item) {
            $obj_array[] = new $class ($item['id']);    
        } 
        return $obj_array;   
    }


}
