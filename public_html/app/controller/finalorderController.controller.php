<?php

    // TO DO 
    // create a link which can help our customer if he has some troubles with ordering
class FinalOrderController extends Controller
{
    use sessionTrait;

    public function display_successful_message()
    {   // the method below unset session before redirection
        $this->unset_order_session();

        $this->view('final_order' . DIRECTORY_SEPARATOR . 'successful_order');
        $this->view->page_title = 'Замовлення успішно оформлене';
        $this->view->render();
    }
    public function display_unsuccessful_message()
    {
        $this->view('final_order' . DIRECTORY_SEPARATOR . 'unsuccessful_order');
        $this->view->page_title = 'Замовлення не було сформовано успішно';
        $this->view->render();
    }

    public function get_order_number()
    {    
        return $_SESSION["united_order_items"];
    }

    

    
    
}