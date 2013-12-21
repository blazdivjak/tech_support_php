<?php
/**
 * Created by PhpStorm.
 * User: blaz
 * Date: 30/11/13
 * Time: 20:39
 */

class Controller {
    function __construct(){
        //echo "Main Controller<br/>";
        $this->view = new View();

        //Get Session and Display Name if possible
        Session::init();
        $name = Session::get('name');
        if($name!=""){
            $this->view->name=$name;
        }else{
            $this->view->name = "Prijava";
        }

    }
    public function LoadModel($name){
        $path='models/'. $name .'_model.php';
        if(file_exists($path)){
            require $path;
            $modelName=$name . "_Model";
            $this->model = new $modelName();
            echo "Loading model $modelName";
        }else{
            echo "Model does not exist</br>";
        }
    }

}