<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 16-9-23
 * Time: 下午4:26
 */
namespace myDi;

class Register implements RegisterInterface
{
    public $cache = [];
    
    public function set($key, $value)
    {
        $this->cache[$key] = $value;
    }

    public function get($key)
    {
        if (isset($this->cache[$key]))
            return $this->cache[$key];

        return false;
    }

    public function del($key)
    {
        unset($this->cache[$key]);
        return true;
    }
}