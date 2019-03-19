<?php
class Posts extends Controller {
  public function __construct()
  {
    // all posts functionality only for loggedin users
    if(!isLoggedIn()) {
      redirect('users/login');
    }
  }

  public function index() {
    $data = [];
    $this->view('posts/index');
  }
}