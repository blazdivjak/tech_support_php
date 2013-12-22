<?php
/**
 * Created by PhpStorm.
 * User: blaz
 * Date: 30/11/13
 * Time: 20:12
 */

class Prijava extends Controller{
    function __construct(){
        parent::__construct();
        //echo "Smo na strani za prijavo<br/>";
    }

    function index(){

        //Check if user is logged in
        Session::init();
        $logedin=Session::get("username");
        if($logedin==False){
            Session::destroy();

            //check cookies and try login with cookies
            $username=$_COOKIE['username'];
            $password=$_COOKIE['password'];

            echo $username, $password;
            //exit();

            if($username!=''){
                Session::init();
                require 'models/prijava.php';
                $model = new Prijava_Model();
                $user = $model->preveriUporabnika($username, $password);
                if($user!=0){
                    Session::set('username', $username);

                    //preveri njegov privilege level
                    //print_r($user);
                    $privilegelvl=$user[0]['privilegelvl'];
                    $name=$user[0]['name'];
                    $userid=$user[0]['userid'];
                    Session::set('level',$privilegelvl);
                    Session::set('name',$name);
                    Session::set('userid',$userid);
                    if($privilegelvl==1){
                        //echo "need to redirect now";
                        //header('location:zahtevki');
                        $redirect = sprintf("location: %szahtevki",STATIC_URL);
                        //echo $redirect;
                        header($redirect);
                        exit();

                    }else{
                        $redirect = sprintf("location: %szahtevki_admin",STATIC_URL);
                        header($redirect);
                        exit();
                    }
                }

            }

            $this->view->msg = "Nismo še prijavljeni, zato bo potrebna prijava.";
            $this->view->render('login/prijava');
        }elseif(Session::get('level')==1){
            header('location:zahtevki');
        }else{
            header('location:zahtevki_admin');
        }
    }
    public function prijavime($arg=false){

        //get user data from post and check login
        Session::init();

        $username = $_POST['username'];
        $password = $_POST['password'];
        $remember = $_POST['remember'];

        //echo "Printam username: $username";

        //normal login
        require 'models/prijava.php';
        $model = new Prijava_Model();
        $user = $model->preveriUporabnika($username, $password);

        //preveri uporabnika
        if($user!=0){
            Session::set('username', $username);

            //preveri njegov privilege level
            //print_r($user);
            $privilegelvl=$user[0]['privilegelvl'];
            $name=$user[0]['name'];
            $userid=$user[0]['userid'];
            Session::set('level',$privilegelvl);
            Session::set('name',$name);
            Session::set('userid',$userid);

            if($remember=='yes'){
                setcookie('username', $username, 0, '/');
                setcookie('password', $password, 0, '/');

            }

            if($privilegelvl==1){
                //echo "need to redirect now";
                //header('location:zahtevki');
                $redirect = sprintf("location: %szahtevki",STATIC_URL);
                //echo $redirect;
                header($redirect);
                exit();

            }else{
                $redirect = sprintf("location: %szahtevki_admin",STATIC_URL);
                header($redirect);
                exit();
            }
        }
        else{
           Session::destroy();
           $this->view->msg = "Uporabniško ime ali geslo ni pravilno";

           //$redirect = sprintf("location: %sprijava",STATIC_URL);
           //header($redirect);
           //exit();
           $this->view->render('login/prijava');
        }
        //print $user_is_authenticated;
        //header('location: ');
        //$this->view->render('user/index');
    }
}