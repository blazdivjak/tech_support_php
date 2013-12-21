<?php
/**
 * Created by PhpStorm.
 * User: blaz
 * Date: 30/11/13
 * Time: 20:28
 */

class Bootstrap {

    function __construct(){

        //get url
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        //print_r($url);

        if(empty($url[0])){
            require 'controllers/home.php';
            $controller = new Home();
            $controller->index();
            return false;
        }

        //load controler with file
        $file = 'controllers/' . $url[0] . '.php';

        //check if file exists
        if(file_exists($file)){
            require $file;
        }else{
            require 'controllers/error.php';
            $controller = new Error();
            throw new Exception("The file: $file Does not exist!");
            return false;
        }

        //initialize controler and load model
        $controller = new $url[0];
        $controller->LoadModel($url[0]);

        //if function was set load function, else load index
        if(isset($url[2])){
            if(method_exists($controller, $url[1])){
                $controller->{($url[1])}($url[2]);
            }
            else{
                echo "Napaka: funkcija $url[1] ne obstaja.";
            }
            return false;
        }
        elseif(isset($url[1])){
            if(method_exists($controller, $url[1])){
                $controller->{($url[1])}();
            }
            else{
                echo "Napaka: funkcija $url[1] ne obstaja.";
            }
            return false;
        }else{
            $controller->index();
        }
    }

}