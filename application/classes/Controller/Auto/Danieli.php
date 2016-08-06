<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Auto_Danieli extends Controller_Auto_Data {

    public function action_add() {
        $file_name = $_FILES['table']['tmp_name'];

        //$this->changeFirstStringFile($file_name);
        //for show array of data file
        $check = $this->request->post('check');

        $obj = new Hendler_Application($file_name);
        $obj->getArrayStringFromFile();
        $obj->getArrayDanieli();
        
        $obj->getNameFile();
        $obj->getVariant();
        $obj->clearParentCode();
        $obj->getEngName();
        $obj->getItem();
        $obj->getSheets();
        $obj->getQuantity();
        $obj->getWeight();
        $obj->getType();
        $obj->getSize();
        $this->createListAddedFiles();
        
        if($check) {
            Arr::_print($obj->data);    
        }
        else $this->addInDatabase($obj->data);
    }
    //add ; in of end first string file
    private function changeFirstStringFile($file_name) { 
        //check exit title if file
        $file = file($file_name);
        //Arr::_print(strpos($file[0], 'Member'));
        if(strpos($file[0], 'Member')) return true;
        //add title if file;
        $first_str = "Note;Job;Owner;Member;Item;Revision;Version;Sheet;Sheets;Size;Assembly;File;Norme;Drawing;Weight;Quantity;Total;MU;Dim Unit;Costruction;Title;Title(other);\r\n";
        file_put_contents($file_name, $first_str.file_get_contents($file_name));
    }
    
    private function addInDatabase($data) {
        //save full info danieli
        $this->addToNativedanieli($data);
        //save detail to danieli
        $this->addToDanieli($data);
        //add of drawing
        $this->addDrawingDanieli($data);
        //add added files in list files
        $this->createListAddedFiles();
        $this->redirect('/auto/data');
    }
    
    private function addToNativeDanieli($data) {
        foreach($data as $item) {
            $res = Model::factory('DanieliNative')->getDetailByCode($item['Member']);
            if(!$res) {
                $res = Model::factory('DanieliNative')->addAuto($item);
                if(!$res) exit('error add full info danieli');    
            }
        }    
    }
    
    private function addToDanieli($data) {
        //Arr::_print($data[0]['type']);
        foreach($data as $item) {
            $res = Model::factory('Danieli')->getDetailByCode($item['code']);
            if(!$res) {
                $res = Model::factory('Danieli')->addAutoDanieli($item);
                if(!$res) exit('error add danieli');    
            }
        }    
    }
    
    private function addDrawingDanieli($data) {
        //Arr::_print($data[0]['type']);
        foreach($data as $item) {
            if(!trim($item['file'])) continue;//detail has not drawing
            $detail = Model::factory('Danieli')->getDetailByCode($item['code']);
            if(!$detail) exit('not detail - addDrawingDanieli');
            $draw = Model::factory('Drawing')->getDrawingByNameFile($item['file']);
            if($draw) continue;
            else {
                $res = Model::factory('Drawing')->addDanieli($item, $detail[0]['id']);
                if(!$res) exit('error add danieli');    
            }
        }    
    }
      
}









