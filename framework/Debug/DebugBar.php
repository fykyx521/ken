<?php
/**
 * Created by PhpStorm.
 * User: fanyk
 * Date: 2017/4/10
 * Time: 15:58
 */

namespace Ken\Debug;


use Ken\KenDelegate;
use Middlewares\Utils\Delegate;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class DebugBar
{
    protected $debug;

    public function __construct()
    {
        $this->debug=new \Middlewares\Debugbar();
    }

    public function handler(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {

        return $this->debug->process($request,new KenDelegate($response,$next));

    }

}