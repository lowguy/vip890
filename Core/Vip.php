<?php
/**
 * Created by PhpStorm.
 * User: legendFox
 * Date: 2016/10/1 0001
 * Time: 下午 9:41
 */

namespace Core;


class Vip
{
    static private $instance;
    private $ext = ".php";

    private function __construct(){

    }

    /**
     * @return Vip
     */
    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function autoload()
    {
        spl_autoload_register(function ($class){
            $file = $class.$this->ext;
            require_once $file;
        },true);
    }

    public function run()
    {
        $this->autoload();
        Router::dispatch();
    }
}