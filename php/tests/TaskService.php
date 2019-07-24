<?php

require_once dirname(__FILE__) . '/../config/jakeDB.php';
require_once dirname(__FILE__) . '/../config/connection.php';
require_once dirname(__FILE__) . '/../services/TaskService.php';

require_once dirname(__FILE__) . '/../vos/TaskFilterVO.php';


$taskService = new TaskService($conn);

echo('<h1>Get NOT Completed Tasks</h1>');
$taskFilter = new TaskFilterVO();
$taskFilter->completed = 0;

$result = $taskService->getFilteredTasks($taskFilter);
echo(json_encode($result) );

print "<hr>";
echo('<h1>Get Tasks AFTER 7/20/2019</h1>');
$taskFilter = new TaskFilterVO();
$taskFilter->startDate = '2019-07-20';

$result = $taskService->getFilteredTasks($taskFilter);
echo(json_encode($result) );


?>