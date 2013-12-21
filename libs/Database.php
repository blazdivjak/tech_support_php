<?php
/**
 * Created by PhpStorm.
 * User: blaz
 * Date: 01/12/13
 * Time: 18:37
 */

class Database extends PDO{
    public function __construct(){
        parent::__construct('mysql:dbname=sp;host=localhost','root','xxx');

    }
}
