<?php

require_once "bases/router.php";
require_once "bases/runner.php";

//parse request
$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);
$request=explode('/', $uri);

unset($request[0]);
if(end($request) == ''){
    unset($request[count($request)]);
}

$route_depth_num = 0;

//consider root as first step
$step = Router::getInstance()->getRoot();

while(true){
    // add middlewares of step to the runner queue
    Runner::getInstance()->addMidleware($step->middleware);

    // is there any other step?
    if(isset( $request[$route_depth_num + 1] )){

        $route_depth_num = $route_depth_num + 1;
        $step = Router::getInstance()->checkChildren($step, $request[$route_depth_num]);
        if(!$step){
            Runner::getInstance()->notFound();
        }
        elseif($step->type == 'var'){
            Runner::getInstance()->addRouteVar($step->name, $request[$route_depth_num]);
        } 
    }

    // process request if there is no step anymore
    else{
        if($step->function != NULL){
            Runner::getInstance()->setFunction($step->function);
            Runner::getInstance()->processRequest();
        }
        else{
            Runner::getInstance()->notFound();
        }
    }
}

