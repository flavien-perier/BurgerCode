<?php
require_once("./repositories/UserRepository.php");
require_once("./conf/configuration.php");

class LoginService {
    private $salt;

    private $userRepository;

    function __construct() {
        $this->salt = configuration()["salt"];
        $this->userRepository = new UserRepository();
    }

    private function passwordHash($password) {
        return hash('sha512', $this->salt.$password);
    }

    private function createToken() {
        $date = new DateTime();
        return hash('sha256', $date->getTimestamp().rand(1, 10000000));
    }

    public function verifyPassword($username, $password) {
        $user = $this->userRepository->getUser($username);
        if ($username == $user["username"]) {
            if ($this->passwordHash($password) == $user["password"]) {
                $token = $this->createToken();
                $this->userRepository->updateToken($username, $token);
                return $token;
            } else {
                throw new AuthException("Bad password");
            }
        } else {
            throw new AuthException("Bad user");
        }
    }

    public function verifyToken() {
        if (!isset($_SERVER["HTTP_USERNAME"]))
                throw new AuthException("no username");
        if (!isset($_SERVER["HTTP_TOKEN"]))
            throw new AuthException("no token");

        $user = $this->userRepository->getUser($_SERVER["HTTP_USERNAME"]);
        if ($_SERVER["HTTP_USERNAME"] == $user["username"] && $_SERVER["HTTP_TOKEN"] == $user["token"])
            return true;
        throw new AuthException("Bad token");
    }
}