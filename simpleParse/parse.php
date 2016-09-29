<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 16-9-29
 * Time: 上午9:15
 */
namespace simpleParse;

use simpleParse\template\data;
use simpleParse\template\file;
use simpleParse\template\template;
use simpleParse\template\func;

class parse
{
    private $template;
    private $data;
    private $func;

    public function __construct($dir)
    {
        $this->data = new data();
        $this->func = new func();
        $this->template = new template($this->data,new file($dir),$this->func);
    }

    public function registerFunction($name,$callback)
    {
        if (!(is_callable($callback) && $callback instanceof \Closure))
            throw new \Exception('$callback must be a function');

        $this->func[$name] = $callback;

    }

    public function make($name)
    {
        $this->template->setName($name);
        return $this->template;
    }

    public function render($name,$data = [])
    {
        return $this->make($name)->parse($data);
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

}