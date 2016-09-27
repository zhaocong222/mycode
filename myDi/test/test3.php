<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 16-9-23
 * Time: 下午3:37
 */
require '../Loader.php';

use myDi\LemonDi as Di;

//测试２，利用接口
class People
{
    public function init()
    {
        echo __METHOD__;
    }
}


class test implements \myDi\ServerProiver
{
    public function register(Di $di)
    {
        $di['person'] = new People();
    }

}

$Di = new Di();
$Di->register(new test());
$Di->make('person')->init();

