<?php
/**
 * Created by PhpStorm.
 * User: legendFox
 * Date: 2016/10/1 0001
 * Time: 下午 9:51
 */

namespace Core;


class Router
{
    public  static function dispatch()
    {
        $request = Request::instance();
        $module = $request->getModule();
        $controller = $request->getController();
        $action = $request->getAction();
        $path = array(
            $module
        );
        $namespace  = implode('\\', $path);
        $class      = APP_PATH.$namespace . '\\' . $controller;
        if(file_exists(VIP_DIR.$class.".php")){
            $controller = new $class();
            $controller->$action();
        }else{
            $request->FOF();
        }

    }
}