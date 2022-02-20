<?php

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

    //   addMidleware
    public function addMidleware($new_middleware){
        self::$middleware_list = array_merge(self::$middleware_list ,$new_middleware);
        return true;
    }

    //   addRouteVar
    public function addRouteVar($key, $val){
        self::$RouteVar[$key] = $val;
    }

    //   404
    public function notFound(){
        echo '404';
        exit();
    }

    //   setFunction
    public function setFunction($function){
        self::$last_function = $function;
    }

    //   processRequest
    public function processRequest(){
        echo '<br>middleware<br>';
        var_dump(self::$middleware_list);
        echo '<br>RouteVar<br>';
        var_dump(self::$RouteVar);
        echo '<br>last_function<br>';
        var_dump(self::$last_function);
        exit();
    }
}