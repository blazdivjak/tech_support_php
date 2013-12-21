<?php
/**
 * Created by PhpStorm.
 * User: blaz
 * Date: 30/11/13
 * Time: 20:12
 */

class Prijava_Tezave extends Controller{
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
            $this->view->render('user/prijava_tezave');
        }
    }

    public function dodaj($arg=false){
        echo "Dodajam..";

        //parse POST variables add validation here
        $kratek_opis = $_POST['kratek_opis'];
        $datum = $_POST['date'];
        $podrocje = $_POST['podrocje'];
        $opis = $_POST['opis'];
        $tel = $_POST['tel'];

        //TODO:dodaj validacijo

        //get user id
        Session::init();
        $userid=Session::get('userid');

        //echo $kratek_opis, $datum, $podrocje, $opis, $tel, $userid;

        require 'models/prijava_tezave.php';
        $model = new Prijava_Tezave_Model();
        $this->view->result=$model->dodaj($kratek_opis, $datum, $podrocje, $opis, $tel, $userid);
        if($this->view->result==1){
            //$this->view->msg="Zahtevek uspešno dodan.";
            //$this->view->render('user/zahtevki');
            $redirect = sprintf("location: %szahtevki",STATIC_URL);
            header($redirect);
        }else{
            $this->view->render('user/prijava_tezave');
        }
        //$this->view->render('user/zahtevki');

        //header($redirect);
        //exit();
    }
}