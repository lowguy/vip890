<?php
/**
 * Created by PhpStorm.
 * User: legendFox
 * Date: 2016/10/1 0001
 * Time: 下午 10:13
 */

namespace Core;


class Request
{
    private $module = null;
    private $controller = null;
    private $action = null;
    private static $instance = null;

    /**
     * 私有构造子
     */
    private function __construct()
    {
        $uri = substr($_SERVER['REQUEST_URI'], 1);
        $uri = str_replace('?' . $_SERVER['QUERY_STRING'],'' , $uri);
        $uri = explode('/', $uri);
        $this->module       = !empty($uri[1]) ? $uri[1] : "Home";
        $this->controller   = !empty($uri[2]) ? $uri[2] : "Index";
        $this->action       = !empty($uri[3]) ? $uri[3] : "index";
    }

    /**
     * 获取Request单例对象
     * @return Request
     */
    public static function instance()
    {
        if(self::$instance == null){
            self::$instance = new Request();
        }
        return self::$instance;
    }
    /**
     * 获取请求的module
     * @return string
     */
    public function getModule()
    {
        return $this->module;
    }
    /**
     * 获取请求的module
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }
    /**
     * 获取请求的action
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * 返回json数据格式
     * @param $code
     * @param $msg
     * @param $data
     * @return string
     */
    public function jsonReturn($code,$msg,$data)
    {
        if(!is_numeric($code)){
            return "";
        }
        $json = array(
            'code'=>$code,
            'msg'=>$msg,
            'data'=>$data
            );
        exit(json_encode($json));
    }

    /**
     * 返回xml数据格式
     * @param $code
     * @param $msg
     * @param $data
     * @return string
     */
    public function xmlReturn($code,$msg,$data)
    {
        if(!is_numeric($code)){
            return "";
        }
        $json = array(
            'code'=>$code,
            'msg'=>$msg,
            'data'=>$data
        );
    }
    /**
     * 是否为POST请求
     * @return bool
     */
    public function isPost(){
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    /**
     * 是否为GET请求
     * @return bool
     */
    public function isGet(){
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    /**
     * 生成url
     * @param $module, String 模块
     * @param $controller, String 控制器
     * @param $action, String 方法
     * @param $params, Array 参数
     * @return string, URL
     */
    public function makeURL($module='', $controller='', $action='', $params=array())
    {
        $url = '';
        if(!empty($module)){
            $url .= '/' . $module;
        }
        if(!empty($controller)){
            $url .= '/' . $controller;
        }
        if(!empty($action)){
            $url .= '/' . $action;
        }
        if(!empty($params)){
            $url .= '?';
            $temp = array();
            foreach($params as $k => $v){
                $temp[] = $k . '=' . $v;
            }
            $url .= implode('&', $temp);
        }
        return $url;
    }

    /**
     * 404
     */
    public function FOF(){
        header("HTTP/1.0 404 Not Found");
        exit();
    }

}