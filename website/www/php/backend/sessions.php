<?php
/*
 * La classe contiene alcune funzioni utili per la gestione delle veriabili di sessione
 */
class Sessions
{
    /* Il metodo inizializza la sessione */
    public static function init_session()
    {
        session_start();
    }
    /* Il metodo crea o sostituisce una sessione */
    public static function new_session($name, $value)
    {
        return $_SESSION[$name]=$value; /* Se richiamata sulla stessa sessione sovrascrive */
    }
    /* Il metodo verifica l'esistenza di una sessione */
    public static function session_exists($name)
    {
        return isset($_SESSION[$name]);
    }
    /* Il metodo  ritorna il valore di una sessione */
    public static function get_value($name)
    {
        return $_SESSION[$name];
    }
    /* Il metodo rimuove una sessione */
    public static function delete_session($name)
    {
        if (isset($_SESSION[$name])) {
            unset($_SESSION[$name]);
        }
    }
    /* Il metodo imposta la scadenza delle sessioni */
    public static function set_expire($lifetime)
    {
        ini_set('session.gc_maxlifetime', $lifetime);
        session_set_cookie_params($lifetime);
    }
}
?>