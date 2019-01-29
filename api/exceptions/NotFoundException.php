<?php
class NotFoundException extends HttpException {
    function __construct($message) {
        $this->status = 404;
        parent::__construct($message);
    }
}