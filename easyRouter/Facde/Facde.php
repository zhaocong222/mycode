<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 16-10-8
 * Time: 下午12:52
 */
namespace easyRouter\Facde;

abstract class Facde
{

    private static $cache = [];

    abstract static function getFacadeAccessor();

    private static function getFacadeRoot()
    {
        return self::resolveFacadeInstance(ucwords(static::getFacadeAccessor()));
    }

    private static function resolveFacadeInstance($class)
    {

        $class = self::getAllClassName($class);

        if (!isset(self::$cache[$class])){
            self::$cache[$class] = new $class;
        }

        return self::$cache[$class];

    }

    private static function getAllClassName($class)
    {
        return '\easyRouter\\'.$class;
    }


    public static function __callStatic($method,$args)
    {
        $instance = static::getFacadeRoot();

        if (is_null($instance))
            throw new \Exception(' is error');

        return call_user_func_array([$instance,$method],$args);

    }
}