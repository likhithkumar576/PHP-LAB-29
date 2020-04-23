<?php
class BlogModel extends Model{
    function __construct(){
        parent:: __construct();
    }
    function getAllPosts(){
        $sql = "SELECT slug,title, author,post_date FROM posts";
        $stmt = $this -> db -> prepare($sql);
        $stmt -> execute();
        return $stmt -> fetchAll();
    }function getPostByIUd($postID){
        $sql = "SELECT title,content,author,post_date FROM posts WHERE slug = ?";
        $stmt = $this ->db-> prepare($sql);
        $stmt -> execute(Array($postID));
        return $stmt->fetch(); 
    }function createPost($title, $author, $content){
        $slug = (str_replace(" ","-",strtolower($title)).random_int(1000,999999));
        $sql = "INSERT INTO 'posts'('slug', 'title','content','author')VALUES(?,?,?,?,)";
        $stmt = $this->db->prepare($sql);
        $stmt-> execyte(Array($slug,$title,$content,$author));
        return $slug;
    }
}
?>