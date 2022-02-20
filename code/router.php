<?php
$route = [];
$route_depth = 0;
// 1: consider root as step
$Step = $router->getroot();

while(true){

    // 2: add step conditions and functions
    $runner->addMidleware($step->getMiddleware())

    // 3: is there any other route?
    if(isset( $route[$route_depth + 1] )){
        $route_depth = $route_depth + 1;

        // yes: 4: get children of step
        $step = $router->checkChildren($step, $route[$route_depth])
        // 5: is route member of children?
        // no: 6: is var in children?
        // yes: 7: add value to val array
        // 8: consider val as step and go to 2
        // yes: 6: consider child as step and go to 2
        if($step->isvar()){
            $runner->addRouteVar($step->getname(), $route[$route_depth]);
        } 
        // no: 404
        if(!$step){
            $runner->404();
        }

    }
    // no: 4: is step endable?
    else{
        // yes: 5 run...
        if($step->endable()){
            $runner->addFunction($step->getFunction())
            $runner->processRequest();
        }
        // no: 5: 404
        else{
            $runner->404();
        }
    }
}
