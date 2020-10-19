<?php

class BookController extends Controller
{
    public function show_books()
    {
        $this->model('BookModel');
        $this->view('book' . DIRECTORY_SEPARATOR . 'index');
        $this->view->page_title = 'Література';
        $this->view->render();
    }
}