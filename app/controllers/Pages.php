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
      'title' => 'FengYuMVC',
    ];

    $this->view('pages/index', $data);
  }

  public function about(){
    $data = [
      'title' => 'About us'
    ];
    $this->view('pages/about', $data);
  }
}