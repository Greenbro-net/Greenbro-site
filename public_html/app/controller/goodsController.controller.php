<?php

class GoodsController extends Controller 
{
    public function show_goods()
    {
        $this->model('GoodsModel');
        $this->view('goods'. DIRECTORY_SEPARATOR . 'index');
        $this->view->page_title = 'Речі';
        $this->view->render();
    }
}