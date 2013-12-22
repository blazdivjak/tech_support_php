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
            $privilegelvl=Session::get("level");

            if($privilegelvl==1){

                //GET POST and filter tickets
               $this->view->query=$_POST['search'];
                if($this->view->query!=""){
                    $this->view->tickets= $model->isci($this->view->query, $userid);
                }else{
                    $this->view->tickets=$model->prikazi($userid);
                }

                //test search
                //$test=$model->isci('Virtualni strežniki', 1);
                //print_r($test);
                //exit();

                //admin info
                foreach($this->view->tickets as $row){
                    //echo $row['adminid'];
                    $admin_info=$model->uporabnik($row['adminid']);
                    $this->view->admin_info[$row['adminid']]=$admin_info[0]['name'];
                }

            }
            else{
                $redirect = sprintf("location: %szahtevki_admin",STATIC_URL);
                header($redirect);
                exit();
            }

            $this->view->render('user/zahtevki');
        }
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
            $this->view->result=$model->izbrisi($userid,$arg);
//            echo $this->view->result;
            $redirect = sprintf("location: %szahtevki",STATIC_URL);
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
            $this->view->tickets=$model->prikazi($userid);

            //admin info
            foreach($this->view->tickets as $row){
                //echo $row['adminid'];
                $admin_info=$model->uporabnik($row['adminid']);
                $this->view->admin_info[$row['adminid']]=$admin_info[0]['name'];
            }

            $this->view->edit_ticket=$model->prikazi($userid, $arg);
            $this->view->messages=$model->prikazi_sporocila($arg);
            $this->view->render('user/podrobnosti_zahtevka');
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

            if($state!=""){
                echo $state, $arg;

                require 'models/zahtevki.php';
                $model = new Zahtevki_Model();
                $userid=Session::get("userid");
                $this->view->tickets=$model->spremeni_stanje($arg, $state);
                echo "Zakljucujem ticket...</br>";
                //$this->view->render('user/podrobnosti_zahtevka');
                $redirect = sprintf("location: %szahtevki/uredi/$arg",STATIC_URL);
                header($redirect);
                exit();
            }else{
                $redirect = sprintf("location: %szahtevki",STATIC_URL);
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
                echo $message, $arg;

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
                if($privilegelvl="1"){
                    $state = "1";
                    $this->view->tickets=$model->spremeni_stanje($arg, $state);
                }else {
                    $state = "1";
                    $this->view->tickets=$model->spremeni_stanje($arg, $state);
                }

                //redirect back to view
                $redirect = sprintf("location: %szahtevki/uredi/$arg",STATIC_URL);
                header($redirect);
                exit();

            }else{
                $redirect = sprintf("location: %szahtevki",STATIC_URL);
                header($redirect);
                exit();
            }
        }
    }

}