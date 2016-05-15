<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Search extends Controller_Base {

    
    public function action_index()
    {   
        $this->template->block_header = View::factory('widgets/w_header')->bind('code', $this->code);
        $this->template->block_right = View::factory('widgets/w_vernav');
        
        $res = Model::factory('drawing')->getIdDrawByCode($code);
        
        if (empty($res)) {
            $this->template->block_center = View::factory('widgets/w_draw_not_found')->set('info', 'Результат поиска');   
        }
        else {
            $draw = new Object_Drawing($res[0]['id']);
            $sub_ids = Model::factory('drawing')->getIdSubDraws($draw->code);
            if (empty($sub_ids)) {
                $this->template->block_center = View::factory('widgets/w_data_draw')->bind('draw', $draw);            
            }
            else {
                $heirs = $this->getArrayOfObjects($sub_ids);
                $this->template->block_center = View::factory('widgets/w_list_draws')->bind('draws', $heirs);    
            }   
        }   
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