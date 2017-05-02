<?php
namespace Ken\Database;
/**
 * Created by PhpStorm.
 * User: fanyk
 * Date: 2017/4/10
 * Time: 15:23
 */
class ServiceProvider extends \League\Container\ServiceProvider\AbstractServiceProvider
{

    protected $provides = ['db'];
    /**
     * Use the register method to register items with the container via the
     * protected $this->container property or the `getContainer` method
     * from the ContainerAwareTrait.
     *
     * @return void
     */
    public function register()
    {
         $this->container->share('db',function(){

              return new \Medoo\Medoo($this->getOptions());

         });
        // TODO: Implement register() method.
    }
    protected function getOptions()
    {
        // 初始化配置
        $database = [
            'database_type' => 'mysql',
            'database_name' => getenv('DB_DATABASE'),
            'server' => getenv('DB_HOST'),
            'username' => getenv('DB_USERNAME'),
            'password' => getenv('DB_PASSWORD'),
            'charset' => 'utf8'
        ];
//        dd($database);
        return $database;
    }
}