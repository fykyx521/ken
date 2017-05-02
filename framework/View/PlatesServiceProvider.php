<?php

namespace Ken\View;
use Ken\App;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

/**
 * Created by PhpStorm.
 * User: fanyk
 * Date: 2017/5/2
 * Time: 15:08
 */
class PlatesServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{

    /**
     * Method will be invoked on registration of a service provider implementing
     * this interface. Provides ability for eager loading of Service Providers.
     *
     * @return void
     */
    public function boot()
    {
        // TODO: Implement boot() method.
    }

    /**
     * Use the register method to register items with the container via the
     * protected $this->container property or the `getContainer` method
     * from the ContainerAwareTrait.
     *
     * @return void
     */
    public function register()
    {
        // TODO: Implement register() method.
        $this->getContainer()->share('view',function(){
             return  new \League\Plates\Engine($this->getPlatesPath());
        });
    }

    protected function getPlatesPath()
    {
        return app()->resourcepath().'view/';
    }
}