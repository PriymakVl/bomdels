<?php defined('SYSPATH') or die('No direct script access.');

class Controller_User extends Controller_Base {

    
    public function action_auth()
    {          
        $data = Arr::extract($_POST, array('login', 'password', 'remember'));
        $remember = ($data['remember'] == 'true') ? true : false; 
        
        $employee_id = Model::factory('User')->auth($data['login'], $data['password']);
        if($employee_id) {
            Cookie::set('user_id', $employee_id);
            //Cookie::get('employee_remember', $remember);
            echo true;
            exit();
        }
        else echo false;
        exit();   
    }
    
    public function action_cancel() {
        Cookie::delete('user_id');
        Cookie::delete('list_user');
        $this->redirect('/');
    }
    
    public function action_checkExistLogin() {
        $login = $this->request->post('login');
        $res = Model::factory("User")->getUserByLogin($login);
        echo $res['login'];
        exit();
    }
    
    public function action_registr() {
        $data = Arr::extract($_POST, array('login', 'password'));
        $user_id = Model::factory('User')->add($data);
        if($user_id) {
            Model::factory('UserRole')->set($user_id);
            Model::factory('ElectList')->add($user_id, 'мой список');
            Cookie::set('user_id', $user_id);
            $this->redirect('/profile?action=reg');    
        }
        else exit('error action_registr');
    }
    
}