<?php

namespace App\Controller;

use App\Core\Controller;
use Exception;

class EraseUserDataController extends Controller
{
    use \App\Trait\SessionTrait;
    use \App\Trait\ModelTrait;
    use \App\Trait\JsonReplyTrait;
    use \App\Trait\CryptoGrapherTrait;
    use \App\Trait\ConfigSettingsTrait;
    use \App\Trait\FilterDataTrait;

    

    private $user_code;
    
    private $user_id_session;

    // the method below displays url 
    protected static function display_url()
    {
        $object = new  EraseUserDataController();
        return $object->get_url();
    }
    // the method below displays domen part
    protected static function display_domen_part()
    {
        $object = new  EraseUserDataController();
        return $object->get_domen_part();
    }

    // the method below prepares url for redirection
    public static function preparing_checking_deletion_url()
    {
        $string = '//greenbro.' . self::display_domen_part() .
        '/eraseuserdata/deletion_status_page?code=' . self::display_user_data();
        return $string;
    }
    

    // the method below sets user_id
    private function set_user_code()
    {
       $user_code = $this->user_code = $this->filter_data($_POST['user_code']);
    }
    // the method below gets user_id
    private function get_user_code()
    {
        $this->set_user_code();
        return $this->user_code;
    }

    
    // the method below for security, checks $user_id equal to actual user session
    private function control_hash_code($user_code)
    {
        if ($this->get_user_code() === self::hashed($this->get_user_id_session())) {
            return true;
        } else {
            return false;
               }
    }
    
    // the method below organises deletion FB user data 
    public function erase_fb_data($fb_user_id)
    {
        try {
             if (empty($fb_user_id)) {
                 throw new Exception("Empty parameter to erase_fb_data method");
             }
             if ($this->delete_data_response_rating($fb_user_id) &&
                 $this->delete_data_response($fb_user_id)) {
                    
                    $this->unsetFbUserSession();
                 } else {
                    throw new Exception("erase_fb_data wasn't execution successful");
                        }
            } catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           } 
    }


    // https://greenbro.net/eraseuserdata/erase_data url for user deletion data process
    // the method below organises deletion user data
    public function erase_data()
    {   
        try {
            // the block below controlling input data
            if ($this->control_hash_code($this->get_user_code())) {
                   // the code belew deletes user data from registration table
               if ($this->delete_data_registration($this->get_user_id_session()) && 
                  // the block of code below deletes data from response tables
                  $this->delete_data_response_rating($this->get_user_id_session()) &&
                  $this->delete_data_response($this->get_user_id_session())) {
                  // the block of code below executed in success case

                  // the code below prepares checking deletion url
                  // if all deletion operation were success return message with success and correct url
                  $this->deletion_success_message(self::preparing_checking_deletion_url());

                  $this->unsetUserSession();
                  $this->unsetFbUserSession();

                   } else { // the code here for unsuccess execution of method
                  $this->deletion_unsuccess_message();
                          }
            }       
        
        } catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                       } 
    }
    // the method below deletes user data from registration table
    private function delete_data_registration($user_session_id)
    {
        try {
            if (empty($user_session_id)) {
                throw new Exception("Empty parameter for delete_data_registration");
            }
            if (empty($this->get_object_validation_model()->deleteUserDataByUserid($user_session_id))) {
                $this->deletion_unsuccess_message();
                throw new Exception("delete_data_registration wasn't execution successful");
            } else { // return true in success case of method
                return true;
                   }
        } catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                       }
    }
    // the method below deletes user data from response_rating table
    private function delete_data_response_rating($user_session_id)
    {
        try {
            if (empty($user_session_id)) {
                throw new Exception("Empty parameter for delete_data_response_rating");
            }
            if (empty($this->get_object_response_model()->deleteResponseRatingByUserid($user_session_id))) {
                $this->deletion_unsuccess_message();
                throw new Exception("delete_data_response_rating method wasn't execution successful");
            } else { // return true in success case of method
                return true;
                   }
        } catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                       }
    }
    // the method below deletes user data from response table
    private function delete_data_response($user_session_id)
    {
        try {
            if (empty($user_session_id)) {
                throw new Exception("Empty parameter for delete_data_response");
            }
            if (empty($this->get_object_response_model()->deleteResponseByUserid($user_session_id))) {
                $this->deletion_unsuccess_message();
                throw new Exception("delete_data_response method wasn't execution successful");
            } else { // return true in success case of method
                return true;
                   }
        } catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                       }
    }

    
    // the method below for displaying page with user status of his deletion with alphanumeric cod
    public function deletion_status_page()
    {    
        $this->model('DeletionModel');
        $this->view('deletion' . DIRECTORY_SEPARATOR . 'index');
        $this->view->page_title = 'Статус видалення';
        $this->view->render();     
    }



}