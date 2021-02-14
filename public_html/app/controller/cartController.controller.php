<?php

class cartController extends Controller
{
    public function show_cart_item()
    {
        $this->model('CartModel');
        $this->view('cart' . DIRECTORY_SEPARATOR . 'index');
        $this->view->render();
    }
}

?>