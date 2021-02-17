<?php
trait sessionTrait
{
    // TO DO expand this method for unseting session from FB API
    // the method below for logout casual user, unset Session 
    protected function unsetUserSession() 
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['email']);
    }

    // the method below for logout user from FB, unset Session 
    protected function unsetFbUserSession()
    {
        unset($_SESSION['userData']['id']);
        unset($_SESSION['userData']['first_name']);
        unset($_SESSION['userData']['last_name']);
        unset($_SESSION['userData']['email']);
        unset($_SESSION['userData']['picture']['url']);
    }

    // the method below creates session for casual login
    private function createUserSession($loggedInUser) 
    {
        $_SESSION['user_id'] = $loggedInUser[0]['user_id'];
        // change key to user_name for using both cases casual and FB 
        $_SESSION['user_name'] = $loggedInUser[0]['username'];
        $_SESSION['email'] = $loggedInUser[0]['email'];
    }
}