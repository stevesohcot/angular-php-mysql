<?php
class Database{
	private $host;
	private $username;
	private $password;
	private $database;

	private $conn;

	public function __construct($host, $username, $password, $database){
		$this->host = $host;
		$this->username = $username;
		$this->password = $password;
		$this->database = $database;

		$this->connect();
	}
	public function connect(){
		try{
			$this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->database, $this->username, $this->password);
		} catch(PDOException $e){
			die("Error!: " . $e->getMessage() . "<br/>");
		}
	}
	public function execute($query, $params=null){
		$statement = $this->conn->prepare($query);
		$statement->execute($params);
		return $this->conn->lastInsertId();
	}
	public function getRecordSet($query, $params=null){
		$statement = $this->conn->prepare($query);
		$statement->execute($params);
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}
	public function getFirst($query, $params=null){
		$res = $this->getRecordSet($query, $params);

		if(count($res) > 0){
			return $res[0];
		} else{
			return null;
		}
	}
	public function getJson($qry, $params=null){
		$result = $this->getRecordSet($qry, $params);
		return json_encode($result);
	}
	public function getFirstJson($qry, $params=null){
		$result = $this->getFirst($qry, $params);

		if(is_null($result)){
			return '{}';
		} else{
			return json_encode($result);
		}
	}
	public function exists($q, $params=null){
		$res = $this->getFirst($q, $params);

		if(!is_null($res)){
			return true;
		} else{
			return false;
		}
	}
	public function getValue($column, $q, $params=null){
		$result = $this->getFirst($q, $params);

		if(!is_null($result)){
			return $result[$column];
		} else{
			return null;
		}
	}
}
?>