<?php
defined("BASE_PATH") OR exit('No direct script access allowed');
$path_info = (isset($_SERVER['PATH_INFO'])) ? $_SERVER['PATH_INFO'] : "";
if ($path_info === '/') {
  $path_info = '/index.php';
}
if (!ends_with($path_info, ".php")) {
  $path_info .= ".php";
}

if ($path_info === ".php") {
  $path_info = "/index.php";
}
$data['title'] = isset($routes[$path_info]) ? $routes[$path_info]['title'] : Config::APP_NAME;
if (isset($routes[$path_info]['file'])){
  $route_file = $routes[$path_info]['file'];
  if ($route_file === '') {
    $route_file = 'index';
  }
  $file_path = Config::APP_PATH . (starts_with($route_file, "/") ? $route_file : "/" . $route_file);
  $file_path_with_index = $file_path . "/index.php";
  $file_path = ends_with($file_path, ".php") ? $file_path : $file_path . ".php";
  ob_start();
  if(file_exists($file_path)) {
    include($file_path);
  } else if(file_exists($file_path_with_index)) {
    include($file_path_with_index);
  } else {
    
    if (isset($routes[$path_info]['content'])) {
      echo $routes[$path_info]['content'];
    } else {
      $error['title']  = 404;
      $error['message'] = 'The page you are looking for cannot be found';
      load_component("error", $error);
    }
  }
  $data['content'] = ob_get_contents();
  ob_end_clean();
} else if (isset($routes[$path_info]['content'])) {
  $data['content'] = $routes[$path_info]['content'];
} else {
  ob_start();
  if(file_exists(Config::APP_PATH . $path_info)) {
    include(Config::APP_PATH . $path_info);
  } else if(isset($_SERVER['HTTP_INFO']) AND file_exists(Config::APP_PATH . $_SERVER['PATH_INFO'] . "/index.php")) {
    include(Config::APP_PATH . $_SERVER['PATH_INFO'] . "/index.php");
  }else {
    $error['title']  = 404;
    $error['message'] = 'The page you are looking for cannot be found';
    load_component("error", $error);
  }
  $data['content'] = ob_get_contents();
  ob_end_clean();
}
include_once("template/default/index.php");