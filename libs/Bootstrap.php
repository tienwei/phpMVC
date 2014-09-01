<?php

class Bootstrap {
    function __construct($dbYear) {
        $url = isset($_GET['url'])?$_GET['url']:null;
        $url = rtrim($url);
        $url = explode('/', $url);
        
        if(empty($url[0])) {
            require 'controllers/index.php';
            $controller = new Index();
            $controller->index();
            
            return false;
        }
        
        $file = 'controllers/' . $url[0] . '.php';
        if(file_exists($file)) {
            require $file;
        } else {
            $this->error();
        }
        
        $controller = new $url[0];
        //print_r($_SESSION);
        $controller->loadModel($url[0],$dbYear);

        // calling method
        if (isset($url[2])) {
            if (method_exists($controller, $url[1])) {
                $controller->{$url[1]}($url[2]);
            } else {
                $this->error();
            }
        } else {
            if (isset($url[1])) {
                if (method_exists($controller, $url[1])) {
                    $controller->{$url[1]}(); 
                } else {
                    $this->error();
                }
            } else {
                $controller->index();
            }
        }
    }
    
    // Page doesnt exist handing
    function error() {
            require 'controllers/error.php';
            $controller = new Error();
            $controller->index();
            return false;
    }


}
