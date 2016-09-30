<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 16-9-30
 * Time: 上午8:43
 */
namespace simpleParse\extension;

use simpleParse\template\extInterface;
use simpleParse\parse;

class letters implements \simpleParse\template\extInterface
{
    public function register(parse $parse)
    {
        $parse->registerFunction('upper',[$this,'toStringUpper']);
        $parse->registerFunction('lower',[$this,'toStringLower']);
    }

    public function toStringUpper($str)
    {
        return strtoupper($str);
    }

    public function toStringLower($str)
    {
        return strtolower($str);
    }


}

