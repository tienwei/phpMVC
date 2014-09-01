<?php

class Report extends Controller {

    function __construct() {
        parent::__construct();
        //Session::init();
        $logged = Session::get('loggedIn');

        // load job model
        $this->jobModel = new Job_Model(Session::get('dbYear'));
        // load commission model
        $this->commissionModel = new Commission_Model(Session::get('dbYear'));
        
        $this->helpController = new Help();
        
        if ($logged == false) {
            Session::destory();
            header('location: login');
            exit();
        }
    }

    public function index() {
        $this->view->render('report/index');
    }

    public function jobDetailReport() {
        // generate job detail report
        $this->view->helper = $this->helpController;
        $this->view->allJobs = $this->jobModel->getAllJobs();
        $this->view->render('report/jobDetailReport');
    }

    public function classificationReport() {
        // generate classification report
        $this->view->allJobItems = $this->jobModel->getAllJobItems();
        $this->view->render('report/classificationReport');
    }

    public function salesDetailReport() {
        // generate sales commission report
        $this->view->helper = $this->helpController;
        $this->view->allJobs = $this->jobModel->getAllJobs();
        $this->view->render('report/salesDetailReport');
    }
    
    public function salesCommissionReport() {
        // generate sales commission report
        $this->view->helper = $this->helpController;
        $this->view->commRecords = $this->commissionModel->getAllCommissions();
        $this->view->render('report/salesCommissionReport');
    }

}
