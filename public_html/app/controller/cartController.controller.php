<?php

class cartController extends Controller
{
    public function show_cart_item()
    {
        $this->model('cart');
        $this->view('cart' . DIRECTORY_SEPARATOR . 'index');
        $this->view->render();
    }
}

?>