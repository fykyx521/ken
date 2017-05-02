<?php


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

include '../../vendor/autoload.php';

try{
    $env=new \Dotenv\Dotenv('../');
    $env->load();
}catch (Exception $e)
{

}
$app=new \Ken\App(realpath(__DIR__.'/../'));

//$debugservice=new \Ken\Debug\DebugServiceProvider();
//$debugservice->setContainer($app->getContainer());
$view=new \Ken\View\PlatesServiceProvider();
$app->addServiceProvider($view);
$app->addServiceProvider(new \Ken\Database\ServiceProvider());
//$run     = new \Whoops\Run;
//$run->register();

$app->get('/',function(ServerRequestInterface  $request,ResponseInterface $response,$var){
    $response->getBody()->write('<html><head></head><body>1232323</body></html>');

    $response->withStatus(200);
//    $response->withHeader('')

//    throw new Exception('exits');
    $response->withHeader('Content-Type','text/html');
    return $response;
});


$app->group('/wechat',function($route){
    $route->get('/menu/index',"App\Wechat\MenuController::index");

});







return $app;