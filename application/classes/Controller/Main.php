<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Main extends Controller_Base {

    
    public function action_index()
    {   
        $cat_id = Arr::get($_GET, 'cat_id') ? Arr::get($_GET, 'cat_id') : 1;
        
        
        $parent_id = Arr::get($_GET, 'draw_id');
        if(!$parent_id) {
            $draws = Model::factory('drawing')->getMain();
            $name_title = $this->getNameCategory($cat_id);    
        }
        else {
            $draws = Model::factory('drawing')->getDrawsByParentId($parent_id);
            $parent_draw = Model::factory('drawing')->getDrawById($parent_id); 
            $name_title = "<a href='/?draw_id={$parent_draw['parent_id']}'>{$parent_draw['rus']}</a> - ({$parent_draw['code']})";  
        } 
        
        $this->template->block_center = View::factory('widgets/w_content')->set('name_title', $name_title)->bind('draws', $draws);
        $this->template->block_right = View::factory('widgets/w_vernav');
        
    }
    
    private function getNameCategory($cat_id) {
        switch ($cat_id) {
            case 1: return 'Механика';
            case 2: return 'Гидравлика';
            case 3: return 'Смазка';
            case 4: return 'Узлы';
        }
    }

}
