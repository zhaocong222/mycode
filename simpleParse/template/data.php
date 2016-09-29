<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 16-9-29
 * Time: 上午10:48
 */
namespace simpleParse\template;

class data implements \ArrayAccess
{

    private $data = [];

    public function offsetSet($offset, $value)
    {
        $this->data[$offset] = $value;
    }

    public function offsetGet($offset)
    {
        if (isset($this->data[$offset])){
            return $this->data[$offset];
        }
        return false;
    }

    public function offsetExists($offset){}

    public function offsetUnset($offset)
    {
        throw new \Exception('not do del operate');
    }

    public function __get($name)
    {
        return $this->$name;
    }

}