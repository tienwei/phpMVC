<?php
Class Login Extends Controller {
    function __construct () {
        parent::__construct();
    }
    
    public function index() {
        $this->view->render('login/index');
    }
    
    public function authenticate() {
        $formArray = filter_input_array(INPUT_POST);
        $this->model->authenticate($formArray);
    }
}

