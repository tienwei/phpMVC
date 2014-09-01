<?php

class View {

    function __construct() {
    }
    
    public function render($name) {
        if ($name === "invoice/generateInvoice") {
            require ('views/' . $name . '.php');
        } else{
            require 'views/header.php';
            require 'views/' . $name . '.php';
            require 'views/footer.php';
        }
        
    }

}
