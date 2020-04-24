<?php
class Blog extends Controller



{
    function _construct(){
        parent::__construct();
    }
    function Index(){
        $this -> model("BlogModel");
        $posts = $this -> BlogModel -> getAllPosts();
        $input = Array("posts" => $posts);
        $this -> view("template/header");
        $this -> view("blog/index" , $input);
        $this -> view("template/footer");
    }
    function Read($postId){
        //echo("postID" . $postId);
        $this -> model("BlogModel");
        $post = $this -> BlogModel -> getPostById($postId);
        $this -> view ("blog/header" , $post);
        $this -> view ("blog/post" , $post);
        $this -> view("template/footer");
    }
    function Create(){
        $is_auth = isset($_SESSION["username"]);
        if(!$is_auth){
            echo("is_auth::" . $is_auth);
            header("loaction: /blog");
            
            return;
        }
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $title = $_POST["title"];
            $content = $_POST["content"];
            $author = $_POST["author"];
            $this -> model("BlogModel");
            $slug = $this -> BlogModel -> createPost($title , $author , $content);
            header("location: /blog/read/" .$slug);    
        }else{
            $this -> view("template/header");
            $this -> view("blog/create");
            $this -> view("template/footer");
        }
    }
function UpdateBlogPost($postId){
    $is_auth = isset($_SESSION["username"]);
    if(!$is_auth){
        header("loaction: /blog");
        return;
    }
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $slug = $_POST["slug"];
        $title = $_POST["title"];
        $content = $_POST["content"];
        $author = $_POST["author"];
        $this->model("BlogModel");
        //echo("slug" . $slug ."<br />"."title". $title ."<br />". "content".$content. "<br />"."author". $author."<br />");
        $slug = $this->BlogModel->UpdateModelBlogPost($slug,$title,$author,$content);
        header("location: /blog/read/" . $slug);
    }else{
        $this->model("BlogModel");
        $post = $this->BlogModel->getPostById($postId);
        $this->view("template/header");
        $this->view("blog/updateblogpost", $post);
        $this->view("template/footer");
    }
}

}

?>