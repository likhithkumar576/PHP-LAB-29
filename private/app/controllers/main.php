<?php

class Main extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    /*
     * http://localhost/
     */
    function Index () {

        $this->view("template/header");
        $this->view("main/index");
        $this->view("template/footer");
        
    }

    function Other () {

        $this->view("template/header");
        $this->view("main/other");
        echo("<br><br><br>hello there");
        $this->view("template/footer");
        
    }

    function Rolls () {

        $this->view("template/header");
        $this->view("main/rolls");
        $this->view("template/footer");
        
    }
    function Harley () {

        $this->view("template/header");
        $this->view("main/harley");
        $this->view("template/footer");
        
    }
}

?>