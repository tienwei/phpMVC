<?php

Class Commission_Model extends Model {
    
    function __construct($dbYear) {
        parent::__construct($dbYear);
    }
    
    public function getAllCommissions() {
        $sql = 'SELECT * FROM comm';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

