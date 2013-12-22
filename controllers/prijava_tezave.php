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
        $level=Session::get("level");
        if($level>1){
            $redirect = sprintf("location: %sprijava_tezave_admin",STATIC_URL);
            header($redirect);
            exit();
        }
        else{
            $this->view->render('user/prijava_tezave');
        }
    }

    public function dodaj($arg=false){
        echo "Dodajam..";

        //get user id
        Session::init();
        $userid=Session::get('userid');
        if($userid==""){
            $redirect = sprintf("location: %sprijava",STATIC_URL);
            header($redirect);
            exit();
        }
        //parse POST variables add validation here
        $kratek_opis = $_POST['kratek_opis'];
        $datum = $_POST['date'];
        $podrocje = $_POST['podrocje'];
        $opis = $_POST['opis'];
        $tel = $_POST['tel'];

        //echo $kratek_opis, $datum, $podrocje, $opis, $tel, $userid;

        //inicialize model
        require 'models/prijava_tezave.php';
        $model = new Prijava_Tezave_Model();


        //validate

        $validation = "succeded";

        $validate = new Validate();
        if($validate->string($kratek_opis)!=1){
            $validation="failed";
            $this->view->errors['kratek_opis']="Vnesite naslov težave";
        }if(!$validate->date($datum, 'm/d/Y')){
            $validation="failed";
            $this->view->errors['datum']="Izberite datum";
        }if($validate->string($podrocje)!=1){
            $validation="failed";
            $this->view->errors['podrocje']="Vnesite področje na katerem imate težavo";
        }if($validate->string($opis)!=1){
            $validation="failed";
            $this->view->errors['opis']="Vnesite opis vaše težave";
        }if($validate->phone($tel)!=1){
            $validation="failed";
            $this->view->errors['tel']="Telefonska številka ni prave oblike";
        }

        /*samples
        var_dump($validate->email('test@arnes.si'));
        var_dump($validate->phone('031 772-079'));
        var_dump($validate->date('01/30/2014'));
        var_dump($validate->date('30/01/2012', 'd/m/Y'));
        var_dump($validate->string('test'));*/

        //$validation = "failed";

        if($validation=="failed"){

            $this->view->values['kratek_opis']=$kratek_opis;
            $this->view->values['datum']=$datum;
            $this->view->values['podrocje']=$podrocje;
            $this->view->values['opis']=$opis;
            $this->view->values['tel']= $tel;

            $this->view->render('user/prijava_tezave');
            exit();
        }

        //insert into database
        $this->view->result=$model->dodaj($kratek_opis, $datum, $podrocje, $opis, $tel, $userid);
        if($this->view->result==1){
            //$this->view->msg="Zahtevek uspešno dodan.";
            //$this->view->render('user/zahtevki');
            $redirect = sprintf("location: %szahtevki",STATIC_URL);
            header($redirect);
            exit();
        }else{
            $this->view->render('user/prijava_tezave');
            exit();
        }
        //$this->view->render('user/zahtevki');

        //header($redirect);
        //exit();
    }
}