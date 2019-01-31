<?php
require_once("./repositories/CategorieRepository.php");

function controller() {
    switch ($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            $categorieRepository = new CategorieRepository();
        
            return array(
                "categories" => $categorieRepository->getAll()
            );
        default:
            throw new NotFoundException();
    }
}