<?php

require_once dirname(__FILE__) . '/../config/jakeDB.php';
require_once dirname(__FILE__) . '/../config/connection.php';
require_once dirname(__FILE__) . '/../services/AuthenticationService.php';

$authenticationService = new AuthenticationService($conn);

echo('<h1>Test Authentication Success</h1>');

$result = $authenticationService->authenticate('steve','steve');
echo(json_encode($result) );

print "<hr>";

echo('<h1>Test Authentication Failure</h1>');
$result = $authenticationService->authenticate('measdf','masdfasdfe');
echo(json_encode($result) );

?>