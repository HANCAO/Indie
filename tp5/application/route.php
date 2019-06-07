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

/* return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

]; */

use think\Route;  //引入系统路由类

//设置路由之后，就不能使用pathinfo访问了
//第一个参数为路由名，第二个参数为路径[模块/控制器/方法名]
Route::rule('/','index/Index/index');
Route::rule('diaoyonng','index/Index/diaoyonng');
Route::rule('diaoyongadmin','index/Index/diaoyongadmin');
Route::rule('test','index/Index/test');
Route::rule('fangfa','index/Index/fangfa');
Route::rule('fangfaother','index/Index/fangfaother');
Route::rule('fangfaanother','index/Index/fangfaanother');

#下面一条最重要了不要删掉
#Route::rule('normal','index/Index/normal');




//带参数的路由，即动态路由
Route::rule('course/:id','index/Index/course');
//加上 [] 表示可选
Route::rule('time/:year/[:month]','index/Index/time');

//添加资源路由
Route::resource('users','index/Users');
Route::resource('songs','index/Songs');
Route::resource('styles','index/Styles');
Route::resource('normal','index/Normals');


