<?php

require_once  dirname(__FILE__) . '/../vos/ResultObjectVO.php';
require_once  dirname(__FILE__) . '/../vos/UserVO.php';
class AuthenticationService{

    function __construct($conn) {
        $this->conn = $conn;
    }

    function authenticate($username,$password) {

        try {

			$arrValues = [
				':username' => $username,
				':password' => $password
			];

            $query = "SELECT * FROM users where username = :username and password = :password";
            $records = $this->conn->getRecordSet($query, $arrValues);
          
            $userCount = sizeof($records);
            $result = new ResultObjectVO();

            if($userCount === 1){
                $result->error = false;
                $row = $records[0];
                $user = new UserVO();
                $user->roleID = (int)$row['roleId'];
                $user->username = $row['userName'];
                $user->userID = (int)$row['userId'];
                $result->resultObject = $user;
            } else {
                $result->error = true;
                $result->resultObject = 'invalid login';
            }
            return $result;
        }
        catch(Exception $e) {
            echo("Error!");
        }
    }
    function hashPassword($password){
        return hash('md5', $password);
    }
}
?>