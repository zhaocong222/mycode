<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 16-9-29
 * Time: 上午10:27
 */
require '../Loader.php';

use simpleParse\parse;
use simpleParse\extension as ext;

$parse = new parse('./view');

(new ext\letters())->register($parse);


echo $parse->render('index2',[
    'title'=>'欧冠-马竞1-0送拜仁赛季首败 卡拉斯科破门怒吼',
    'name'=>'ricazhang',
    'content'=>'Oceans apart, day after day']);
