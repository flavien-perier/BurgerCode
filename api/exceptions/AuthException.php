<?php
class AuthException extends HttpException {
    function __construct($message) {
        $this->status = 403;
        parent::__construct($message);
    }
}