<?php

    // TO DO 
    // create a link which can help our customer if he has some troubles with ordering
class FinalOrderController extends Controller
{
    public function display_successful_message()
    {   
        $this->view('final_order' . DIRECTORY_SEPARATOR . 'successful_order');
        $this->view->page_title = 'Замовлення успішно оформлене';
        $this->view->render();
    }

    public function get_order_number()
    {    
        return $_SESSION["united_order_items"];
    }

    // the function below unset $_SESSION
    public function unset_session()
    {
        unset($_SESSION["last_customer_id"]);
        unset ($_SESSION["united_order_items"]);
    }
    
    public function unset_last_customer_id()
    {
        unset($_SESSION["last_customer_id"]);
    }

    public function display_unsuccessful_message()
    {
        $this->view('final_order' . DIRECTORY_SEPARATOR . 'unsuccessful_order');
        $this->view->page_title = 'Замовлення не було сформовано успішно';
        $this->view->render();
    }
    
}