<?php

class UserInformation extends Controller {

    function __construct() {
        //echo("dsfsd");
        parent::__construct();
    }
    function Index() {
        $this->view("template/header");

        $is_validate = isset($_SESSION["username"]);
        if ($is_validate){
            $this->view("main/validate");
        
        }else{
            $this->view("main/invalidate");
        }
        $this->view("template/footer");
        
    }

    function Login(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $post_csrf = htmlentities($_POST["csrf"]);
            $cookie_csrf = $_COOKIE["csrf"];
            $sess_cookie = $_SESSION["csrf"];
            //if($sess_cookie == $post_csrf && $sess_cookie == $cookie_csrf){


                $this->model("UserInformationModel");
                $clean_username = htmlentities($_POST["username"]);
                $clean_password = htmlentities($_POST["password"]);
                $validate = $this->UserInformationModel->validateUser($clean_username,$clean_password);
                if($validate){

                    header("location: /userinformation/");
                }else{
                    echo("invalidate");
                }
            // }else{
            //     echo ("bad csrf");
            // }
        }else if ($_SERVER["REQUEST_METHOD"] == "GET"){
            $csrf = random_int(10000, 1000000000);
            //$_SESSION["csrf"] = $csrf;
            setcookie("csrf",$csrf);
            $_SESSION["csrf"] = $csrf;
            $this->view("main/login" , array("csrf" => $csrf));
        }else{
http_response_code(405);


        }
    }
   function Logout(){
       session_unset();
       session_destroy();
       $_SESSION = Array();
       $this->view("main/logout");
   }


}

?>