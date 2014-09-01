<?php
class User extends Controller {
    function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $this->view->render('user/index');
    }

    public function addUser() {
        $this->view->render('user/addUser');
    }
    
    public function updatePassword($userID) {
        $this->view->userID = $userID;
        $this->view->render('user/updatePassword');
    }
    
    public function saveUser() {
        $this->model->saveUser(filter_input_array(INPUT_POST));
    }
    
//    public function getAllOtherUsers($username) {
//        $this->view->users = $this->model->getAllOtherUsers($username);
//        $this->view->render('user/getAllOtherUsers');
//    }
}
