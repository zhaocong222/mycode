<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 16-9-23
 * Time: 下午3:37
 */
require '../Loader.php';

use myDi\LemonDi as Di;

class A
{
    private $name,$age,$sex;

    const SEX = 'man';


    public function __construct($name='age',$age = 18,$sex = self::SEX)
    {
        $this->name = $name;
        $this->age = $age;
        $this->sex = $sex;
    }

    public function xx()
    {
        echo __METHOD__;
    }

    public function getinfo()
    {
        return sprintf('my name is %s, my age is %d',$this->name,$this->age);
    }
}

$Di = new Di();
$Di['name'] = '石苦菊';

$Di['A'] = function($c){
    return new A($c['name']);
};

$A = $Di->make('A');
print $A->getinfo();
exit();

//取出上次实例化的
$A1 = $Di->make('A');
var_dump($A1 instanceof A); //true
$A2 = $Di->make('A');
var_dump($A1 === $A2); //false
$A3 = $Di->single('A');
var_dump($A2 === $A3); //true


