<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 16-9-23
 * Time: 下午4:28
 */
namespace myDi;

interface RegisterInterface
{
    public function set($key,$value);

    public function get($key);
}