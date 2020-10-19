<?php

class ClothesController extends Controller
{
    public function show_clothes()
    {
       $this->model('ClothesModel');
       $this->view('clothes' . DIRECTORY_SEPARATOR . 'index');
       $this->view->page_title = 'Одяг';
       $this->view->render();
    }
}