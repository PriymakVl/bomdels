<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Auto_Application extends Controller_Auto_Data {

    public function action_add() 
    {
        $file_name = $_FILES['table']['tmp_name'];
        if(!$file_name) exit('error method action_add - not found file');
        $check = $this->request->post('check');

        $obj = new Hendler_ApplicationEns($file_name);

        if($check) {
            Arr::_print($obj->data);    
        }
        else {
            $number_ens = $obj->getNumberOfApplication($_FILES['table']['name']);
            $date_creat_app = $obj->getCreationDateTheApplication($_FILES['table']['name']);
            $type_repair = $obj->getTypeRepairFromNameFile($_FILES['table']['name']);
            $this->addInDatabase($obj->data, $number_ens, $date_creat_app, $type_repair);    
        }
    }
    
    private function addInDatabase($data, $number_ens, $date_creat_app, $type_repair) 
    {
        //$this->addToNativeApplication($data);
        $this->addApplication($number_ens, $date_creat_app, $type_repair);
        $this->addProduct($data);
        $this->addApplicationContentFromFile($data);     
        //$this->addApplicationStatus($data);
        //$this->addAplicationGrafic($data);
        
        $this->createListAddedFiles();
        $this->redirect('/auto/data/application');
    }
    
    private function addApplication($number_ens, $date_creat_app, $type_repair) 
    {
        $data_form = $_POST;
        $data_form['date'] = $date_creat_app ? $date_creat_app : time();
        $data_form['number_ens'] = $data_form['number_ens'] ? $data_form['number_ens'] : $number_ens;
        $data_form['type_repair'] = $data_form['type_repair'] ? $data_form['type_repair'] : $type_repair;
        $data_form['title'] = $data_form['title'] ? $data_form['title'] : 'Заявка';
           //Arr::_print($data_form); 
        $check = Model::factory('Application')->checkIsApplication($data_form['number_ens'], $data_form['year']); 
        if($check) exit('error addApplication - application allready exists');  
        $app_id = Model::factory('Application')->add($data_form);
        if(!$app_id) exit('error method addApplication');
        $this->app_id = $app_id;
    }
    
    private function addProduct($data) 
    {
        $data_form = $_POST;
        foreach($data as $item) {
            if(!empty($item['ens'])) {
                $product = Model::factory('ApplicationEns')->getProductByEns($item['ens']);
                if($product) continue; 
                $item['department'] = $data_form['department'] ? $data_form['department'] : 'Не определен';
                $item['equipment'] = $data_form['equipment'] ? $data_form['equipment'] : 'Не определено';
                $item['customer'] = $data_form['customer'] ? $data_form['customer'] : 'Не определен';
                $product_id = Model::factory('ApplicationEns')->add($item);
                if(!$product_id) exit('error method addProduct');   
            }
        }
    }        
    
    private function addApplicationContentFromFile($data) 
    {
        $app = Model::factory('Application')->getApplicationById($this->app_id);
        foreach($data as $item) {
            if(empty($item['ens'])) continue;
            $product = Model::factory('ApplicationEns')->getProductByEns($item['ens']);
            if(!$product) exit('error method addApplicationContent - not app_item_id');
            $item['need'] = $item['need'] ? $item['need'] : 'Не указано';
            $item['price'] = $item['price'] ? $item['price'] : 'Не указана';
            $res =  Model::factory('ApplicationContent')->add($this->app_id, $product['id'], $item);
            if(!$res) exit('error method addApplicationContent - error add content'); 
        }    
    }   


      
}









