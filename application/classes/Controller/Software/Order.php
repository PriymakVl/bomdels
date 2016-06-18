<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Software_Order extends Controller_Base {

    
    public function action_index()
    {   
        $this->template->styles = array('style.css', 'header.css', 'order.css');
        $scripts = array('jquery.js', 'order/order_show_box.js');
        $this->template->scripts = $scripts;
        
        $number = $this->request->query('number');
        $order = (int)$number ? Model::factory('Order')->getOrderByNumber($number) : exit('error action_index');
        $order = new Object_Order($order['id']);
        $order->getContent();
        $order->getFullNumberOfOrder();
        //Arr::_print($order);
        $content = $this->getArrayOfObjects($order->content, 'Object_OrderItem');
        //Arr::_print($content);
        
        $this->template->block_header = View::factory('header/v_header_search_order');
        $this->template->block_center = View::factory('software/order/v_order_content')->bind('order', $order)->bind('order_content', $content);
        $this->template->block_right = View::factory('software/order/v_order_menu');  
       
    }
    
   
   
    

}