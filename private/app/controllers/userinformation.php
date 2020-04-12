<?php

class User extends Controller {

    function _construct() {
        parent::_construct ();

    }
    function Index() {
        $this->view("template/header");

        $is_validate = isset($_SESSION["username"]);
        if ($is_validate){
            $this->view("test/validate");
        
        }else{
            $this->view("test/invalidate");
        }
        $this->view("template/footer");
        
    }

    function Login(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $post_csrf = htmlentities($_POST["csrf"]);
            $cookie_csrf = $_COOKIE["csrf"];
            $sess_cookie = $_SESSION["csrf"];
            if($sess_cookie == $post_csrf && $sess_cookie == $cookie_csrf){


                $this->model("UserInformationModel");
                $clean_username = htmlentities($_POST["username"]);
                $clean_password = htmlentities($_POST["password"]);
                $validate = $this->UsersInformationModel->validateUser($clean_username,$clean_password);
                if($validate){

                    header("location: /user/");
                }else{
                    echo("invalidate");
                }
            }else{
                echo ("bad csrf");
            }
        }else if ($_SERVER["REQUEST_METHOD"] == "GET"){
            $csrf = random_int(10000, 1000000000);
            $_SESSION["csrf"] = $csrf;
            setcookie("csrf",$csrf);
            $this->view("test/login" , array("csrf" => $csrf));
        }else{
http_response_code(405);


        }
    }
   function Logout(){
       session_unset();
       session_destroy();
       $_SESSION = Array();
       header("location: /user/");
   }


}

?>