<?php
/**
 * Created by PhpStorm.
 * User: blaz
 * Date: 30/11/13
 * Time: 20:12
 */

class Zahtevki extends Controller{
    function __construct(){
        parent::__construct();
        //echo "Smo na strani z zahtevki<br/>";
    }
    function index(){
        //Check if user is logged in
        Session::init();
        $logedin=Session::get("username");
        if($logedin==False){
            Session::destroy();
            header('location:prijava');
        }
        else{
            require 'models/zahtevki.php';
            $model = new Zahtevki_Model();
            $userid=Session::get("userid");

            /*$this->view->result=$model->prikazi($userid);

            foreach($this->view->result as $row){
                echo $row['userid'];
                //print_r($row);
                echo "------------";
            }*/
            $this->view->tickets=$model->prikazi($userid);
            $this->view->render('user/zahtevki');
        }
    }

    public function add($arg=false){
        require 'models/requests_model.php';
        $model = new Requests_Model();
        $this->view->result=$model->add();
        $this->view->render('user/requests_view');
    }
    public function izbrisi($arg=false){
        //Check if user is logged in
        Session::init();
        $logedin=Session::get("username");
        if($logedin==False){
            Session::destroy();
            $redirect = sprintf("location: %sprijava",STATIC_URL);
            header($redirect);
            exit();
        }
        else{
            require 'models/zahtevki.php';
            $model = new Zahtevki_Model();
            $userid=Session::get("userid");

            echo "Brišem...</br>";
            $redirect = sprintf("location: %szahtevki",STATIC_URL);
            //header($redirect);
            exit();
        }
    }
    public function uredi($arg=false){
        //Check if user is logged in
        Session::init();
        $logedin=Session::get("username");
        if($logedin==False){
            Session::destroy();
            $redirect = sprintf("location: %sprijava",STATIC_URL);
            header($redirect);
            exit();
        }
        else{
            require 'models/zahtevki.php';
            $model = new Zahtevki_Model();
            $userid=Session::get("userid");

            echo "Urejam...</br>";
            //$this->view->render('user/zahtevki/');
            //$redirect = sprintf("location: %szahtevki",STATIC_URL);
            //header($redirect);
            exit();
        }
    }
}