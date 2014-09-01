<?php

class User_Model extends Model {

    function __construct($dbYear) {
        parent::__construct($dbYear);
    }

    private function checkValidUsername($username) {
        $sql = 'SELECT * FROM BCC_USERS WHERE username=:username';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(":username" => $username));
        if ($stmt->rowCount() == 0) {
            return true;
        } else {
            return false;
        }
    }

    private function checkCurrentPassword($userID, $currentPassword) {
        $sql = 'SELECT * FROM BCC_USERS WHERE userID=:userID AND password=MD5(:password)';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(":userID" => $userID, ":password" => $currentPassword));
        if ($stmt->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function saveUser($formArray) {
        try {
            if (isset($formArray['userID'])) {
                // check current password
                if ($this->checkCurrentPassword($formArray['userID'], $formArray['currentPassword'])) {
                    // update the user's password
                    $sql1 = 'UPDATE BCC_USERS '
                            . 'SET password=MD5(:password) WHERE userID=:userID';
                    $stmt1 = $this->db->prepare($sql1);
                    $stmt1->execute(array(":password" => $formArray['newPassword'],
                        ":userID" => $formArray['userID']));
                    Session::set('message', 'The user has been updated');
                    header('location:' . URL . 'index');
                } else {
                    Session::set('errorMsg', 'Current password is incorrect, please try again');
                    header('location:' . URL . 'user/updatePassword/' . $formArray['userID']);
                }
            } else {

                //add a new user
                if ($this->checkValidUsername($formArray['newUsername'])) {
                    $sql1 = 'INSERT INTO BCC_USERS (username, password) VALUES ('
                            . ':username, MD5(:password))';
                    $stmt1 = $this->db->prepare($sql1);

                    $stmt1->execute(array(":username" => $formArray['newUsername'], ":password" => $formArray['newPassword']));
                    Session::set('message', $formArray['newUsername'] . ' has been added');
                    header('location:' . URL . 'index');
                } else {
                    // username has been taken
                    Session::set('errorMsg', 'The username has been taken, please select another username');
                    header('location:' . URL . 'user/addUser');
                }
            }
        } catch (PDOException $e) {
            Session::set('errorMsg', $e->getMessage());
            header('location:' . URL . 'error/error');
        }
    }

    public function getAllOtherUsers() {
        try {
            $sql = 'SELECT * FROM BCC_USERS';
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            Session::set('errorMsg', $e->getMessage());
            header('location:' . URL . 'error/error');
        }
    }

    public function updatePassword() {
        try {
            $sql = 'SELECT * FROM BCC_USERS';
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            Session::set('errorMsg', $e->getMessage());
            header('location:' . URL . 'error/error');
        }
    }

}
