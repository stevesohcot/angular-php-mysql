<?php

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

require_once dirname(__FILE__) . '/../../config/jakeDB.php';
require_once dirname(__FILE__) . '/../../config/connection.php';
require_once dirname(__FILE__) . '/../../services/TaskService.php';
require_once dirname(__FILE__) . '/../../vos/TaskFilterVO.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // get the POSTED input
        $data = json_decode(file_get_contents("php://input"));
        $taskService = new TaskService($conn);
        
        $taskFilter = new TaskFilterVO();

        if (isset($_GET["completed"])){
            $taskFilter->completed = $_GET['completed'];
        }

        if (isset($_GET["completed"])){
            $taskFilter->startDate = $_GET['startDate'];
        }

        $result = $taskService->getFilteredTasks($taskFilter);

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