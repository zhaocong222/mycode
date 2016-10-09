<?php
require '../Loader.php';

use \easyRouter\Facde\Router;

Router::get('/',function(){
    echo 'hello world';
});

Router::get('/get/name',function(){
    echo 'my name is lemon';
});

Router::get('/user/{id}',function($id){
    echo 'my id is '.$id;
});

/*
Router::get('/user/{id}/{name}',function($id,$name){
    echo '我的工号是'.$id,',我的名字叫'.$name;
});
*/

Router::get('/user/{id}/{name}',function($id,$name){
    echo '我的工号是'.$id,',我的名字叫'.$name;
})->where([
    'id'=>'\d+',
    'name'=>'[a-zA-Z]+'
]);



Router::dispatch();