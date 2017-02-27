<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

//return [
//    '__pattern__' => [
//        'name' => '\w+',
//    ],
//    '[hello]'     => [
//        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//        ':name' => ['index/hello', ['method' => 'post']],
//    ],

//];
use think\Route;
//通用功能
Route::rule('mapper','service/Mapper/getMapper');
//管理后台相关
Route::rule('admin/index','admin/Index/index');
Route::rule('admin/login','admin/Index/login');
Route::rule('admin/doLogin','admin/Index/doLogin');
Route::rule('admin/userList','admin/User/userList');
Route::rule('admin/groupList','admin/User/groupList');
Route::rule('admin/powerList','admin/User/powerList');
Route::rule('admin/roleList','admin/User/roleList');
Route::rule('admin/resourceList','admin/User/resourceList');
// 注册路由到index模块的News控制器的read操作
Route::rule('login','user/User/login');
Route::rule('register','user/User/register');
Route::rule('getTempApiKey','user/User/getTempApiKey');
Route::rule('user/:uid','user/User/getUser');
Route::rule('group/:group_id','user/Group/getGroup');
Route::rule('group/create','user/Group/createGroup');
Route::rule('role/list','user/Role/getRoleList');