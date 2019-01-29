<?php
require_once("./repositories/MenuRepository.php");
require_once("./services/LoginService.php");

function controller() {
    switch ($_SERVER["REQUEST_METHOD"]) {
        case "POST":
            $fileName = md5(rand(10, 1000000)).".png";
            $assetFile = fopen("assets/".$fileName, "w");

            if ($_FILES["file"]["type"] != "image/png") {
                throw new BadRequestException("Invalid format");
            }

            fwrite($assetFile, file_get_contents($_FILES['file']['tmp_name']));
            fclose($assetFile);
            return array(
                "fileName" => $fileName
            );
        default:
            throw new NotFoundException();
    }
}