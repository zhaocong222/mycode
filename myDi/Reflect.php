<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 16-9-26
 * Time: 下午3:35
 */
namespace myDi;

class Reflect
{
    protected function build($container,$parameter = [],$define = [])
    {

        try{

            $reflect = new \ReflectionClass($container);

            //检查是否能否初始化
            if (!$reflect->IsInstantiable())
                throw new \Exception('class '.$container.'no init');

            $construct = $reflect->getConstructor();

            if (!$construct){
                //没有构造函数
                $obj = $this->initWithOutParameter($container);

            } elseif ($parameters = $this->getParameter($construct)){
                //有构造函数，有参数

                $args = [];

                foreach ($parameters as $param){

                    $name = $param->getName();
                    $args[$name] = $name;

                    //参数有默认值
                    if ($param->isDefaultValueAvailable()){
                        $args[$name] = $param->getDefaultValue();
                    }
                }

                //解析依赖的类(类,接口,普通变量)
                $definition = isset(static::$define[$container]) ?
                                array_replace($args,static::$define[$container])
                                : $define;

                //合并依赖和传的参数
                $definition = array_merge($definition,$parameter);

                //$definition (依赖和参数的合并) ,$parameter('传的参数')
                $args = $this->analysedParameter($parameters,$definition);

                $obj = $reflect->newInstanceArgs($args);

            } else{
                //有构造函数，没参数
                $obj = $this->initWithOutParameter($container);
            }

            return $obj;

        } catch (\LogicException $e){
            die('Not gonna make it in here...');
        } catch (\ReflectionException $e){
            die('Your class does not exist!');
        }

    }

    /*
     * 解析参数
     */
    protected function analysedParameter($parameters,$definition)
    {
        $args = [];

        //提高
        foreach ($parameters as $param){

            $arg = $definition[$param->getName()];

            //判断此参数是类还是其他
            if ($reflectionClass = $param->getClass()){
                //类
                $arg = static::make($arg);
            }

            $args[] = $arg;
        }

        return $args;

    }

    /*
     * 实例
     */
    protected function initWithOutParameter($container)
    {
        return new $container;
    }

    /*
     * 获取参数
     */
    protected function getParameter($construct)
    {
        return $construct->getParameters();

    }
}