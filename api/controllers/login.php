<?php
require_once("./services/LoginService.php");

function controller() {
    switch ($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            $loginService = new LoginService();
            if (!isset($_SERVER["HTTP_USERNAME"]))
                throw new AuthException("no username");
            if (!isset($_SERVER["HTTP_PASSWORD"]))
                throw new AuthException("no password");
            
            $token = $loginService->verifyPassword($_SERVER["HTTP_USERNAME"], $_SERVER["HTTP_PASSWORD"]);
            return array(
                "token" => $token
            );
        default:
            throw new NotFoundException();
    }
}