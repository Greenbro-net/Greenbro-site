<?php

class homeController extends Controller
{
    // the function below for main page 
    public function index($id='', $name='')
    {
        $this->view('home/index', [
            'name' => $name,
            'id'   => $id
        ]);
        // this is for title on page 
        $this->view->page_title = 'Greenbro.net';
        $this->view->render();
    }

    // the function below for contact page 
    public function contactUs()
    {
        $this->view('home/contactUs');
        $this->view->page_title = 'Контакти';
        $this->view->render();
    }

    // the function below for payment and shipping page 
    public function paymentShipping()
    {
        $this->view('home/paymentShipping');
        $this->view->page_title = 'Оплата і доставка';
        $this->view->render();
    }

    // the function below for allThings page 
    public function allThings()
    {
        $this->view('home/allThings');
        $this->view->page_title = 'Все разом';
        $this->view->render();
    }

    // the function below for books page 
    public function booksPage()
    {
        $this->view('home/books');
        $this->view->page_title = 'Література';
        $this->view->render();
    }

    // the function below for  goods page 
    public function goodsPage()
    {
        $this->view('home/goods');
        $this->view->page_title = 'Речі';
        $this->view->render();
    }

    // the function below for clothes page 
    public function clothesPage()
    {
        $this->view('home/clothes');
        $this->view->page_title = 'Одяг';
        $this->view->render();
    }

    // the function below for food page 
    // public function foodsPage()
    // {
    //     $this->view('home/foods');
    //     $this->view->page_title = 'Продукти';
    //     $this->view->render();
    // }

    
}