<?php
//$_SESSION['user_id'] = 5; //unset($_SESSION['user_id']);

// $_SESSION['userData']['id'] = 4; unset($_SESSION['userData']['id']);


// $_SESSION['user_name']  = "Alexander";
// $_SESSION['userData']['first_name'] = "Alexander";


// $_SESSION['userData']['picture']['url'] = "https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=444339880038623&height=50&width=50&ext=1615243680&hash=AeS30LYuU6tt9WL9gWY";

// testing code above

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