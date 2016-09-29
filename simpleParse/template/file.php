<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 16-9-29
 * Time: 上午10:16
 */
namespace simpleParse\template;

/**
 * Class file
 * @package 管理模板文件路径
 */

class file
{
    private $temmplate_dir; //模板路径

    public function __construct($dir)
    {
        $this->temmplate_dir = $dir;
    }

    public function getFile()
    {
        return $this->temmplate_dir;
    }
}