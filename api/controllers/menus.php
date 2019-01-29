<?php
require_once("./repositories/MenuRepository.php");
require_once("./services/LoginService.php");

function controller() {
    switch ($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            $menuRepository = new MenuRepository();
            return array(
                "menus" => $menuRepository->getAll()
            );
        default:
            throw new NotFoundException();
    }
}