<?php
  class Pages extends Controller {
    public function __construct(){
      $this->postModel = $this->model('Post');
    }
    
    public function index(){
      if(isLoggedIn()){
        redirect("posts");
      }
      $data = [
        'title' => 'Postum',
        "description" => "A simple social network for 
        sharing posts built in my own PHP framework: BayoneMVC."
      ];
     
      $this->view('pages/index', $data);
    }

    public function about(){
      $data = [
        'title' => 'About Us',
        "description" => "A forum for sharing any kind of posts with other users."
      ];

      $this->view('pages/about', $data);
    }
  }