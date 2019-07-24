<?php
require_once  dirname(__FILE__) . '/../vos/ResultObjectVO.php';
require_once  dirname(__FILE__) . '/../vos/TaskFilterVO.php';
require_once  dirname(__FILE__) . '/../vos/TaskVO.php';

class TaskService {

	private $conn;

	function __construct($conn) {
		$this->conn = $conn;
	}

	function getFilteredTasks(TaskFilterVO $filter) {

		try {

			$arrValues = [
				':completed' => $filter->completed,
				':startDate' => $filter->startDate
			];

			$query = "select tasks.*, taskCategories.taskCategory 
					from tasks 
					join taskCategories on 
						(tasks.taskCategoryID = taskCategories.taskCategoryID)";

			$query .= " where 0=0 ";

			if(isset($filter->completed)){
				$query .= "and completed = :completed ";
			} else {
				unset($arrValues[':completed']);
			}

			if(isset($filter->startDate)){
				$query .= " and dateCreated >= :startDate ";
			} else {
				unset($arrValues[':startDate']);				
			}

			$query .= " order by dateCreated ";

			$records = $this->conn->getRecordSet($query, $arrValues);
			

			$result = new ResultObjectVO();
            $result->error = false;
            $result->resultObject = [];
            foreach ($records as $row) {
                $task = new TaskVO();
                $task->taskID = (int)$row['taskID'];
                $task->taskCategoryID = (int)$row['taskCategoryId'];
                $task->taskCategory = $row['taskCategory'];
                $task->userID = (int)$row['userId'];
                $task->description = $row['description'];
                if($row['completed'] == true){
                    $task->completed = 1;
                } else {
                    $task->completed = 0;
                }
                $dateCreated = new DateTime();
                $dateCreated->setTimestamp(strtotime($row['dateCreated']));
                $task->dateCreated = date_format($dateCreated,"m/d/Y");
                if($row['dateCompleted']){
                    $dateCompleted = new DateTime();
                    $dateCompleted->setTimestamp(strtotime($row['dateCompleted']));
                    $task->dateCompleted = date_format($dateCompleted,"m/d/Y") ;
                }
                if($row['dateScheduled']){
                    $dateScheduled = new DateTime();
                    $dateScheduled->setTimestamp(strtotime($row['dateScheduled']));
                    $task->dateScheduled = date_format($dateScheduled,"m/d/Y") ;
                }
                array_push($result->resultObject, $task);
            }

            return $result;



		} catch (Exception $e) {
			$result = new ResultObjectVO();
			$result->error = true;
			return result;
		}
	}

}


?>