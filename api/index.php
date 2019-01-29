<?php
require_once("exceptions/HttpException.php");
require_once("exceptions/AuthException.php");
require_once("exceptions/NotFoundException.php");
require_once("exceptions/BadRequestException.php");

header("Content-Type: application/json");

if (isset($_GET["page"]) AND !empty($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = "home";
}

$allPages = scandir("controllers/");

if (isset($_GET["element"]) && $page == "assets") {
    header("Content-Type: image/png");
    echo file_get_contents("assets/" + $_GET["element"]);
} else if (in_array($page.".php", $allPages)) {
    try {
        include_once("controllers/".$page.".php");
        $objectResponse = controller();

        if(isset($objectResponse)) {
            echo json_encode($objectResponse);
        } else {
            http_response_code(202);
        }
    } catch (BadRequestException $err) {
        http_response_code($err->getStatus());
        echo json_encode(array(
            "error" => $err->getMessage()
        ));
    } catch (AuthException $err) {
        http_response_code($err->getStatus());
        echo json_encode(array(
            "error" => $err->getMessage()
        ));
    } catch (NotFoundException $err) {
        http_response_code($err->getStatus());
        echo json_encode(array(
            "error" => "not found"
        ));
    } catch (Exception $err) {
        http_response_code(500);
        echo json_encode(array(
            "error" => "internal server error"
        ));
    }
} else {
    http_response_code(404);
    echo json_encode(array(
        "error" => 404
    ));
}