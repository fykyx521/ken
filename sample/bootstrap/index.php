<?php


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

include '../../vendor/autoload.php';

$app=new \Ken\App();
$debugservice=new \Ken\Debug\DebugServiceProvider();
//$debugservice->setContainer($app->getContainer());
$app->addServiceProvider($debugservice);

$app->get('/',function(ServerRequestInterface  $request,ResponseInterface $response,$var){
    $response->getBody()->write('<html><head></head><body>1232323</body></html>');

    $response->withStatus(200);
//    $response->withHeader('')

//    throw new Exception('exits');
    $response->withHeader('Content-Type','text/html');
    return $response;
});
return $app;