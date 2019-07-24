<?php
$host = "localhost";
$user = "root";
$password = "root";
$database = "taskmanager";

/*
if($_SERVER['HTTP_HOST'] !== 'localhost') {
	require "/home/steveb9e/outside/outside-food.php";
}
*/
$config = [
	'host' => $host,
	'database' => $database,
	'username' => $user,
	'password' => $password,
];


$conn = new Database($config['host'], $config['username'], $config['password'], $config['database']);
?>