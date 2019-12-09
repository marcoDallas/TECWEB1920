<?php
/*
 *  Classe per la gestione degli account admin
 */

require_once('database_connection.php');

class Get_news{

    private $news='';

    public function __construct(){
        $this->news = new database_connection();
    }

    public function get_news(){
        return @mysqli_fetch_assoc($this->news->execute("select * from News where Codice = 1"));
    }

    public function set_news($title,$content){
        return $this->news->execute("update News set Titolo = '$title', Contenuto = '$content' where Codice = 1");
    }

}

?>