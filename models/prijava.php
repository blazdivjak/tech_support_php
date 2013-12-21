<?php
/**
 * Created by PhpStorm.
 * User: blaz
 * Date: 30/11/13
 * Time: 21:15
 */

class Prijava_Model extends Model {
    function __construct(){
        parent::__construct();
        echo "Model za prijavo v aplikacijo";
    }
    function preveriUporabnika($username, $password){

        $query = $this->db->query("SELECT *  FROM user WHERE username='$username' AND password='$password'");

        $data = $query->fetchAll();
        if(count($data)<1){
            $user_authenticated = 0;
            return 0;
        }
        else{
            $user_authenticated = 1;
            return $data;
        }
        //print_r($data);

    }
}