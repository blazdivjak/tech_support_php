<?php
/**
 * Created by PhpStorm.
 * User: blaz
 * Date: 30/11/13
 * Time: 20:34
 */

class Error extends Controller{
    function __construct(){
        parent::__construct();
        echo "Napaka, ta spletna stran ne obstaja.<br/>";
    }
}