<?php
class BadRequestException extends HttpException {
    function __construct($message) {
        $this->status = 400;
        parent::__construct($message);
    }
}