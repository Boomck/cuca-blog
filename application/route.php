<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;

Route::rule('index','cuca/user/index');
Route::rule('login','cuca/user/login');
Route::rule('register','cuca/user/register');
Route::rule('personal','cuca/user/personal');
Route::rule('insert','cuca/user/insert');
Route::rule('check','cuca/user/check');
Route::rule('destroy','cuca/user/destroy');
Route::rule('insertessay','cuca/user/insertessay');
Route::rule('insertcomment','cuca/user/insertcomment');
Route::rule(['addlikecount','addlikecount/:id'],'cuca/user/addlikecount');
Route::rule('loadsingle/:id','cuca/user/loadsingle');
Route::rule('cuca/user/index','cuca/user/index');
Route::rule('cuca/user/login','cuca/user/login');
Route::rule('cuca/user/register','cuca/user/register');
Route::rule('cuca/user/personal','cuca/user/personal');
Route::rule('cuca/user/insert','cuca/user/insert');
Route::rule('cuca/user/check','cuca/user/check');
/*Route::rule([
		'destroy' => 'cuca/user/destroy',
  		'cuca/user/destroy' => 'cuca/user/destroy',
  		'insertessay'=>'cuca/user/insertessay',
  		'cuca/user/insertessay'=>'cuca/user/insertessay',
  		'insertcomment','cuca/user/insertcomment',
  		'cuca/user/insertcomment','cuca/user/insertcomment'
]);*/

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

];
