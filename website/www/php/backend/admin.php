<?php
/*
 *  Classe per il login/logout e verifica dell'amministratore
 */
include_once('sessions.php');

class Admin
{
    /* Ad ogni caricamento di una pagina il metodo verifica se è stato richiesto di accedere come admin */
    public static function init_admin()
    {
        Sessions::set_expire(1800);
        Sessions::init_session();
        
        if (!Admin::verify() && isset($_POST['Login'])) {
            Admin::login();
        }
        if (isset($_POST['Logout'])) {
            Admin::logout();
        }
    }
    /* Il metodo controlla ad ogni caricamento di una pagina se la sessione amministratore è presente */
    public static function verify()
    {
        return Sessions::session_exists('admin') && Sessions::get_value('admin')==true;
    }
    /* Il metodo effettua il logout, quando richiesto */
    public static function logout()
    {
        if (Sessions::session_exists('admin')) {
            Sessions::delete_session('admin');
            return true;
        }
        return false;
    }
    /* Il metodo effettua il login */
    public static function login()
    {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            require_once 'backend/input_security_check.php';
            $username = Input_security_check::username_check($_POST['username']);
            $password = Input_security_check::password_check($_POST['password']);
            if (!$username || !$password) {
                error_log("Security check failed");
                $_POST['in']=FALSE;
            }
            require_once 'backend/get_admin.php';
            if ((new Get_admin())->admin($_POST['username'], $_POST['password'])) {
                Sessions::new_session('admin', true);
            } else {
                error_log("Wrong password");
                $_POST['in']=FALSE;
            }
        }
    }
    /* Il metodo tenta di controllare se le credenziali sono corrette e ritorna un messaggio */
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