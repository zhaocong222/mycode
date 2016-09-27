<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 16-9-23
 * Time: 下午3:23
 */
namespace myDi;

interface ServerProiver
{
    public function register($class);
}