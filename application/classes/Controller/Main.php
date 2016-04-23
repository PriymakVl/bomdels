<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Main extends Controller_Base {

    
    public function action_index()
    {   
        $cat_id = $this->cat_id ? $this->cat_id : 1;
        
        $user_id = Cookie::get('user_id');
        $user_id = $user_id ? $user_id : 1;
        
        $ids = Model::factory('elect')->get($user_id, $cat_id);
        $draws = $this->getArrayOfObjects($ids, 'Object_Drawing');
        //Arr::_print($draws);
        $info = $this->getNameCategory();
       // Arr::_print($info);
        $this->template->block_topnav = View::factory('widgets/w_topnav')->bind('code', $this->code);
        $this->template->block_center = View::factory('widgets/w_elect_draws')->set('info', $info)->bind('draws', $draws);
        $this->template->block_right = View::factory('widgets/w_vernav');
        
    }
    
 

}
