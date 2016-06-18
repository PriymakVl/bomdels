<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Auto_Sundbirsta extends Controller_Auto_Data {


    public function action_sundbirsta() 
    {
        $parent_code = $this->request->post('parent_code');
        //$parent_code = '80003800-01';
        //$parent_id = 1;
        $parent_id = $this->request->post('parent_id');
        $file_name = Arr::get($_FILES['data'], 'name');
        
        $path = 'media/files/sundbirsta/'.$file_name;
         //check exist file heirs data
        $check_file = file_exists($path);
        if(!$check_file ) {
            //add file on server
            $move = $this->moveFileWithData($path);
            if(!$move) exit("ошибка при добавлении файл на сервер");   
        }  
        
        $obj = new Hendler_Sundbirsta($path);
        $obj->getArrayStringFromFile()->getArrayDataWithTable()->fillingEmptyFieldCode()->trimStr();
        //check data in database
        $check = Model::factory('sundbirsta')->checkExistDetailsByParentCode($parent_code);
        if($check) exit('data alreded added');
        
        foreach ($obj->data as $data) {
            $res = Model::factory('sundbirsta')->addAutoSun($data, $parent_code);    
        }
        if($res[1] == 1) $this->redirect('/specification?id='.$parent_id);  
        else var_dump($res);
    }
    
    private function moveFileWithData($path) 
    { 
        if(is_uploaded_file($_FILES["data"]["tmp_name"]))
        {
            move_uploaded_file($_FILES["data"]["tmp_name"], $path);
            return true;
        } 
        else return false;        
    }
    
    public function action_checkDataFile() 
    {
        $file_name = Arr::get($_FILES['data'], 'name');
        
        $path = 'media/files/sundbirsta/'.$file_name;
         //check exist file heirs data
        $check_file = file_exists($path);
        if(!$check_file ) {
            //add file on server
            $move = $this->moveFileWithData($path);
            if(!$move) exit("ошибка при добавлении файл на сервер");   
        }  
        
        $obj = new Hendler_Sundbirsta($path);
        $obj->getArrayStringFromFile()->getArrayDataWithTable();
        //Arr::_print($obj->data);
        $obj->fillingEmptyFieldCode()->trimStr();
        Arr::_print($obj->data);
    }
}