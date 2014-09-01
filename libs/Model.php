<?php

class Model {

    function __construct($dbYear) {
        $this->db = new Database($dbYear);
    }
}

