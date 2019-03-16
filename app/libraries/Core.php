<?php
/*
 * App Core Class
 * Creates URL & loads core controller
 * URL FORMAT - /controller/method/params
 */
class Core {
  protected $currentControlller = 'Pages';
  protected $currentMethod = 'index';
  protected $params = [];

  public function __construct() {
    // http://localhost/fengyumvc/posts/edit/1
    // display: Array ( [0] => posts [1] => edit [2] => 1 )
    // print_r($this->getUrl());

    // $url[0] -> controller
    // $url[1] -> method
    // $url[2] -> params
    $url = $this->getUrl();

    // Look in controllers for first value
    if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
      // if exists, set as controller -> 
      // remember there are more than just one controller
      // we need the right one to be selected
      $this->currentControlller = ucwords($url[0]);

      // Unset 0 Index
      unset($url[0]);
    }

    // Require the controller
    require_once '../app/controllers/' . $this->currentControlller . '.php';

    // Instatntiate controller class
    // for example: Pages = new Pages;
    $this->currentControlller = new $this->currentControlller;

    // Check for the second part of URL
    if(isset($url[1])){
      // check to se if method exists in the controller
      $this->currentMethod = $url[1];

      // Unset 1 Index
      unset($url[1]);
    }

    // Get params
    $this->params = $url ? array_values($url) : [];

    // Call a callback with array of params
    call_user_func_array([$this->currentControlller, $this->currentMethod], $this->params);
  }

  public function getUrl() {
    // http://localhost/fengyumvc/blue -> you get 'blue' on the screen
    // this url is mapped (look at .htaccess file)
    // normally it would be http://localhost/fengyumvc/index.php?url=blue
    // echo $_GET['url']; 

    if(isset($_GET['url'])) {
      $url = rtrim($_GET['url'], '/');
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = explode('/', $url);
      return $url;
    }
  }
}