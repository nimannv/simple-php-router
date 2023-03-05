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

    foreach($current_step->children as $child){
      if($next_path_name == $child->name && $child->type == 'const'){
        return $child;
      }
      elseif($child->type == 'var'){
        $var_step = $child;
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