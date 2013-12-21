<?php
/**
 * Created by PhpStorm.
 * User: blaz
 * Date: 30/11/13
 * Time: 20:12
 */

class Zahtevki_Admin extends Controller{
    function __construct(){
        parent::__construct();
        //echo "Smo na adminstratorski strani za zahtevke<br/>";
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
            $privilegelvl=Session::get("level");

            if($privilegelvl==1){
                $redirect = sprintf("location: %szahtevki",STATIC_URL);
                header($redirect);
                exit();
            }
            else{
                $this->view->tickets=$model->prikazi_vse($privilegelvl);

                //admin info
                foreach($this->view->tickets as $row){
                    //echo $row['adminid'];
                    $admin_info=$model->uporabnik($row['adminid']);
                    $this->view->admin_info[$row['adminid']]=$admin_info[0]['name'];
                }

            }
            $this->view->render('admin/zahtevki');
        }
    }

    public function izbrisi($arg=false){
        //Check if user is logged in
        Session::init();
        $logedin=Session::get("username");
        $privilegelvl=Session::get("level");
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
            $this->view->result=$model->izbrisi($userid,$arg, $privilegelvl);
//            echo $this->view->result;
            $redirect = sprintf("location: %szahtevki_admin",STATIC_URL);
            header($redirect);
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
            $privilegelvl=Session::get("level");

            //all tickets
            $this->view->tickets=$model->prikazi_vse($privilegelvl);

            //ticket info
            $this->view->edit_ticket=$model->prikazi_admin($arg);

            //user info
            $this->view->user_info=$model->uporabnik($this->view->edit_ticket[0]['userid']);


            //admin info
            $this->view->adminid=$userid;

            foreach($this->view->tickets as $row){
                //echo $row['adminid'];
                $admin_info=$model->uporabnik($row['adminid']);
                $this->view->admin_info[$row['adminid']]=$admin_info[0]['name'];
            }
            //print_r($this->view->admin_info);
            //echo $this->view->admin_info[5];
            //exit();


            $this->view->messages=$model->prikazi_sporocila($arg);
            $this->view->render('admin/podrobnosti_zahtevka');
            //$redirect = sprintf("location: %szahtevki",STATIC_URL);
            //header($redirect);
            exit();
        }
    }
    public function posodobi($arg=false){
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

            //get POST variable
            $state = $_POST['state'];
            $own =  $_POST['owner'];
            $escalate =  $_POST['escalate'];

            if($state!=""){
                echo $state, $arg;

                require 'models/zahtevki.php';
                $model = new Zahtevki_Model();
                $userid=Session::get("userid");

                //change ticket state
                $this->view->tickets=$model->spremeni_stanje($arg, $state);

                //own this ticket
                if($own!=""){
                    $this->view->tickets=$model->own($arg, $userid);
                }

                echo "Zakljucujem ticket...</br>";
                //$this->view->render('user/podrobnosti_zahtevka');
                $redirect = sprintf("location: %szahtevki_admin/uredi/$arg",STATIC_URL);
                header($redirect);
                exit();
            }elseif($escalate!=''){

                require 'models/zahtevki.php';
                $model = new Zahtevki_Model();
                $this->view->tickets=$model->escalate($arg, $escalate);

                $redirect = sprintf("location: %szahtevki_admin",STATIC_URL);
                header($redirect);
                exit();
            }
            else{
                $redirect = sprintf("location: %szahtevki_admin",STATIC_URL);
                header($redirect);
                exit();
            }
        }
    }
    public function poslji($arg=false){
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

            //get POST variable
            $message = $_POST['message'];

            //TODO: Validate message

            if($message!=""){

                //get sending user
                $userid=Session::get("userid");
                $privilegelvl=Session::get("level");
                $name=Session::get("name");

                //get timestmapl
                date_default_timezone_set('Europe/Ljubljana');
                $date = date('Y-m-d G:i:s a', time());

                echo $userid, $privilegelvl, $date;

                //save message
                require 'models/zahtevki.php';
                $model = new Zahtevki_Model();

                //$this->view->tickets=$model->spremeni_stanje($arg, $state);
                $this->view->sql_report=$model->dodaj_sporocilo($arg, $date, $privilegelvl, $message, $name);

                //change ticket state
                if($privilegelvl=="1"){
                    $state = "Čaka na odziv agenta";
                    $this->view->tickets=$model->spremeni_stanje($arg, $state);
                }else {
                    $state = "3";
                    $this->view->tickets=$model->spremeni_stanje($arg, $state);
                }

                //redirect back to view
                $redirect = sprintf("location: %szahtevki_admin/uredi/$arg",STATIC_URL);
                header($redirect);
                exit();

            }else{
                $redirect = sprintf("location: %szahtevki_admin",STATIC_URL);
                header($redirect);
                exit();
            }
        }
    }

}