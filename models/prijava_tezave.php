<?php
/**
 * Created by PhpStorm.
 * User: blaz
 * Date: 30/11/13
 * Time: 21:15
 */

class Prijava_Tezave_Model extends Model {
    function __construct(){
        parent::__construct();
        echo "Model za dodajanje zahtevkov";
    }
    function dodaj($kratek_opis, $datum, $podrocje, $opis, $tel, $userid, $level=2, $state="Čaka na odziv agenta"){

        $datum = date('Y-m-d', strtotime($datum));
        //echo $datum;

        //$query = $this->db->prepare("INSERT INTO ticket (type, userid) VALUES ('$podrocje','$userid')");
        $query = $this->db->prepare("INSERT INTO ticket (problem, date, type, description, phone, level, userid, state) VALUES('$kratek_opis', '$datum', '$podrocje', '$opis', '$tel', '$level', '$userid', '$state')");

        $sql_response=$query->execute();
        echo $sql_response;
        return $sql_response;
    }
}