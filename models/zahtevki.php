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
        echo "Model za prikaz/izbris zahtevkov";
    }
    function dodaj($kratek_opis, $datum, $podrocje, $opis, $tel, $userid, $level=2, $state="Čaka na odziv agenta"){

        //$query = $this->db->prepare("INSERT INTO ticket (type, userid) VALUES ('$podrocje','$userid')");
        $query = $this->db->prepare("INSERT INTO ticket (problem, date, type, description, phone, level, userid, state) VALUES('$kratek_opis', '$datum', '$podrocje', '$opis', '$tel', '$level', '$userid', '$state')");

        $sql_response=$query->execute();
        echo $sql_response;
        return $sql_response;
    }
    function prikazi($userid, $filter='NONE'){

        $query = $this->db->query("SELECT *  FROM ticket WHERE userid='$userid'");
        $result = $query->fetchAll();
        //print_r($data);
        return $result;
    }
}