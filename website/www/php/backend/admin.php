<?php
/*
 *  Classe per la verifica/logout dell'amministratore
 */
include_once('sessions.php');

class Admin
{
    public static function init_admin()
    {
        Sessions::set_expire(1800); //30 minuti di vita alle sessioni
        Sessions::init_session();
        
        if (!Admin::verify() && isset($_POST['Login'])) {
            return Admin::login();
        }
        if (isset($_POST['Logout'])) {
            Admin::logout();
        }
    }

    public static function verify()
    {
        return Sessions::session_exists('admin') && Sessions::get_value('admin')==true;
    }

    public static function logout()
    {
        if (Sessions::session_exists('admin')) {
            Sessions::delete_session('admin');
            return true;
        }
        return false;
    }

    public static function login()
    {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            require_once 'backend/input_security_check.php';
            $username = Input_security_check::username_check($_POST['username']);
            $password = Input_security_check::password_check($_POST['password']);
            if (!$username || !$password) {
                error_log("Security check failed");
                return '<div id="login_error"><p id="text_error">Hai inserito simboli non consentiti</p><a class="close" onclick="close_error(this)"></a></div>';
            }
            require_once 'backend/get_admin.php';
            if ((new Get_admin())->admin($_POST['username'], $_POST['password'])) {
                Sessions::new_session('admin', true);
            } else {
                error_log("Wrong password");
                return '<div id="login_error"><p id="text_error">Credenziali errate!</p><a class="close" onclick="close_error(this)"></a></div>';
            }
        }
    }

    public static function login_ajax()
    {
        if (isset($_POST['username']) && isset($_POST['password'])) {
        }
        require_once 'input_security_check.php';
        $username = Input_security_check::username_check($_POST['username']);
        $password = Input_security_check::password_check($_POST['password']);
        if (!$username || !$password) {
            error_log("Security check failed");
            return 'Hai inserito simboli non consentiti';
        } else {
            require_once 'get_admin.php';
            if ((new Get_admin())->admin($_POST['username'], $_POST['password'])) {
                return true;
            } else {
                error_log("Wrong password");
                return 'Credenziali errate!';
            }
        }
    }
}
?>