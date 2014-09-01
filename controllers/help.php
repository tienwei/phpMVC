<?php

class Help extends Controller {

    function __construct() {
        parent::__construct();
        //Session::init();
        $logged = Session::get('loggedIn');

        if ($logged == false) {
            Session::destory();
            header('location: login');
            exit();
        }
    }

    public function index() {
        $this->view->render('help/index');
    }


    public function areaInfoLookup() {        
        $this->view->areaInfo = $this->model->getAreaLists(); 
        $this->view->render('help/areaInfoLookup');
    }
    
    public function addArea() {        
        $this->view->render('help/addArea');
    }
    
    public function deleteArea($suburb) {
        $this->model->deleteArea($suburb);
        $this->view->areaInfo = $this->model->getAreaLists(); 
        $this->view->render('help/areaInfoLookup');
    }
    
    public function saveArea() {
        $form = filter_input_array(INPUT_POST);
        $this->model->saveArea($form); 
        $this->view->areaInfo = $this->model->getAreaLists(); 
        $this->view->render('help/areaInfoLookup');
    }

    public function encodeCustomerNameUrl ($customerName) {
            $str = str_replace('&', '@', $customerName);
            $str = str_replace('/', '**', $str);
            return str_replace(' ', '*', $str);
    }
    
    public function decodeUrlCustomerName ($urlCustomerName) {
            $str = str_replace('**', '/', $urlCustomerName);
            $str = str_replace('@', '&', $str);
            return str_replace('*', ' ', $str);
    }
}
