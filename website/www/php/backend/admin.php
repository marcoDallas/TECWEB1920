<?php
/*
 *  Classe per la verifica/logout dell'amministratore
 */
include_once('sessions.php');

class Admin{

    public static function init_admin(){
        Sessions::init_session();
        if(!Admin::verify() && isset($_POST['Login']))
            Admin::login();
        if(isset($_POST['Logout']))
            Admin::logout();
    }

    public static function verify(){
        return Sessions::session_exists('admin') && Sessions::get_value('admin')==TRUE;
    }

    public static function logout(){
        if(Sessions::session_exists('admin')){
            Sessions::delete_session('admin');
            return TRUE;
        }
        return FALSE;
    }

    public static function login(){
        if(isset($_POST['username']) && isset($_POST['password'])){
            require_once 'backend/get_admin.php';
            $verify = new Get_admin();
            if($verify->admin($_POST['username'],$_POST['password']))
                Sessions::new_session('admin',TRUE);
        }
    }

}

?>