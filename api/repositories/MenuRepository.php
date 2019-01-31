<?php
require_once("./conf/pdo.php");
class MenuRepository {
    private $pdo;

    function __construct() {
        $this->pdo = pdo();
    }

    public function getAll() {
        $req = $this->pdo->prepare("SELECT menu.id AS id, menu.name AS name, menu.description AS description, menu.prix AS prix, menu.picture AS picture, menu.categorie_id AS categorie_id, categorie.name AS categorie FROM menu INNER JOIN categorie ON categorie.id = menu.categorie_id;");
        $req->execute();
        $result = $req->fetchAll();
        $req->closeCursor();
        return $result;
    }

    public function get($elementId) {
        $req = $this->pdo->prepare("SELECT * FROM menu WHERE id = :elementId;");
        $req -> bindParam(":elementId", $elementId, PDO::PARAM_INT);
        $req->execute();
        $result = $req->fetchAll();
        $req->closeCursor();
        return $result[0];
    }

    public function add($elementId) {
        $req = $this->pdo->prepare("INSERT INTO menu(name, description, prix, picture, categorie_id) VALUES ('new menu', 'description', 10, 'm1.png', :elementId);");
        $req -> bindParam(":elementId", $elementId, PDO::PARAM_INT);
        $req->execute();
        $result = $req->fetchAll();
        $req->closeCursor();
        return $result;
    }

    public function delete($elementId) {
        $req = $this->pdo->prepare("DELETE FROM menu WHERE id = :elementId");
        $req -> bindParam(":elementId", $elementId, PDO::PARAM_INT);
        $req->execute();
        $result = $req->fetchAll();
        $req->closeCursor();
        return $result;
    }

    public function edit($elementId, $name, $description,
                         $prix, $picture, $categorie_id) {
        $req = $this->pdo->prepare("UPDATE menu SET name = :name, description = :description, prix = :prix, picture = :picture, categorie_id = :categorie_id WHERE id = :elementId;");
        $req -> bindParam(":elementId", $elementId, PDO::PARAM_INT);
        $req -> bindParam(":name", $name, PDO::PARAM_STR);
        $req -> bindParam(":description", $description, PDO::PARAM_STR);
        $req -> bindParam(":prix", $prix, PDO::PARAM_STR);
        $req -> bindParam(":picture", $picture, PDO::PARAM_STR);
        $req -> bindParam(":categorie_id", $categorie_id, PDO::PARAM_INT);
        $req->execute();
        $result = $req->fetchAll();
        $req->closeCursor();
        return $result;
    }
}