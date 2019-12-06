<?php

class Sessions {
    public static function init_session(){
        session_start();
    }

    public static function new_session($name,$value){
        return $_SESSION[$name]=$value;
    }

    public static function session_exists($name){
        return isset($_SESSION[$name]);
    }

    public static function get_value($name){
        return $_SESSION[$name];
    }
}

?>