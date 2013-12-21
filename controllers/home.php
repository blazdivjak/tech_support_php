<?php
/**
 * Created by PhpStorm.
 * User: blaz
 * Date: 30/11/13
 * Time: 20:07
 */

class Home extends Controller{
    function __construct(){
        parent::__construct();
        //echo "We are in Home<br/>";
    }
    function index(){

        //echo Session::get('name');

        $this->view->msg = "Sporocilo, ki bo izpisano na pogledu";
        //$this->view->name=
        $this->view->render('user/index');
    }

    public function other($arg = false) {
        echo "we are inside other<br/>";
        //echo "Opcijski argument: " . $arg . "<br/>";
        $this->view->msg = "Sporocilo, ki bo izpisano na pogledu. Poslan nam je bil tudi opcijski argument $arg .";
        $this->view->render('user/index');
    }
}