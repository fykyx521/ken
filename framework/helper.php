<?php

use Ken\App;

if(!function_exists('dd'))
{
    function dd($args)
    {
        dump($args);
        exit;
    }
}

if(!function_exists("app"))
{
    function app($alias=null)
    {
        if($alias)
        {
            return App::getApp()->getContainer()->get($alias);
        }
        return App::getApp();
    }
}