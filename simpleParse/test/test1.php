<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 16-9-29
 * Time: 上午10:27
 */
require '../Loader.php';

use simpleParse\parse;

$parse = new parse('./view');

$parse->registerFunction('uppercase',function($str){
    return strtoupper($str);
});


echo $parse->render('index',[
    'title'=>'欧冠-马竞1-0送拜仁赛季首败 卡拉斯科破门怒吼',
    'name'=>'ricazhang',
    'content'=>'出场阵容<script>alert(123);</script>

门兴格拉德巴赫（4-2-3-1）：佐默；科尔布，克里斯蒂安森，埃尔维蒂，文特；达胡德，克拉默；小阿扎尔(80\'赫尔曼)，施廷德尔(83\'哈恩)，特劳雷；拉斐尔(48\'法比安-约翰逊)

巴塞罗那（4-3-3）：特尔施特根；塞尔吉-罗贝托，皮克，马斯切拉诺(数据)，阿尔瓦；布斯克茨，拉基蒂奇(59\'图兰)，伊涅斯塔；帕科-阿尔卡塞尔(54\'拉菲尼亚)，苏亚雷斯，内马尔',
]);
