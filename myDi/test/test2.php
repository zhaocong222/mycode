<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 16-9-23
 * Time: 下午3:37
 */
require '../Loader.php';

use myDi\LemonDi as Di;

//测试２，利用接口

interface Race{}

class humen implements Race
{
    public $name = '人族';
}

class fairy implements Race
{
    public $name = '精灵';
}

class Play{}

class test
{
    private $race = null;
    private $play = 1;

    public function __construct($play = 3,Race $my_race)
    {
        $this->play = $play;
        $this->race = $my_race;
    }

    //获取种族
    public function get_type()
    {
        return sprintf("选择的种族是%s,目前玩家%d人",$this->race->name,$this->play);
    }


    public function __toString()
    {
        return __METHOD__.PHP_EOL;
    }
}

$Di = new Di();
$Di->define('test',['my_race'=>'humen']);
$test = $Di->make('test',['play'=>10]);
echo $test->get_type();
