<?php

class HomeController extends Controller
{
    // the function below for main page (greenbro.net)
    public function index()
    {
        $this->model('AllProductsModel');
        $this->view('home' . DIRECTORY_SEPARATOR . 'index');
        $this->view->page_title = 'Все разом';
        $this->view->render();
    }

    // the function below for allThings page 
    public function allThings()
    {
        $this->model('AllProductsModel');
        $this->view('home' . DIRECTORY_SEPARATOR . 'index');
        $this->view->page_title = 'Все разом';
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

    // the function below for pages what do not exist
    public function unknownPage()
    {
        $this->view('home/404');
        $this->view->page_title = '404';
        $this->view->render();
    }

    // the method below displays oferta of our site
    public function showOferta()
    {
        $this->view('home/showOferta');
        $this->view->page_title = 'Публічна оферта';
        $this->view->render();
    }

    // the method below displays Privacy Policy
    public function showPrivacyPolicy()
    {
        $this->view('home/showPrivacyPolicy');
        $this->view->page_title = 'Privacy Policy';
        $this->view->render();
    }

    // the method below displays Terms of Service
    public function showTermsofService()
    {
        $this->view('home/showTermsofService');
        $this->view->page_title = 'Terms of Service';
        $this->view->render();
    }


    
}