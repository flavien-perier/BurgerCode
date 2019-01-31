<?php
require_once("./conf/pdo.php");
class CategorieRepository {
    private $pdo;

    function __construct() {
        $this->pdo = pdo();
    }

    public function getAll() {
        $req = $this->pdo->prepare("SELECT id, name FROM categorie");
        $req->execute();
        $result = $req->fetchAll();
        $req->closeCursor();
        return $result;
    }
}