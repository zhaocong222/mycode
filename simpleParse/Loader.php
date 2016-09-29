<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 16-9-23
 * Time: 下午3:32
 */
namespace simpleParse;

if (!defined('BASE_PATH')){
    define('BASE_PATH',dirname(__DIR__).DIRECTORY_SEPARATOR);
    Loader::Register();
}


class Loader
{
    public static function Register()
    {
        return spl_autoload_register([new self,'loadClass']);
    }


    public function loadClass($class)
    {
        $class = ltrim($class,'\\/');

        if (strpos($class,__NAMESPACE__) === 0){
            $classPath = str_replace('\\','/',BASE_PATH.$class).'.php';
        } else{
            $classPath = str_replace('\\','/',BASE_PATH.__NAMESPACE__.DIRECTORY_SEPARATOR.$class).'.php';
        }

        if (!is_file($classPath) || !is_readable($classPath) )
            return false;

        require($classPath);

    }
}
