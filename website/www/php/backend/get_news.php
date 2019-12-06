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
        //return mysqli_fetch_all($this->admin->execute("select * from News"),MYSQLI_ASSOC);
        return array("Title"=>"Sconti speciali a Natale!", "Content"=>"Dal 15 dicembre al 15 gennaio, se prendi 2 torte la meno cara la paghi la metà");
    }

    public function set_news(){
        return FALSE;
    }

}

?>