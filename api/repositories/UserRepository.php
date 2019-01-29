<?php
require_once("./conf/pdo.php");
class UserRepository {
    private $pdo;

    function __construct() {
        $this->pdo = pdo();
    }

    public function getUser($username) {
        $req = $this->pdo->prepare("SELECT * FROM user WHERE username = :username");
        $req -> bindParam(":username", $username, PDO::PARAM_STR);
        $req->execute();
        $result = $req->fetchAll();
        $req->closeCursor();
        return isset($result[0]) ? $result[0] : null;
    }

    public function updateToken($username, $token) {
        $req = $this->pdo->prepare("UPDATE user SET token = :token WHERE username = :username");
        $req -> bindParam(":username", $username, PDO::PARAM_STR);
        $req -> bindParam(":token", $token, PDO::PARAM_STR);
        $req->execute();
        $result = $req->fetchAll();
        $req->closeCursor();
        return isset($result[0]) ? $result[0] : null;
    }
}