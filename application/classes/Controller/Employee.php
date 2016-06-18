<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Employee extends Controller_Base {

    
    public function action_auth()
    {          
        $data = Arr::extract($_POST, array('login', 'password', 'remember'));
        $remember = ($data['remember'] == 'true') ? true : false; 
        
        $employee_id = Model::factory('Employee')->auth($data['login'], $data['password']);
        if($employee_id) {
            Cookie::set('employee_id', $employee_id);
            //Cookie::get('employee_remember', $remember);
            echo true;
            exit();
        }
        else echo false;
        exit();   
    }
    
    public function action_cancel() {
        Cookie::delete('employee_id');
        Cookie::delete('list_employee');
        $this->redirect('/');
    }
    
    public function action_checkExistLogin() {
        $login = $this->request->post('login');
        $res = Model::factory("Employee")->getEmployeeByLogin($login);
        echo $res['login'];
        exit();
    }
    
    public function action_registr() {
        $data = Arr::extract($_POST, array('login', 'password'));
        $employee_id = Model::factory('Employee')->add($data);
        if($employee_id) {
            Model::factory('EmployeeRole')->set($employee_id);
            Model::factory('ElectList')->add($employee_id, 'мой список');
            Cookie::set('employee_id', $employee_id);
            $this->redirect('/profile?action=reg');    
        }
        else exit('error action_registr');
    }
    
}