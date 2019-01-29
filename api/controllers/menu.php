<?php
require_once("./repositories/MenuRepository.php");
require_once("./services/LoginService.php");

function controller() {
    switch ($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            if (!isset($_GET["element"])) {
                throw new BadRequestException("no element id selected");
            }
            $menuRepository = new MenuRepository();
            $loginService = new LoginService();
            $loginService->verifyToken();

            return $menuRepository->get($_GET["element"]);
        case "POST":
            if (!isset($_GET["element"])) {
                throw new BadRequestException("no element id selected");
            }
            $menuRepository = new MenuRepository();
            $loginService = new LoginService();
            $loginService->verifyToken();

            $menuRepository->add($_GET["element"]);
            return null;
        case "DELETE":
            if (!isset($_GET["element"])) {
                throw new BadRequestException("no element id selected");
            }
            $menuRepository = new MenuRepository();
            $loginService = new LoginService();
            $loginService->verifyToken();

            $menuRepository->delete($_GET["element"]);
            return null;
        case "PUT":
            if (!isset($_GET["element"])) {
                throw new BadRequestException("no element id selected");
            }
            $body = json_decode(file_get_contents("php://input"));
            if (!isset($body->name) || 
                !isset($body->description) || 
                !isset($body->prix) || 
                !isset($body->picture) || 
                !isset($body->category_id)) {
                    throw new BadRequestException("malformed body");
                }

            $menuRepository = new MenuRepository();
            $loginService = new LoginService();
            $loginService->verifyToken();

            $menuRepository->edit(
                $_GET["element"],
                $body->name,
                $body->description,
                $body->prix,
                $body->picture,
                $body->category_id
            );
            return null;
        default:
            throw new NotFoundException();
    }
}