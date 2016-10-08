<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 16-10-8
 * Time: 下午12:52
 */
namespace easyRouter\Facde;

class Router extends Facde
{
    public static function getFacadeAccessor()
    {
        return 'route';
    }
}