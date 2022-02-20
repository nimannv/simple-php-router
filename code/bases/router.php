<?php

/**
 * Singleton
 */
class Router {

  private static $instance = NULL;
  private static $routers;
  private static $json_file_address = 'router.json';
    

  private function __construct() {
    self::$routers = json_decode(file_get_contents(self::$json_file_address));
  }

  static function getInstance() {

    if (self::$instance == NULL) {
      self::$instance = new Router;
    } 
    return self::$instance;
  }

  public function getRoot(){

    return self::$routers[0];
  }

  public function checkChildren($current_step, $next_path_name){

    $child_list = array();
    $var_step = NULL;

    foreach(self::$routers as $route){

      if($route->parrent == $current_step->id){

        if($next_path_name == $route->name && $route->type == 'const'){
          return $route;
        }
        elseif($route->type == 'var'){
          $var_step = $route;
        }
      }
    }
    
    //if var child found
    if($var_step != NULL){
      return $var_step;
    }

    return false;
  }
}

?>