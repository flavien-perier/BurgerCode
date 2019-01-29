<?php
class HttpException extends Exception {
    protected $status;

    function __construct($message) {
        parent::__construct($message);
    }

    public function getStatus() {
        return $this->status;
    }
}