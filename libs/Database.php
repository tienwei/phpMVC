<?php

class Database extends PDO {

    function __construct($dbYear) {
        try {
            parent::__construct(DB_TYPE . ":host=" . DB_HOST . ";dbname=" .
                    DB_NAME.$dbYear, DB_USERNAME, DB_PASSWORD);
        } catch(Exception $e) {
            echo '<b>Oops...some error occurs</b> : ' . $e->getMessage();
            echo '<br /><a href='.URL.'>Let us start again</a>';
        }
    }

}

