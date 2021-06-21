<?php

namespace App\Controller;

use App\Core\Controller;

class ViewValidationController extends Controller
{
    // the method bellow displays user info from FB 
    protected function display_fb_user_info()
    {
        $this->view('validation' . DIRECTORY_SEPARATOR . 'fb_user_info');
        $this->view->render();
    }
    // the method bellow displays casual user info 
    protected function display_casual_user_info()
    {
        $this->view('validation' . DIRECTORY_SEPARATOR . 'casual_user_info');
        $this->view->render();
    }
    // the method bellow displays block for login
    protected function display_login_block()
    {
        $this->view('validation' . DIRECTORY_SEPARATOR . 'login_user');
        $this->view->render();
    }

    // the method below manages which view page will call
    public function call_manager()
    {   //case for display FB user info 
        if (isset($_SESSION['userData']['id'])) {
            $this->display_fb_user_info();
        }
        // case for display casual user info 
        elseif (isset($_SESSION['user_id'])) {
            $this->display_casual_user_info();
        }
        // the block below if user hasn't loged in yet 
        else {
            $this->display_login_block();
             } 
    }


}