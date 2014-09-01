<?php

class Job extends Controller {

    function __construct() {
        parent::__construct();
        //Session::init();
        $logged = Session::get('loggedIn');

        // load help model
        $this->helpModel = new Help_Model(Session::get('dbYear'));
        // load help controller
        $this->helpController = new Help();

        // load customer model
        $this->customerModel = new Customer_Model(Session::get('dbYear'));

        if ($logged == false) {
            Session::destory();
            header('location: login');
            exit();
        }
    }

    public function index($customerName) {
        $this->view->units = $this->helpModel->getDisplayUnitList();
        $this->view->classifications = $this->helpModel->getClassificationList();
        $this->view->urlCustomerName = $customerName;
        $this->view->customerName = $this->helpController->decodeUrlCustomerName($customerName);
        $this->view->render('job/index');
    }

    public function saveJob() {
        $form = filter_input_array(INPUT_POST);
        $this->model->saveJob($form);
    }

    public function updateJob($jobNo) {
        $this->view->updatedJob = $this->model->getJobByJobNo($jobNo)[0][0];
        $this->view->updatedJobItems = $this->model->getJobByJobNo($jobNo)[1];
        $this->view->units = $this->helpModel->getDisplayUnitList();
        $this->view->classifications = $this->helpModel->getClassificationList();
        $this->view->urlCustomerName = 
                $this->helpController->encodeCustomerNameUrl(
                        $this->view->updatedJob['Customer Name']);
        $this->view->render('job/updateJob');
    }

    public function retrieveJobs($customerName) {
        $jobs = $this->model->retrieveJobs(
                $this->helpController->decodeUrlCustomerName($customerName))[0];
        $this->view->booleanJob = ($jobs != 0);
        $this->view->urlCustomerName = $customerName;
        $this->view->customerName = $this->helpController->decodeUrlCustomerName($customerName);

        if ($this->view->booleanJob) {
            $this->view->jobs = $jobs;
        }
        $this->view->jobItems = $this->model->retrieveJobItems($jobs['Job No']);
        $this->view->render('job/retrieveJobs');
    }

    public function getAllJobs() {
        $this->view->allJobs = $this->model->getAllJobs();
        $this->view->render('job/getAllJobs');
    }

    public function getOutstandingJobs() {
        $this->view->outstandingJobs = $this->model->getOutstandingJobs();
        $this->view->helper = $this->helpController;
        $this->view->render('job/getOustandingJobs');
    }

    public function getPaidoffJobs() {
        $this->view->paidoffJobs = $this->model->getPaidoffJobs();
        $this->view->helper = $this->helpController;
        $this->view->render('job/getPaidoffJobs');
    }

    public function deleteJob($customerName) {
        $this->model->deleteJob(
                $this->helpController->decodeUrlCustomerName($customerName), $customerName);
    }

//    public function invoiceJob($customerName) {
//        //$this->model->invoiceJob($customerName);
//        $this->view->render('invoice');
//    }

}
