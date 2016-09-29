<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 16-9-29
 * Time: 上午10:16
 */
namespace simpleParse\template;

/**
 * Class func
 * @package 管理模板函数
 */
class func implements \ArrayAccess
{
    private $funcs;

    public function offsetSet($offset, $value)
    {
        if (is_callable($value) && ($value instanceof \Closure))
            $this->funcs[$offset] = $value;
    }

    public function offsetExists($offset)
    {
        return isset($this->funcs[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->funcs[$offset];
    }

    public function offsetUnset($offset)
    {
        unset($this->funcs[$offset]);
    }

}