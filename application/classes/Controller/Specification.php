<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Specification extends Controller_Base {

    
    public function action_index()
    {   
        $this->template->block_right = View::factory('widgets/w_vernav');
        
        $id = Arr::get($_GET, 'id');
        if(!(int) $id) $this->redirect('404');
        
        $draw = new Object_Drawing($id);
        
        if(!$draw) {
            $this->template->block_center = View::factory('widgets/w_draw_not_found')->set('submenu', false)->set('message', 'Такой детали не найдено');    
        }
        else {
            $submenu = $this->getSubmenu('Спецификация', $draw);
            $draws = $this->getArrayOfObjects($draw->sub_id, 'Object_Drawing');
            //Arr::_print($draws);
            $this->template->block_topnav = View::factory('widgets/w_top_breadcrumbs')->bind('draw', $draw);
            $this->template->block_center = View::factory('widgets/w_specification_draw')->bind('draws', $draws)->bind('submenu', $submenu);  
        }   
    }
    
    private function getSubmenu($item, Object_Drawing $draw) {
        $str = "<span style='color: green;'>$item</span>";
        $str .= "<a href='/data?id=$draw->id'>Данные</a>";
        $str .= "<a href='#'>Обеспечение</a>";
        $str .= "<a href='/data?id=$draw->id'>Чертеж</a>";
        return $str;    
    }

}
