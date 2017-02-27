<?php
/**
 * Created by PhpStorm.
 * User: leiqiu
 * Date: 17/2/21
 * Time: 下午3:24
 */
namespace app\admin\controller;
use app\common\controller\AsController;
use app\user\model\Group;
use app\user\model\User;

class UserController extends AsController {
    public function userList(){
        $pageName = '所有用户';
        $groupName = '用户管理';
        $user = new User();
        $userList = $user->getUserList();
        return json($userList,200);
    }
    public function groupList(){
        $pageName = '用户组';
        $groupName = '用户管理';
        $group = new Group();
        $groupList = $group->getGroupList();
        return json($groupList,200);
    }
}