<?php
session_start();
if (empty(filter_input(INPUT_POST, 'dbYear')) && !isset($_GET['url'])) {
    echo '
<!DOCTYPE HTML>
<html>
    <head>
        <title>Set up DB</title>
    </head>
    <body>
    
            <div style="padding:20px;
    background: #FFFECD;
    text-align: center;">
                <p><img style="vertical-align: middle;" src="http://localhost:80/CBDApp/public/images/cbd_logo.png"> 
                    <span style="color:#611526;font-size:20px;">Client/Sales Management System</span>
                </p>
                            </div>
        

        <div style="padding:20px;height:100%;background: white;font-size:20px;
    text-align: center;font-size:20px;">
                       
<br>
        <form action="index" method="post">
            <label for="dbYear">Please select a year for database</label>
            <select name="dbYear">
                <option value="2014">2014</option>
                <option value="2013">2013</option>
                <option value="2010">2010</option>
            </select>
            <input type="submit" value="Start the program">
        </form>
        </div>
        <div style="padding: 20px;background: #E24242;">
            <span style="color:#B7DCEA;">&copy; 2014 Powered by <b>The Winning Fellows Pty Ltd</b></span>
        </div>
    </body>
</html>';
} else {
    if (!isset($_SESSION['dbYear'])) {
        $_SESSION['dbYear'] = filter_input(INPUT_POST, 'dbYear');
    } elseif (!empty(filter_input(INPUT_POST, 'dbYear'))) {
        $_SESSION['dbYear'] = filter_input(INPUT_POST, 'dbYear');
    }
    // use an autoloader
    /*     * * nullify any existing autoloads ** */
    spl_autoload_register(null, false);

    /*     * * specify extensions that may be loaded ** */
    spl_autoload_extensions('.php');

    /*     * * class Loader ** */

    function libLoader($class) {
        //$filename = strtolower($class) . '.lib.php';
        $file = 'libs/' . $class . '.php';
        if (!file_exists($file)) {
            return false;
        }
        include $file;
    }

    function modelLoader($class) {
        $file = 'models/' . strtolower($class) . '.php';
        if (!file_exists($file)) {
            return false;
        }
        include $file;
    }
    
    function controllerLoader($class) {
        $file = 'controllers/' . strtolower($class) . '.php';
        if (!file_exists($file)) {
            return false;
        }
        include $file;
    }

    /*     * * register the loader functions ** */
    spl_autoload_register('libLoader');
    spl_autoload_register('modelLoader');
    spl_autoload_register('controllerLoader');

// configs
    require "config/paths.php";
    require "config/database.php";

    $app = new Bootstrap($_SESSION['dbYear']);
}
?>