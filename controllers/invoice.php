<?php

class Invoice extends Controller {
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
        
        // load job model
        $this->jobModel = new Job_Model(Session::get('dbYear'));

        if ($logged == false) {
            Session::destory();
            header('location: login');
            exit();
        }
    }
    
    public function index($customerName) {
        $this->view->customerName = $customerName;
        $this->view->render('invoice/index');
    }   
    
    public function generateInvoice() {
        $formArray = filter_input_array(INPUT_POST);
        $this->view->customer = 
                $this->customerModel->getCustomer(
                        $this->helpController->decodeUrlCustomerName($formArray['customerName']));
        $this->view->jobDetail = 
                $this->jobModel->retrieveJobs(
                        $this->helpController->decodeUrlCustomerName($formArray['customerName']))[0];
        $this->view->jobItems = $this->jobModel->retrieveJobItems($this->view->jobDetail['Job No']); 
        
        $this->view->invoiceNo = $formArray['invoiceNo'];
        $this->view->render('invoice/generateInvoice');
    }
}
