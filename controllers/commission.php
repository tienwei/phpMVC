<?php

class Commission extends Controller {
    
    function __construct() {
        parent::__construct();
        // load commission model
        $this->commissionModel = new Commission_Model(Session::get('dbYear'));
    }
    
    public function getAllCommissions() {
        $this->view->commRecords = $this->model->getAllCommissions();
        $this->view->render('commission/getAllCommissions');
    }
    
    public function addCommission() {
        // waiting for Ye
    }
}

