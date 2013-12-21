<?php
/**
 * Created by PhpStorm.
 * User: blaz
 * Date: 30/11/13
 * Time: 20:42
 */

class View {
    function __construct(){
        //echo "This is the view";
    }

    public function render($name){
        require 'views/' . $name . '.php';

        //require footer and header
        //require 'views/header.php';
        //require 'views/footer.php';

    }
}