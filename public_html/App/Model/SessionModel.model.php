<?php


namespace App\Model;


use App\Data\DBControllerData;
use Exception;


// Blueprint:
//1. make query to DB and  get last from order_items last order_items_id plus to that 1;
//2. use date function create $_SESSION["united_order_items"] do it like 
//3. then we create function get_united_order_items which returns it to other function which requires it
class SessionModel extends DBControllerData
{
    private $united_order_items;


    public function __construct()
    {
        $this->united_order_items = $this->set_session();
    }


    // the function below get current date
    protected function get_unite_date()
    {  
        try {
            $result_get_united_date = date("Ymd");

            if (empty($result_get_united_date)) {
                throw new Exception("Function get_unite_date wasn't successful");
            } else {
                return $result_get_united_date;
            }
        } catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
            'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
        }  
    }


    // the method below gets last order_items_id from order_items table
    protected function get_last_id()
    {
        try { 
            $query = "SELECT * FROM `order_items` WHERE order_items_id = (
            SELECT MAX(order_items_id) FROM `order_items`)";
            $last_order_items_id = self::query($query);

            $params = array(
                "param_type" => "i",
                "param_value" => 0);
            //then we return the value for row united_order_items for other customer ordering and plus to the value 1
            $result_get_last_id = (int)$last_order_items_id[0]["order_items_id"];
                  
            if (empty($result_get_last_id)) {
                throw new Exception("Function get_last_id wasn't successful");
            } else {
                return $result_get_last_id;
            }
        } catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
            'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
        }
    }


    // the function below set value for $_SESSION["united_order_items"]
    protected function set_session()
    {   
        try { 
            //the is below controls creating of new $_SESSION 
            if (empty($_SESSION["united_order_items"])) {
                
                $_SESSION["united_order_items"] = (int)intval($this->get_last_id() +1 . $this->get_unite_date());
                return $_SESSION["united_order_items"];

            } elseif (empty($_SESSION["united_order_items"])) {
                throw new Exception("Session wasn't created successful in set_session method");
            } else {
                return $_SESSION["united_order_items"];
            }
        } catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
            'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
        }
    }


    // the method below returns $united_order_items for other functions 
    public function grab_united_order_items()
    {   
        try {
            $result_get_united_order = $this->united_order_items;

            if (empty($result_get_united_order)) {
                throw new Exception("Function grab_united_order_items wasn't successful");
            } else {
                return $result_get_united_order;
            }
        } catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
            'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
        }
    }

}