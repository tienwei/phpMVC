<?php

class Login_Model extends Model {

    function __construct($dbYear) {
        parent::__construct($dbYear);
    }

    public function authenticate($formArray) {

        $stat = $this->db->prepare("SELECT userID FROM BCC_USERS "
                . "WHERE username=:username AND "
                . "password=MD5(:password)");

        $stat->execute(array(
            ':username' => $formArray['username'],
            ':password' => $formArray['password']
        ));

        if ($stat->rowCount() == 1) {
            // login
            //Session::init();
            Session::set('loggedIn', true);
            Session::set('userID', $stat->fetch()['userID']);
            Session::set('errorMsg', '');
            header('location:' . URL . 'index');
        } else {
            // show an error
            Session::set('loggedIn', false);
            Session::set('message', '');
            Session::set('errorMsg', 'Your username or password are incorrect. Please try again');
            header('location:' . URL . 'login');
        }
    }


}
