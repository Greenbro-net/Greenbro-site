<?php

class FoodController extends Controller
{
    public function show_food()
    {    
         $this->model('FoodModel');
         $this->view('food' . DIRECTORY_SEPARATOR . 'index');
         $this->view->page_title = 'Продукти';
         $this->view->render();


        
         // testing code belowg
        //  $this->getResponses();

        // $this->model('ResponseModel');
        // $this->view('response' . DIRECTORY_SEPARATOR . 'index');
        // $this->view->render();

    }

    // public function getResponses()
    // {
    //     $this->model('ResponseModel');
    //     $responseObj = new ResponseModel();
    //     $responses = $responseObj->public_findItemResponse(97);
    //     return $responses;
        
    // }
}



// original code below 

// $this->model('FoodModel');
// $this->view('food' . DIRECTORY_SEPARATOR . 'index');
// $this->view->page_title = 'Продукти';
// $this->view->render();