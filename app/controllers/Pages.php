<?php
/*
 * Default Controller
 */ 
class Pages extends Controller {
  public function __construct() {
    
  }

  // this method must exist otherwise we can get error
  public function index() {
    $data = [
      'title' => 'Yu Feng',
      'description' => 'Simple Social Network built on the FengYuMVC PHP Framework'
    ];

    $this->view('pages/index', $data);
  }

  public function about(){
    $data = [
      'title' => 'About us',
      'description' => 'App to share posts with other users.'
    ];
    $this->view('pages/about', $data);
  }
}