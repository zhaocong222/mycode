<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 16-9-29
 * Time: 上午9:24
 */
namespace simpleParse\template;

use simpleParse\template\data as Data;
use simpleParse\template\file as File;
use simpleParse\template\func as Func;

class template
{
    private $data;
    private $file;
    private $func;
    private $name;

    const ext = '.php';

    public function __construct(Data $data,File $file,Func $func)
    {
        $this->data = $data;
        $this->file = $file;
        $this->func = $func;
    }


    public function setName($name)
    {
        $this->name = $name;
    }


    protected function data($data)
    {
        return array_merge($this->data->data,$data);
    }

    public function parse($data)
    {
        try{

            //合并data
            extract($this->data($data));

            ob_start();

            if ($file = $this->getTempalte()) {
                include $file;
            }

            $content = ob_get_clean();

            return $content;

        }catch (\LogicException $e)
        {
            if (ob_get_length() > 0) {
                ob_end_clean();
            }

            throw $e;
        }
    }

    protected function getTempalte()
    {
        return $this->file->getFile().DIRECTORY_SEPARATOR.$this->name.self::ext;
    }

    public function e($str)
    {
        return htmlspecialchars($str,ENT_QUOTES);
    }

    public function batch($str,$func)
    {
        foreach (explode('|',$func) as $val){

            if (isset($this->func[$val])){
                $str = call_user_func($this->func[$val],$str);
            } else if(is_callable($val)){
                $str = call_user_func($val,$str);
            } else {
                throw new \LogicException(
                    'The batch function could not find the "' . $val . '" function.'
                );
            }
        }

        return $str;
    }


}