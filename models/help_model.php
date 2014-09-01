<?php

class Help_Model extends Model {

    function __construct($dbYear) {
        parent::__construct($dbYear);
    }
    
    public function getAreaLists() {
        $stat = $this->db->prepare('SELECT * FROM SUSTPC');
        $stat->execute();
       
        return $stat->fetchAll();
    }
    
    public function getDisplayUnitList() {
        return array('1 UNIT', '2 UNIT (H)', '2 UNIT (V)', '3 UNIT (H)', 
            '3 UNIT (V)', '4 UNIT (H)', '4 UNIT (V)','6 UNIT (H)', '6 UNIT (V)',
            '8 UNIT (V)', '9 UNIT', 'LISTING', 'INTERNET', 'HALF COLOR', 
            'FULL MONO', 'FULL COLOR', 'EDITORIAL', 'CUSTOM', 'CONTRA', 'SPECIAL');    
    }
    
    public function getClassificationList() {
        $stat = $this->db->prepare('SELECT * FROM CLI');
        $stat->execute();
       
        return $stat->fetchAll();
    }
    
    public function saveArea($form) {
        $stat = $this->db->prepare('INSERT INTO SUSTPC (`SU`,`ST`,`PC`) VALUES '
                . '(:suburb,:state,:postcode)');
        $stat->execute(array(":suburb" => $form['suburb'],
            ":state"=>$form['state'], ":postcode" => $form['postcode']));
        Session::set('message', 'The new area has been added.');
    }
    
    public function deleteArea($suburb) {
        $stat = $this->db->prepare('DELETE FROM SUSTPC WHERE `SU`=:suburb');
        $stat->execute(array(":suburb" => $suburb));
        Session::set('message', 'The new area has been deleted.');
    }
}

