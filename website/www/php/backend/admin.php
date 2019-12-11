<?php
/*
 *  Classe per la verifica/logout dell'amministratore
 */
include_once('sessions.php');

class Admin{

    public static function init_admin(){
        Sessions::set_expire(1800); //30 minuti di vita alle sessioni
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
            require_once 'backend/input_security_check.php';
            $username = Input_security_check::username_check($_POST['username']);
            $password = Input_security_check::password_check($_POST['password']);
            if(!$username || !$password){
                error_log("Security check failed");
                echo('<div id="login_error"><p>Hai inserito simboli non consentiti</p><div id="close_error">X</div></div>');
                return FALSE;
            }
            require_once 'backend/get_admin.php';
            if((new Get_admin())->admin($_POST['username'],$_POST['password'])){
                Sessions::new_session('admin',TRUE);
                return TRUE;
            }else{
                error_log("Wrong password");
                echo('<div id="login_error"><p>Password errata!</p><div id="close_error">X</div></div>');
                return FALSE;
            }
        }
    }

}

?>