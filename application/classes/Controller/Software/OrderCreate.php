<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Software_OrderCreate extends Controller_Base {

    
    public function action_index()
    {   
        $this->template->styles = array('style.css', 'header.css', 'order.css');
        $scripts_1 = array('jquery.js', 'order/order_create_show_box.js', 'search/search_detail_for_order.js', 'order/order_create_function.js');
        $scripts_2 = array('order/add_new_order.js', 'order/order_create_nature_work_box_functions.js');
        $scripts_3 = Arr::merge($scripts_1, $scripts_2);
        $this->template->scripts = $scripts_3;
        
        $date = Date('d.m.y', time());
        View::set_global('date', $date);
        
        $number = $this->getNextNumberOfOrders();
        View::set_global('number_next', $number);
        
        $cat_danieli = Model::factory("Category")->getMainCategories('danieli');
        //Arr::_print($cat_danieli);
        
        $this->template->block_header = View::factory('header/v_header_search_order');
        $this->template->block_center = View::factory('software/order/v_order_create_content')->bind('cat_danieli', $cat_danieli);
        //$this->template->block_right = View::factory('software/order/v_order_create_menu');  
       
    }
    
    private function getNextNumberOfOrders() 
    {
        $year = Date('Y', time());
        $number = Model::factory('Order')->getLatestNumberOfOrders($year);
        if(!$number) return '100';
        else if($number < 1000) return $number + 1;
        else return '100';    
    }
    
    public function action_add() {
        Arr::_print($_POST);
    }
    
   
   
    

}