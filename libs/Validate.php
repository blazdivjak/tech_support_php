<?php
/**
 * Created by PhpStorm.
 * User: blaz
 * Date: 30/11/13
 * Time: 21:33
 */

class Validate {
    function __construct(){
        //echo "This is Validation<br/>";

    }
    public function email($value){

        $regex = "^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$";
        if(eregi($regex, $value)){
            //valid
            return 1;
        }
        else{
            //invalid
            return 0;
        }
    }
    public function phone($value){

        $regex = "^[0-9]{3} [0-9]{3}-[0-9]{3}$";
        if(eregi($regex, $value)){
            //valid
            return 1;
        }
        else{
            //invalid
            return 0;
        }
    }
    public function string($value){

        //$regex = "^[0-9]{4}/[0-9]{2}/[0-9]{3}$";
        $regex = "";
        if($value!=$regex){
            //valid
            return 1;
        }
        else{
            //invalid
            return 0;
        }
    }
    public function date($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
}