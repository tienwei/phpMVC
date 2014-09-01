<?php

class Error extends Controller{

    function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $this->view->msg = "This page does not exist!";
        $this->view->render('error/index');
    }
    
    public function error() {
        $this->view->msg = "Error! Please click<a href='". URL ."'> here</a> to "
                . "restart the program.";
        $this->view->render('error/index');
    }

}
