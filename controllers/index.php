<?php

class Index extends Controller{

    function __construct() {
        parent::__construct();
        //Session::init();
        $logged = Session::get('loggedIn');
        
        if($logged == false) {
            //Session::destory();
            header('location: login');
            exit();
        } 
    }

    public function index() {
        $this->view->render('index/index');
    }
    
    public function details() {
        $this->view->render('index/index');
    }
    
    public function logout() {
        Session::destory();
        Session::set('loggedIn', false);
        header('location:'. URL);
        exit();
    }
}