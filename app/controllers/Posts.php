<?php

class Posts extends Controller {
    public function __construct(){
        if (!isLoggedIn()) {
            redirect("users/login");
        }
        //Load the model
        $this->postModel = $this->model("Post");
        $this->userModel = $this->model("User");
    }

    public function index(){
        //Get Posts
    $posts = $this->postModel->getPosts();
    $data = [
        "posts" => $posts
    ];
    $this->view("posts/index" , $data);

   
}
    public function add(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Sanitize post
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                "title" => trim($_POST["title"]),
                "body" => trim($_POST["body"]),
                "user_id" => trim($_SESSION["user_id"]),
                "title_error" => "",
                "body_error" => ""
            ];
            
            // Validate title

            if (empty($data["title"])) {
                $data["title_error"] = "Please insert a title to your post";
            }
            // Validate body

            if (empty($data["body"])) {
                $data["body_error"] = "Please insert something to your post";
            }

            //Make sure there are no errors

            if(empty($data["title_error"]) && empty($data["body_error"])){
                if ($this->postModel->addPost($data)) {
                  flash("post_message", "Your post has been added");
                  redirect("posts");
                } else{
                    die("SOMETHING WENT WRONG");
                }
            } else{
                $this->view("posts/add", $data);
            }
        } 
        
        
        
        else {
            $data = [
                "title" => "",
                "body" => ""
            ];
            $this->view("posts/add" , $data);
        }
        
    }

    public function edit($id){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Sanitize post
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'id' => $id,
                "title" => trim($_POST["title"]),
                "body" => trim($_POST["body"]),
                "user_id" => $_SESSION["user_id"],
                "title_error" => "",
                "body_error" => ""
            ];
            
            // Validate title

            if (empty($data["title"])) {
                $data["title_error"] = "Please insert a title to your post";
            }
            // Validate body

            if (empty($data["body"])) {
                $data["body_error"] = "Please insert something to your post";
            }

            //Make sure there are no errors

            if(empty($data['title_error']) && empty($data['body_error'])){
                // Validated
                if($this->postModel->updatePost($data)){
                  flash('post_message', 'Post Updated');
                  redirect('posts');
                } else {
                  die('Something went wrong');
                }
              } else {
                // Load view with errors
                $this->view('posts/edit', $data);
              }
        } 
        
        
        
        else {
            // Getting existing post from model
            $post = $this->postModel->getPostById($id);

            // Check for the owner
            if ($post->user_id != $_SESSION["user_id"]) {
                redirect("posts");
            }
            $data = [
                "id" => $id,
                "title" => $post->title,
                "body" => $post->body
            ];
            $this->view("posts/edit" , $data);
        }
        
    }

    public function show($id){
        $post = $this->postModel->getPostById($id);
        $user = $this->userModel->getUserById($post->user_id);
        $data = [
            "post" => $post,
            "user" => $user
        ];
    $this->view("posts/show", $data);
    }

    public function delete($id){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
             // Getting existing post from model
             $post = $this->postModel->getPostById($id);

             // Check for the owner
             if ($post->user_id != $_SESSION["user_id"]) {
                 redirect("posts");
             }
            
             if ($this->postModel->deletePost($id)) {
                flash("post_message", "Your post has been deleted");
                redirect("posts");
            } else {
                die("SOMETHING WENT WRONG");
            }
        }
         else {
            redirect("posts");
        }
        
        
    }
}