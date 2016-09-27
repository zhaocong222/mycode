<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 16-9-23
 * Time: 下午2:51
 */
namespace myDi;

class LemonDi extends Reflect implements \ArrayAccess,ServerProiver
{
    //注册树
    protected $register;
    protected $app = [];
    //依赖关系
    protected static $define = [];

    public function __construct()
    {
        $this->register = new Register();
    }

    public function make($class,$args = [],$flag = false)
    {
        $container = null;
        if (isset($this[$class]))
            $container = $this[$class];
        
        if ($flag && $obj = $this->register->get($class)){
            return $obj;
        }

        if ($this->isBuild($container)){
            $obj = call_user_func($container,$this);
        } else {
            $obj = $this->build($class,$args);
        }

        //放入数组
        $this->register->set($class,$obj);
        
        return $obj;
    }

    public function single($class,$args = [])
    {
        return $this->make($class,$args = [],true);
    }

    protected function isBuild($container)
    {
        return !empty($container) && $container instanceof \Closure;
    }


    public function offsetGet($offset)
    {
        if (isset($this->app[$offset]))
            return $this->app[$offset];

        return false;
    }

    public function offsetSet($offset, $value)
    {
        $this->app[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        if (isset($this->app[$offset]))
            unset($this->app[$offset]);
    }

    public function offsetExists($offset)
    {
        if (isset($this->app[$offset]))
            return true;

        return false;
    }

    /*
     * 注册接口
     */
    public function register($class)
    {

    }

    public function strtolower($class)
    {
        return ltrim(strtolower($class),'\\');
    }

    /*
     * 依赖关系
     */
    public function define($class,$define)
    {
        if (empty($define))
            throw new \Exception('define must has Parameter');

        //注入依赖关系
        self::$define[$class] = $define;
    }

}