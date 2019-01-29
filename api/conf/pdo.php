<?php
    require_once("./conf/configuration.php");

    $_pdo;
    
    function pdo() {
        if (!isset($_pdo)) {
            $_pdo = new PDO (
                configuration()["db"]["host"], 
                configuration()["db"]["user"], 
                configuration()["db"]["password"]);
        }
        return $_pdo;
    }