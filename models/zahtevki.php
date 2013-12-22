<?php
/**
 * Created by PhpStorm.
 * User: blaz
 * Date: 30/11/13
 * Time: 21:15
 */

class Zahtevki_Model extends Model {
    function __construct(){
        parent::__construct();
        //echo "Model za prikaz/izbris zahtevkov";
    }
    function dodaj($kratek_opis, $datum, $podrocje, $opis, $tel, $userid, $level=2, $state="1"){

        $query = $this->db->prepare("INSERT INTO ticket (problem, date, type, description, phone, level, userid, state) VALUES('$kratek_opis', '$datum', '$podrocje', '$opis', '$tel', '$level', '$userid', '$state')");

        $sql_response=$query->execute();
        echo $sql_response;
        return $sql_response;
    }
    function prikazi($userid, $ticketid='NONE'){

        if($ticketid=='NONE'){
            $query = $this->db->query("SELECT *  FROM ticket WHERE userid='$userid'");
        }
        else {
            $query = $this->db->query("SELECT *  FROM ticket WHERE userid='$userid' AND ticketid='$ticketid'");
        }

        $result = $query->fetchAll();
        //print_r($data);
        return $result;
    }

    function prikazi_admin($ticketid){

        $query = $this->db->query("SELECT *  FROM ticket WHERE ticketid='$ticketid'");

        $result = $query->fetchAll();
        //print_r($data);
        return $result;
    }

    function uporabnik($userid){

        $query = $this->db->query("SELECT *  FROM user WHERE userid='$userid'");

        $result = $query->fetchAll();
        //print_r($data);
        return $result;
    }
    function uporabnik_id($username){

        $query = $this->db->query("SELECT *  FROM user WHERE username='$username'");

        $result = $query->fetchAll();
        //print_r($data);
        return $result;
    }


    function prikazi_vse($level=2){

        $query = $this->db->query("SELECT *  FROM ticket WHERE level='$level'");

        $result = $query->fetchAll();

        return $result;
    }
    function izbrisi($userid, $ticketid, $level=1){

        if($level==1){
            $query_string= "DELETE FROM ticket WHERE ticketid = '$ticketid' AND userid='$userid'";
        }else{
            $query_string= "DELETE FROM ticket WHERE ticketid = '$ticketid'";
        }

        $query = $this->db->query($query_string);
        //$sql_response=$query->execute();
        //print_r($data);
        //return $sql_response;
        return $query;
    }
    function spremeni_stanje($ticketid, $state){

        $query_string = "UPDATE ticket SET state='$state' WHERE ticketid='$ticketid'";
        $query = $this->db->query($query_string);
        //$sql_response=$query->execute();
        //print_r($data);
        //return $sql_response;
        return $query;
    }

    function own($ticketid, $adminid){

        $query_string = "UPDATE ticket SET adminid='$adminid' WHERE ticketid='$ticketid'";
        $query = $this->db->query($query_string);
        //$sql_response=$query->execute();
        //print_r($data);
        //return $sql_response;
        return $query;
    }

    function escalate($ticketid, $level){

        $query_string = "UPDATE ticket SET level='$level' WHERE ticketid='$ticketid'";
        $query = $this->db->query($query_string);
        //$sql_response=$query->execute();
        //print_r($data);
        //return $sql_response;
        return $query;
    }

    function dodaj_sporocilo($ticketid, $timestamp, $privilegelvl, $message, $name){

        $query_string = "INSERT INTO message (ticketid, date, privilegelvl ,user, content) VALUES('$ticketid', '$timestamp','$privilegelvl' ,'$name', '$message')";
        $query = $this->db->query($query_string);
        //$sql_response=$query->execute();
        //print_r($data);
        //return $sql_response;
        return $query;
    }
    function prikazi_sporocila($ticketid){

        $query = $this->db->query("SELECT *  FROM message WHERE ticketid='$ticketid'");

        $result = $query->fetchAll();
        //print_r($data);
        return $result;
    }
}