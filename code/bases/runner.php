<?php
require_once "app/middleware.php";
require_once "app/functionality.php";
/**
 * Singleton
 */
class Runner {

    private static $instance = NULL;
    private static $middleware_list = [];
    private static $RouteVar = [];
    private static $last_function = NULL;

    private function __construct() { 
    }

    static function getInstance() {
        if (self::$instance == NULL) {
        self::$instance = new Runner;
        } 
        return self::$instance;
    }

    public function addMidleware($new_middleware){
        self::$middleware_list = array_merge(self::$middleware_list ,$new_middleware);
        return true;
    }

    public function addRouteVar($key, $val){
        self::$RouteVar[$key] = $val;
    }

    public function notFound(){
        echo '404';
        exit();
    }

    public function setFunction($function){
        self::$last_function = $function;
    }

    public function processRequest(){
        foreach(self::$middleware_list as $middleware){
            $middleware(self::$RouteVar);
        }

        $function_name = self::$last_function;
        $function_name(self::$RouteVar);

        exit();
    }
}