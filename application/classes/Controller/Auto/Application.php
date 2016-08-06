<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Auto_Application extends Controller_Auto_Data {

    public function action_add() {
        $file_name = $_FILES['table']['tmp_name'];
        if(!$file_name) exit('error method action_add - not found file');
        $check = $this->request->post('check');

        $obj = new Hendler_Application($file_name);
        $obj->getGoodName();
        $obj->getEns();
        $obj->getCodeGood();
        $obj->getNeededGood();
        $obj->getWeightGood();
        $obj->getPriceGood();
        $obj->getExecutor();
        $obj->getCreatedCodeEns();
        $obj->getUnits();//единицы измерения
   
        if($check) {
            Arr::_print($obj->data);    
        }
        else $this->addInDatabase($obj->data);
    }
    
    private function addInDatabase($data) {
        //$this->addToNativeApplication($data);

        $this->addApplication();
        
        $this->addApplicationContentFromFile($data);
        //$this->addApplicationStatus($data);
        //$this->addAplicationGrafic($data);
        
        $this->createListAddedFiles();
        $this->redirect('/auto/data/application');
    }
    
    private function addApplication() {
        $data = $_POST;
        $data['date'] = time();
          // Arr::_print($data);    
        $app_id = Model::factory('Application')->add($data);
        if(!$app_id) exit('error method addApplication');
        $this->app_id = $app_id;
    }
    
    private function addApplicationContentFromFile($data) {
        //Arr::_print($data);
        $app = Model::factory('Application')->getApplicationById($this->app_id);
        foreach($data as $item) {
            $good_id = Model::factory('ApplicationEns')->getGoodByCode($item['code']);
            if(!$good_id) {
                $item['department'] = $app['department'];
                $item['equipment'] = $app['equipment'];
                $item['customer'] = $app['customer'];
                $good_id = Model::factory('ApplicationEns')->add($item);
                if(!$good_id) exit('error method addApplicationContent - not good_id'); 
                $check = Model::factory('ApplicationContent')->checkExitGoodInApplication($this->app_id, $good_id);
                if(!$check) $res =  Model::factory('ApplicationContent')->add($this->app_id, $good_id);
                if(!$res) exit('error method addApplicationContent - error add content');         
            }
        }    
    }   


      
}









