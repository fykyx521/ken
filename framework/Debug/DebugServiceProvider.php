<?php
/**
 * Created by PhpStorm.
 * User: fanyk
 * Date: 2017/4/10
 * Time: 14:57
 */

namespace Ken\Debug;


use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class DebugServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{

    /**
     * Use the register method to register items with the container via the
     * protected $this->container property or the `getContainer` method
     * from the ContainerAwareTrait.
     *
     * @return void
     */
    public function register()
    {
//        $middleware = [new ExampleClass, 'exampleMiddleware'];
//        dd('register');
    }

    /**
     * Method will be invoked on registration of a service provider implementing
     * this interface. Provides ability for eager loading of Service Providers.
     *
     * @return void
     */
    public function boot()
    {

        $route=$this->container->get('route');

//        $callable=array($debug);
//        var_dump(is_callable($debug));
//        exit;
        $route->middleware(function(ServerRequestInterface  $request,ResponseInterface $response,$next){
            $debug=new Debugbar();
            $response=$debug->handler($request,$response,$next);

            return $response;
//            return $next($request,$response);
        });
    }
}