<?php 
namespace Ken;


class App {
	
	protected $container;
	protected $route;

	public function __construct()
	{
		$this->init();
	}

	protected function init()
	{
		$this->container = new League\Container\Container;
		$this->container->share('response', Zend\Diactoros\Response::class);
		$this->container->share('request', function () {
			return Zend\Diactoros\ServerRequestFactory::fromGlobals(
				$_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
				);
		});

		$this->container->share('emitter', Zend\Diactoros\Response\SapiEmitter::class);
		$this->route = new League\Route\RouteCollection($container);
	}



	public function run()
	{
		$response = $route->dispatch($container->get('request'), $container->get('response'));
		$this->container->get('emitter')->emit($response);
	}

}
