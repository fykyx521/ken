<?php
/**
 * Created by PhpStorm.
 * User: fanyk
 * Date: 2017/4/10
 * Time: 17:42
 */

namespace Ken;


use Interop\Http\ServerMiddleware\DelegateInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class KenDelegate implements DelegateInterface
{

    protected $response;
    protected $next;
    public function __construct($response,$next)
    {
        $this->response=$response;
        $this->next=$next;
    }
    /**
     * Dispatch the next available middleware and return the response.
     *
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request)
    {
        return call_user_func($this->next,$request,$this->response);// $this->next($request,$this->response);
    }
}