<?php

namespace App\Controller;


use App\Core\Controller;    
use Exception;


class AdminController extends Controller
{
    use \App\Traits\ConfigSettingsTrait;
    use \App\Traits\FilterDataTrait;

    public $admin_captcha_numbers;
    public $manager_name;
    public $manager_password;
    public $manager_confirm_password;
    public $manager_access;

    public function __construct()
    {
        $this->admin_captcha_numbers = !empty($_POST['admin_captcha_numbers']) ? $this->filter_data($_POST['admin_captcha_numbers']) : false;
        $this->manager_name = !empty($_POST['manager_name']) ? $this->filter_data($_POST['manager_name']) : false;
        $this->manager_password = !empty($_POST['manager_password']) ? $this->filter_data($_POST['manager_password']) : false;
        $this->manager_confirm_password = !empty($_POST['manager_confirm_password']) ? $this->filter_data($_POST['manager_confirm_password']) : false;
        $this->manager_access = !empty($_POST['manager_access']) ? $this->filter_data($_POST['manager_access']) : false;
    }
    // the method below checks for not empty data
    protected function checking_not_empty_data()
    {
        if (empty($this->admin_captcha_numbers) || empty($this->manager_name) 
         || empty($this->manager_password)) {
            return false;
        } else {
            return true;
               }
    }
    // the method below checks is validation success or not
    public function access_control_manager()
    {
        return empty($_SESSION['access_manager']) ? false : true;
    }
    // the static method below provides access of validation
    public static function static_access_control_manager()
    {
        if (empty($_SESSION['access_manager'])) {
            echo "Access for you to the page was forbidden";
            die;
        }
    }
    // the method below is router for access to admin pager
    public function access_admin_routing()  
    {
          if ($this->access_control_manager()) {
              header("Location:" . $this->get_url() . "://greenbro." . $this->get_domen_part() . "/admin/app_managing_page");
              exit;
          } else {
              header("Location:" . $this->get_url() . "://greenbro." . $this->get_domen_part() . "/admin/admin_point_access");
              exit;
                 }
    }

    // the method below is a door for managing
    public function admin_point_access()
    {
        $this->view('admin' . DIRECTORY_SEPARATOR . 'admin_point_access_page');
        $this->view->page_title = 'Сторінка управління';
        $this->view->render();
    }
    // the method below displays page for managing app
    public function app_managing_page()
    {
        $this->view('admin'. DIRECTORY_SEPARATOR . 'app_managing_page');
        $this->view->page_title = "App managing page";
        $this->view->render();
    }

    // the method below calls to unset_access_session
    public function call_unset_access_session()
    {
        $this->load_model_obj('AdminModel')->unset_access_session();
        $this->access_admin_routing();
    }

    // the method below checking data from admin access form
    public function call_organise_manager_validation_data()
    {             
        try {
            if ($this->checking_not_empty_data()) {
                $this->load_model_obj('AdminModel')->organise_manager_validation_data($admin_object = new AdminController);
                $this->access_control_manager();
                $this->access_admin_routing();
            } else {
                throw new Exception("Got empty parameter in checking_access_form_data");
                   }
            } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
    }

    // the method below equals confirm password and password
    protected function equal_password()
    {
        return $this->manager_password == $this->manager_confirm_password ? true : false;
    }
    // the method below add new manager to table
    public function call_add_new_manager()
    {
        if ($this->equal_password()) {
            $this->load_model_obj('AdminModel')->add_new_manager($admin_object = new AdminController);
        }
    }
}