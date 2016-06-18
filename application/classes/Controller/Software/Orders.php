<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Software_Orders extends Controller_Base {

    
    public function action_index()
    {   
        $this->template->styles = array('style.css', 'header.css', 'order.css');
        $scripts = array();
        $this->template->scripts = $scripts;
        
        $all = Model::factory('Order')->getAll();
        
        $orders = $this->getArrayOfObjects($all, 'Object_Order');
        //Arr::_print($orders);
        
        $this->template->block_header = View::factory('header/v_header_search_order');
        $this->template->block_center = View::factory('software/order/v_order_list_content')->bind('orders', $orders);
        $this->template->block_right = View::factory('software/order/v_order_list_menu');  
       
    }
    
   
   
    

}