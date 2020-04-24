<?php
class BlogModel extends Model{
    function __construct(){
        parent:: __construct();
    }
    function getAllPosts(){
        $sql = "SELECT `slug`,`title`, `author`,`post_date` FROM posts";
        $stmt = $this -> db -> prepare($sql);
        $stmt -> execute();
        return $stmt -> fetchAll();
    }function getPostById($postID){
        $sql = "SELECT `title`,`content`,`author`,`post_date`, `slug` FROM posts WHERE slug = ?";
        $stmt = $this ->db-> prepare($sql);
        $stmt -> execute(Array($postID));
        return $stmt->fetch(); 
    }function createPost($title, $author, $content){
        $slug = (str_replace(" ","-",strtolower($title)).random_int(1000,999999));
        $sql = "INSERT INTO `posts` (`slug`, `title`,`content`,`author`) VALUES (?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt-> execute(Array($slug,$title,$content,$author));
        return $slug;
    }
    function UpdateModelBlogPost($slug,$title,$author,$content){
        //echo("slug" . $slug ."<br />"."title". $title ."<br />". "content".$content. "<br />"."author". $author."<br />");
        $update_sql = "UPDATE `posts` `set` `title` = ?, `content` = ?, `author` = ? where `slug` = ?";
        $update_stmt = $this->db->prepare($update_sql);
        $update_stmt->execute(Array($title,$content,$author,$slug));
        return $slug;
    }



}
?>