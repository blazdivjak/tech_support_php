<?php
/**
 * Created by PhpStorm.
 * User: blaz
 * Date: 01/12/13
 * Time: 20:04
 */

class Session {

    public static function init(){
        @session_start();
    }

    public static function set($key, $value){
        $_SESSION[$key]=$value;
    }
    public static function get($key){
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }
    }
    public static function destroy(){

        unset($_SESSION);
        session_destroy();
    }
}