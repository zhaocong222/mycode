<?php
namespace easyRouter;

class Route
{
    private $routes = [];
    private $regex = [];
    private $defaultRule = [
        '#\{[\w.-]+\}#'=>'([\w.-]+)'
    ];

    public function __call($method, $args)
    {
        $this->addRoute($method,$args);
        return $this;
    }


    protected function addRoute($method,$args)
    {
        $this->routes[strtoupper($method).':'.$args[0]] = [
            'method'=>$method,
            'uri'=>$args[0],
            'action'=>end($args)
        ];
    }


    public function where(array $regex)
    {
        $uri = end(array_keys(($this->routes)));
        $this->regex[$uri] = $regex;
    }

    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = $method.':'.$this->parseUri();
        $action = null;
        $param = [];

        foreach ($this->routes as $key=>$val) {

            if ($uri == $key){
                //完全匹配
                $action = $val['action'];
                break;
            } else {

                //解析正则
                if ($res = $this->analyUri($key,$uri)){
                    //extract($res,EXTR_OVERWRITE);
                    $param = $res;
                    $action = $val['action'];
                    break;
                }
            }

        }

        call_user_func([$this,'run'],$action,$param);

    }

    protected function analyUri($ruleUri,$uri)
    {
        //获取规则
        $pattern = $this->replaceUri($ruleUri);

        //不是正则
        if ($pattern == $ruleUri)
            return false;

        if (preg_match('#'.$pattern.'#',$uri,$res)){
            unset($res[0]);
            return $res;
        }

    }

    protected function replaceUri($ruleUri)
    {
        //替换正则
        if (isset($this->regex[$ruleUri])){

            reset($this->regex[$ruleUri]);

            $count = count($this->regex[$ruleUri]);
            $posx = 0;
            $last = '';

            foreach ($this->regex[$ruleUri] as $key=>$pattern){


                if ($posx == $count-1)
                    $last = '$';

                $ruleUri = str_replace('{'.$key.'}','('.$pattern."){$last}",$ruleUri);

                $posx++;
            }
        }

        return preg_replace(array_keys($this->defaultRule),array_values($this->defaultRule),$ruleUri);

    }

    protected function run($action,$args = [])
    {
        if (is_null($action)){
            exit('404 not found');
        } elseif (is_object($action) && $action instanceof \Closure){
            call_user_func_array($action,$args);
        } elseif (strpos($action,'@') !== false) {
            //控制器方法
        }

    }

    protected function parseUri()
    {
        if (isset($_SERVER['PATH_INFO']))
            return $_SERVER['PATH_INFO'];

        //访问的更目录
        return '/';
    }
}