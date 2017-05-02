<?php 
namespace Ken;


use League\Container\Container;

use League\Container\ContainerAwareInterface;
use League\Container\ContainerAwareTrait;
use League\Container\ContainerInterface;
use League\Route\Middleware\StackAwareInterface;
use League\Route\Middleware\StackAwareTrait;
use League\Route\RouteCollection;
use League\Route\RouteCollectionInterface;
use League\Route\RouteCollectionMapTrait;
use League\Route\Strategy\StrategyAwareInterface;
use League\Route\Strategy\StrategyAwareTrait;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Zend\Diactoros\Response;

class App implements RouteCollectionInterface,StrategyAwareInterface,ContainerAwareInterface,StackAwareInterface
//    MiddlewareAwareInterface,
//    RouteCollectionInterface,
//    StrategyAwareInterface
    {
    use ContainerAwareTrait;
    use StackAwareTrait;
    use RouteCollectionMapTrait;
    use StrategyAwareTrait;
    /** @var ContainerInterface $container */
//	protected $container;
	/** @var RouteCollection $route*/
	protected $route;

	private static $app=null;

	private $basepath='/';

	public function __construct($basthpath="/")
	{
	    $this->basepath=$basthpath;
		$this->init();
	}

	protected function init()
	{
		$this->container = new Container;
		$this->container->share('response', Response::class);
		$this->container->share('request', function () {
			return \Zend\Diactoros\ServerRequestFactory::fromGlobals(
				$_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
				);
		});
		$this->container->share('emitter', \Zend\Diactoros\Response\SapiEmitter::class);
		$this->route = new \League\Route\RouteCollection($this->container);
		$this->container->share('route',$this->route);
		self::$app=$this;
	}

	public static function getApp()
    {
        return self::$app;
    }



	public function run()
	{
		$response = $this->route->dispatch($this->container->get('request'), $this->container->get('response'));
		$this->container->get('emitter')->emit($response);
	}

    /**
     * Add a service provider to the container.
     *
     * @param  string|\League\Container\ServiceProvider\ServiceProviderInterface $provider
     * @return void
     */
    public function addServiceProvider($provider){
        $this->container->addServiceProvider($provider);
    }

    /**
     * Add a route to the map.
     *
     * @param array|string    $method
     * @param string          $path
     * @param string|callable $handler
     *
     * @return \League\Route\Route
     */
     public function map($method, $path, $handler){
         return $this->route->map($method,$path,$handler);
     }

    /**
     *   分组
     * @param $path
     * @param $callable
     * @return \League\Route\RouteGroup
     */
     public function group($path,$callable)
     {
         return $this->route->group($path,$callable);
     }



    public function publicpath()
    {
        return $this->basepath.'/publicpath/';
    }


     public function resourcepath()
     {
         return $this->basepath.'/resources/';
     }



}
