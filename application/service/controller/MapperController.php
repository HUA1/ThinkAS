<?php
/**
 * Created by PhpStorm.
 * User: leiqiu
 * Date: 17/2/22
 * Time: 下午11:27
 */
namespace app\service\controller;

use app\common\controller\AsController;
use app\service\model\Mapper;

class MapperController extends AsController
{
    public function getMapper(){
        $mapperData = request()->param();
        $mapper = new Mapper();
        $mapperJson = $mapper->getMapper($mapperData);
        return json($mapperJson);
    }
}