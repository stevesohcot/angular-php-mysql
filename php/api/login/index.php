<?php

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

require_once dirname(__FILE__) . '/../../config/jakeDB.php';
require_once dirname(__FILE__) . '/../../config/connection.php';
require_once dirname(__FILE__) . '/../../services/AuthenticationService.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        // get the POSTED input
        $data = json_decode(file_get_contents("php://input"));
        $authenticationService = new AuthenticationService($conn);
        $result = $authenticationService->authenticate($data->username,$data->password);       

        echo(json_encode($result) );
        break;
    default:
        $r = new ResultObjectVO();
        $r->error = true;
        $r->resultObject = "Unknown Request Type";
        echo(json_encode($r) );
        break;
}
?>