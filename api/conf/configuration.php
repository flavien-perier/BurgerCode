<?php
    $_configuration;

    function configuration() {
        if (!isset($_configuration)) {
            $file = file_get_contents("./conf.json");
            $_configuration = json_decode($file, true);
        }
        return $_configuration;
    }