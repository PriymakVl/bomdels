<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Glossary extends Controller_Base {

    
    public function action_index()
    {   
        $this->template->styles = array('style.css', 'header.css', 'glossary.css');
        $this->template->scripts = array('jquery.js', 'glossary_show_box.js');
        
        $names = Model::factory('Glossary')->getAll();

        //$elements = $this->getArrayElectElements($elected);
        //Arr::_print($names);

        $info = 'Глоссарий';
        
       // Arr::_print($info);
        $this->template->block_header = View::factory('header/v_header_search_glossary');
        $this->template->block_center = View::factory('glossary/v_glossary_content')->set('info', $info)->bind('names', $names);
        $this->template->block_right = View::factory('glossary/v_glossary_menu');
        
    }
    
    public function action_updateFromDanieli() 
    {
        //$names = Model::factory('Danieli')->getAll();
        $data = Model::factory('Danieli')->getDetailByType('not found');
        //Arr::_print($data);
        foreach ($data as $item) {
            $is_num = is_numeric($item['eng']);
            if($is_num) continue;
            $res = Model::factory('Glossary')->getRus($item['eng']);
            if($res) continue;
            Model::factory('Glossary')->insert($item['eng'], $item['rus'], 'standart');
        }
        $this->action_index();
    }
    
    public function action_addTranslationFromFile() 
    {
        $file = $_FILES['table']['tmp_name']; 
        //for show array of data file
        $check = $this->request->post('check');
        
        $obj = new Hendler_Glossary($file);
        $obj->getArrayStringFromFile();
        $obj->getArrayTranslate();
        $obj->toUTF8('rus');
        if($check) {
            Arr::_print($obj->data);    
        }
        else {
            $this->addTranslationToTheDatabase($obj->data);
            $this->action_index();
        }
    }
    
    private function addTranslationToTheDatabase($data) 
    {
        foreach ($data as $item) {
            if(!$item['rus']) continue;
            Model::factory('Glossary')->addTranslation($item['eng'], $item['rus']);    
        }
        return true;     
    }
    
    public function action_writeGlossaryToFile() {
        //$data = Model::factory('Glossary')->getAll();
        //$data = Model::factory('Glossary')->getDataByType('not found');
        $data = Model::factory('Danieli')->getDetailByType('not found');
        //Arr::_print($data);
        $path = 'media/files/glossary/translation.csv'; 
        $this->writeArrayToFile($path, $data); 
        $this->redirect($path); 
    }
    
    public function writeArrayToFile($file, $array) {
        $fp = fopen ($file, "w");
        fwrite($fp, "eng;rus;\r\n");
        foreach ($array as $output){
            if(trim($output['rus'])) continue;//if is translate write not english to the file
            $str = trim($output['eng'].'; ');
            fwrite($fp, $str."\r\n");
        }
        fclose($fp);
    }
    

}