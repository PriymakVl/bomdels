<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Search extends Controller_Base {

    private $details;
    private $search;
    private $type;
    private $equipment;
    
    public function action_result()
    {   
 
        if($this->equipment == 'danieli') $class_name = 'Object_Danieli';
        else if($this->equipment == 'sundbirsta') $class_name = 'Object_Sandbirsta';
        else exit('error - action_result');
        
        $details = $this->getArrayOfObjects($this->details, $class_name, array('getParent'));
           //Arr::_print($details);
        $this->template->block_header = View::factory('header/v_header_search')->bind('equipment', $this->equipment)->bind('search', $this->search);
        $this->template->block_right = View::factory('search/v_search_menu');
        $this->template->block_center = View::factory('search/v_search_content')->bind('details', $details)
        ->bind('type', $this->type)->bind('equipment', $this->equipment)->bind('search', $this->search)->set('info', 'Результаты поиска');
    }
    
    public function action_danieli() {
        $this->search = $this->request->post('search');
        $this->type = $this->request->post('type_search');
        $this->equipment = 'danieli';
        
        if(!$this->search || !$this->type) exit('error not search words or type search - action_danieli');
        
        $this->details = ($this->type == 'code') ? Model::factory('Danieli')->searchDetailByCode($this->search) : Model::factory('Danieli')->serachDetailByName($this->search);

        if(count($this->details) == 1) $this->redirect("/data?id={$this->details[0]['id']}&equipment=danieli");
        else $this->action_result();
    }

}