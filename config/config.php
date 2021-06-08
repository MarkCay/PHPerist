<?php
defined("BASE_PATH") OR exit('No direct script access allowed');
class Config {
  const DATABASE = "DB_NAME_HERE";
  const HOSTNAME = "localhost";
  const USERNAME = "USERNAME_HERE";
  const PASSWORD = "PASSWORD_HERE";
  const DEFAULT_TEMPLATE = "default";
  const APP_NAME = "PHPerist";
  const APP_PATH = "app";
}

$routes = [];
/**
 * Always start your route key with a "/".
 * 
 * Always end your route key with a ".php"
 * 
 * You can always set a route key of whatever the $path_info's final value will be on config/routes.php
 * 
 * $routes[$key]['title'] will set the HTML document title
 * 
 * $routes[$key]['file'] will load the file if the given path exists in the app path folder
 * 
 * $routes[$key]['content'] will set the HTML content of your template
 * 
 * if $routes[$key]['file'] doesn't exist, PHPerist will look for the content.
 */
$routes['/index.php'] = ['title' => 'Home | PHPerist', 'content' => 'Hello, PHPerist!'];
