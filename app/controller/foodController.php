<?php

class foodController extends Controller
{
    public function show_food()
    {    $this->model('food');
         $this->view('food' . DIRECTORY_SEPARATOR . 'index');
         $this->view->page_title = 'Продукти';
         $this->view->render();

    }
}