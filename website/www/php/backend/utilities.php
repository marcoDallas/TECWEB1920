<?php

class Utilities
{
    /* Il metodo ritorna il nome della pagina corrente con l'iniziale maiuscola */
    public static function get_page_name()
    {
        $array=explode('/', $_SERVER['PHP_SELF']);
        $page=explode('.', end($array));
        return ucfirst($page[0]);
    }
    /* Il metodo ritorna il nome della pagina, in base a un indirizzo */
    public static function shrink_page($page)
    {
        $array=explode('/', $page);
        $page=explode('.', end($array));
        return $page[0];
    }
}
?>