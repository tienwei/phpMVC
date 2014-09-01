<?php

class Controller {

    function __construct() {
        $this->view = new View();
    }
    
    public function loadModel($filename, $dbYear) {
        $path = 'models/' . $filename . '_model.php';
        
        if(file_exists($path)) {
            require $path;
            $modelName = $filename . '_Model';
            $this->model = new $modelName($dbYear);
        }
    }

}

