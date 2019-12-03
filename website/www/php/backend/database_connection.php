<?php
/*
 *  Classe per la gestione del database
 *  Implementa metodi per la connessione e gestione delle query
 */
 class database_connection{
    
    private $host="localhost";
    private $user="root";
    private $pass="";
    private $database="pasticceria";
    private $current_connection;

    public function __construct(){
        if(!($this->current_connection = mysqli_connect($this->host,$this->user,$this->pass,$this->database))){
            error_log("Debugging errno: " . mysqli_connect_errno()."Debugging error: " . mysqli_connect_error());
        }
    }

    public function disconnect() {
		if ($this->current_connection)
            mysqli_close($this->current_connection);
	}

    public function getCurrent(){
        return $this->current_connection;
    }

    public function execute($query) {
		return mysqli_query($this->current_connection,$query);
    }
    
    
}
?>