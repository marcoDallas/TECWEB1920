<?php
/*
 *  Classe per la gestione del database
 *  Implementa metodi per la connessione e gestione delle query
 */
 class database_connection
 {
     private const HOST = 'localhost';
     private const USERNAME = 'root';
     private const PASSWORD = '';
     private const DATABASE_NAME = 'pasticceria';
     private $current_connection;

     public function __construct()
     {
         if (!($this->current_connection = @mysqli_connect(static::HOST, static::USERNAME, static::PASSWORD, static::DATABASE_NAME))) {
             error_log("Debugging errno: " . mysqli_connect_errno()."Debugging error: " . mysqli_connect_error());
             echo "Momentaneamente i dati non sono disponibili. Riprovare più tardi.";
         }
     }

     public function getCurrent()
     {
         return $this->current_connection;
     }

     public function execute($query)
     {
         $result = @mysqli_query($this->current_connection, $query);
         @mysqli_close($this->current_connection);
         return $result;
     }
    
     public function disconnect()
     {
         @mysqli_close($this->current_connection);
     }
 }
 ?>