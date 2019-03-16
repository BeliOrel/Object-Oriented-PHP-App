<?php
/*
 * Gase Controller
 * Loads the Models and Views
 */
class Controller {
  // Load Model
  public function model($model)
  {
    // Require model file
    require_once '../app/models/' . $model . '.php';

    // Instantiate the model
    return new $model();
  }

  // Load view
  public function view($view, $data = []){
    // check for the view file
    if(file_exists('../app/views/' . $view . '.php')){
      require_once('../app/views/' . $view . '.php');
    } else {
      // View does not exist
      die('View does not exist');
    }
  }
}