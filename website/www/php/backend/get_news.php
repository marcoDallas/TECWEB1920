<?php
/*
 *  Classe per la gestione degli account admin
 */

require_once('database_connection.php');

class Get_news
{
    private $news='';
    /* Il costruttore crea una connessione con il database */
    public function __construct()
    {
        $this->news = new database_connection();
    }
    /* Il metodo ritorna le news salvate nel database */
    public function get_news()
    {
        return @mysqli_fetch_assoc($this->news->execute("select * from News where Codice = 1"));
    }
    /* Il metodo cambia le news nel database */
    public function set_news($title, $content)
    {
        return $this->news->execute("update News set Titolo = '$title', Contenuto = '$content' where Codice = 1");
    }
}
?>