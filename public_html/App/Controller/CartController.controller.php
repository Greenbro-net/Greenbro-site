<?php

namespace App\Controller;

use App\Core\Controller;

class CartController extends Controller
{
    public function show_cart_item()
    {
        $this->model('CartModel');
        $this->view('cart' . DIRECTORY_SEPARATOR . 'index');
        $this->view->render();
    }

    // the code below has testing purpose
    public function call_getMemberCartItem($united_order_items)
    {
       try {
          if (empty($united_order_items)) {
              throw new Exception("Method call_getMemberCartItem has got empty parameter");
          }

           $result_call_getMemberCartItem = $this->load_model_obj('CartModel')->getMemberCartItem($united_order_items);
            if (empty($result_call_getMemberCartItem)) {
                return false; // no entry in DB
            } else {
                return $result_call_getMemberCartItem;
                   }

           } catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
              'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                          }
       
    }
}

?>