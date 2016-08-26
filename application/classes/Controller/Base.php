<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Base extends Controller_Template {

    public $template = 'total/v_base';
    protected $user;
    
    public function before()
    {
        parent::before();
        
        $this->template->title = 'Прокат';
        
        $user_id = Cookie::get('user_id');
        
        if($user_id) {
            $this->user = new Object_User($user_id); 
            $user = $this->user; 
            $role = $this->user->role; 
            $user_name = $this->user->getFullNameuser();
        }
        else {
            $role = null;
            $user = null;
            $user_name = null;
        }

        View::bind_global('user_name', $user_name);
        View::bind_global('user', $user);
        View::bind_global('role', $role);    
        
        $this->template->styles = array('style.css', 'header.css');
        $this->template->scripts = array('jquery.js');
        
        $this->template->block_header = null;
        $this->template->block_right = null;
        $this->template->block_center = null;
        $this->template->block_footer = View::factory('total/v_footer');
    }
    
    protected function getArrayOfObjects($array, $class, $methods = false, $params = false) 
    {
        $obj_array = array();
        foreach ($array as $item) {
            if(empty($item)) continue;
            $obj = new $class ($item['id']);
            if($methods) {
                foreach ($methods as $method) {
                    if ($params && array_key_exists($method, $params)) {
                        $param = $params[$method];//pass param in method
                        $obj->$method($param); 
                    }
                    else $obj->$method();
                } 
                $obj_array[] = $obj;   
            } 
            else $obj_array[] = $obj;    
        } 
        return $obj_array;   
    }
    
    protected function getBreadcrumbs($code, $equipment) {
        $details = $this->getArrayParents($code, $equipment);
        if(!$details) {
            if($equipment == 'danieli') $detail = Model::factory('Danieli')->getDetailByCode($code);
            else if($equipment == 'sundbirsta') $detail = Model::factory('Sundbirsta')->getDetailByCode($code);
            else if($equipment == 'crane') $detail = Model::factory('Crane')->getDetailByCode($code);
            if(!$detail['rus']) $detail['rus'] = $detail['eng'];

            if($equipment == 'danieli') return "<a href='/category?equipment=danieli'>Danieli</a><span>{$detail['rus']}</span>";
            else if($equipment == 'sundbirsta') return "<a href='/category?equipment=sundbirsta'>Sandbirsta</a><span>{$detail['rus']}</span>";
            else if($equipment == 'cranes') return "<a href='/category?equipment=cranes'>Краны</a><span>{$detail['rus']}</span>";
        }
        $details = array_reverse($details);
        if($equipment == 'danieli') $str = "<a href='/category?equipment=danieli'>Danieli</a>";
        else if($equipment == 'sundbirsta') $str = "<a href='/category?equipment=sundbirsta'>Sandbirsta</a>";
        else if($equipment == 'crane') $str = "<a href='/category?equipment=crane'>Краны</a>";
        $count = count($details);
        foreach ($details as $key => $detail) {
            if(!$detail['rus']) $detail['rus'] = $detail['eng'];
            if($key == $count - 1) $str .= "<span>{$detail['rus']}</span>";
            else $str .= "<a href='/data?id={$detail['id']}&equipment={$detail['equipment']}'>{$detail['rus']}</a>";    
        }
        return $str;
    }
    
    //for create breadcrumbs
    protected static function getArrayParents($code, $equipment)
    {
        $parents = array();
        $detail = Model::factory($equipment)->getDetailByCode($code);
        if(!$detail) return $parents;
        $parents[] = $detail;
        $detail = Model::factory($equipment)->getDetailByCode($detail['parent_code']);
        if(!$detail) return $parents;
        $parents[] = $detail;
        $detail = Model::factory($equipment)->getDetailByCode($detail['parent_code']);
        if(!$detail) return $parents;
        $parents[] = $detail;
        $detail = Model::factory($equipment)->getDetailByCode($detail['parent_code']);
        if(!$detail) return $parents;
        $parents[] = $detail;
        $detail = Model::factory($equipment)->getDetailByCode($detail['parent_code']);
        if(!$detail) return $parents;
        $parents[] = $detail;
        $detail = Model::factory($equipment)->getDetailByCode($detail['parent_code']);
        if(!$detail) return $parents;
        $parents[] = $detail;
        $detail = Model::factory($equipment)->getDetailByCode($detail['parent_code']);
        if(!$detail) return $parents;
    }
    
    //get array obj details which input in category
    protected function getArrayNodes($cat) {
        $details = array();
        foreach($cat->details as $detail) {
            if($cat->equipment == 'danieli') {
                $details[] = Model::factory('Danieli')->getDetailByCode($detail['code']);
            }  
            else if($cat->equipment == 'sundbirsta')  {
                $details[] = Model::factory('Sundbirsta')->getDetailByCode($detail['code']);   
            } 
            else if ($cat->equipment == 'crane') {
                $details[] = Model::factory('Crane')->getDetailByCode($detail['code']);
            }
        }
        if($cat->equipment == 'danieli') return $this->getArrayOfObjects($details, 'Object_Danieli');
        else if($cat->equipment == 'sundbirsta')  return $this->getArrayOfObjects($details, 'Object_Sundbirsta'); 
        else if($cat->equipment == 'crane')  return $this->getArrayOfObjects($details, 'Object_Crane'); 
        exit('error class base_contorller method getArrayNodes');
    }
    
    protected function getArrayItem($array, $key_need, $key_exist) 
    {
        $arr = array();
        for ($i = 0, $count = count($array); $i < $count; $i++)   {
            $arr[][$key_need] = $array[$i][$key_exist];
        } 
        return $arr;
    }
    
    protected function getExtensionFile($filename) 
    {
        $filearr = explode('.', $filename);
        $mime = end($filearr);
        if(!$mime) exit('Eroor controller Base method getExtensionFile');
        return $mime;    
    }
    
    public function addDraw($data) 
    {
        if(empty($data['file'])) return $this->loadDraw($data);
        
        $data['folder'] = strtolower($this->getExtensionFile($data['file']));
        
        if($data['equipment'] == 'danieli') $res = Model::factory('Drawingdanieli')->add($data);
        else if ($data['equipment'] == 'sundbirsta') $res = Model::factory('Drawingsundbirsta')->add($data);
        if($data['equipment'] == 'crane') $res = Model::factory('Drawingcrane')->add($data);

        if(!$res) exit('error add drawing');
        $this->redirect('/drawings?id='.$data['detail_id'].'&equipment='.$data['equipment']);
    }
    
    public function loadDraw($data) 
    {
        if ($data['type'] == 'draft') $data = $this->addDraft($data);
        else {
            $data['file'] = $_FILES['draw']['name'];
            $data['folder'] = strtolower($this->getExtensionFile($data['file']));    
        }
        
        $draw = new Object_Drawing();
        $draw->moveFile($data);
        
        if($data['equipment'] == 'danieli') $res = Model::factory('Drawingdanieli')->add($data);
        else if ($data['equipment'] == 'sundbirsta') $res = Model::factory('Drawingsundbirsta')->add($data);
        if($data['equipment'] == 'crane') $res = Model::factory('Drawingcrane')->add($data);
        
        if(!$res) exit('error controller Drawins method loadDraw');
        
        $this->redirect('/drawings?id='.$data['detail_id'].'&equipment='.$data['equipment']);
    }
    
    private function addDraft($data) {
        $last_id_draft = Model::factory('Draft')->getLastId();
        $year = date('y');
        $num_draft = $last_id_draft + 1;
        $ext = $this->getExtensionFile($_FILES['draw']['name']);
        $data['folder'] = strtolower($ext);
        $data['file'] = '27.'.$year.'.'.$num_draft.'.'.$ext;
        $res = Model::factory('Draft')->add($data);
        if(!$res) exit('Error controller Drawings method addDraft');
        return $data;
    }


}