<?php

class Customer extends Controller {

    private $helpModel;

    function __construct() {
        parent::__construct();
        //Session::init();
        $logged = Session::get('loggedIn');

        // load help model
        $this->helpModel = new Help_Model(Session::get('dbYear'));
        // load help Controller
        $this->helpController = new Help();

        if ($logged == false) {
            Session::destory();
            header('location: login');
            exit();
        }
    }

    public function index() {

        // return suburb/state/postcode lists        
        $this->view->areaInfo = $this->helpModel->getAreaLists();
        $this->view->render('customer/index');
    }

    public function register() {
        $this->model->register();
    }

    public function getExistingCustomers() {
        $this->view->customers = $this->model->getExistingCustomers();
        $this->view->helper = $this->helpController;
        $this->view->render('customer/getExistingCustomers');
    }

    public function finish() {
        $this->view->render('customer/finish');
    }

    public function duplicate() {
        $this->view->render('customer/duplicate');
    }

    public function getCustomer($customerName) {
        $this->view->areaInfo = $this->helpModel->getAreaLists();
        $this->view->customer = $this->model->getCustomer(
                $this->helpController->decodeUrlCustomerName($customerName));
        $this->view->render('customer/getCustomer');
    }
    
    public function getCustomerInfo($customerName) {
        $this->view->customer = 
                $this->model->getCustomer(
                        $this->helpController->decodeUrlCustomerName(
                                $customerName));
        $this->view->render('customer/getCustomerInfo');
    }

    public function updateCustomer() {
        $urlCustomerName = 
                $this->helpController->encodeCustomerNameUrl(
                        filter_input(INPUT_POST,'customerName'));
        $this->model->updateCustomer(filter_input_array(INPUT_POST), $urlCustomerName);
    }

    public function deleteCustomer($customerName) {
        $this->model->deleteCustomer($this->helpController->decodeUrlCustomerName($customerName));
    }

}
