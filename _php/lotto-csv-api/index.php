<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require './vendor/autoload.php';
require './CSVHandler.php';

$configSlim['displayErrorDetails'] = true;
$configSlim['addContentLengthHeader'] = false;

$httpApp = new \Slim\App(['settings' => $configSlim]);
$CSVHandler = new CSVHandler;

$httpApp->post('/writeToCSV/', function (Request $request, Response $response, array $args) {
  $requestData = $request->getParsedBody();
  $CSVHandler = new CSVHandler; 
  $result = $CSVHandler->writeToCSV($requestData);

//   $response->getBody()->write();

  $response = $response->withHeader('Access-Control-Allow-Origin', '*');
  $response = $response->withHeader('Access-Control-Allow-Methods', 'POST');
  return $response;

});


$httpApp->run();