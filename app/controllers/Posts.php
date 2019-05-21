<?php
class Posts extends Controller {
  public function __construct()
  {
    // all posts functionality only for loggedin users
    if(!isLoggedIn()) {
      redirect('users/login');
    }

    $this->postModel = $this->model('Post');
    $this->userModel = $this->model('User');
  }

  public function index() {
    // Get posts
    $posts = $this->postModel->getPosts();
    $data = [
      'posts' => $posts
    ];
    $this->view('posts/index', $data);
  }

  public function add(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      // Sanitize the POST array
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      
      $data = [
        'title' => trim($_POST['title']),
        'body' => trim($_POST['body']),
        'user_id' => $_SESSION['user_id'],
        'title_error' => '',
        'body_error' => ''
      ];

      // Validate data
      if(empty($data['title'])){
        $data['title_error'] = 'Please enter title';
      }
      if(empty($data['body'])){
        $data['body_error'] = 'Please enter body text';
      }

      // Make sure there's no errors
      if(empty($data['title_error']) && empty($data['body_error'])){ 
        // Validated
        if($this->postModel->addPost($data)){
          flash('post_message', 'Post added');
          redirect('posts');
        } else {
          die('Something went wrong!');
        }
      } else {
        // Load view with errors
        $this->view('posts/add', $data);
      }

    } else {

    }

    $data = [
      'title' => '',
      'body' => ''
    ];

    $this->view('posts/add', $data);
  }

  public function show($id) {
    $post = $this->postModel->getPostById($id);
    $user = $this->userModel->getUserById($post->user_id);
    $data = [
      'post' => $post,
      'user' => $user
    ];
    $this->view('posts/show', $data);
  }
}