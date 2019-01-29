<?php
require_once("./repositories/CategoryRepository.php");

function controller() {
    switch ($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            $categoryRepository = new CategoryRepository();
        
            return array(
                "categories" => $categoryRepository->getAll()
            );
        default:
            throw new NotFoundException();
    }
}