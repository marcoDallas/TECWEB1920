 <?php
/*
 *  Classe per la gestione degli account admin
 */

require_once('database_connection.php');

class Get_admin
{
    private $admin='';
    /* Il costruttore crea una connessione al database */
    public function __construct()
    {
        $this->admin = new database_connection();
    }
    /* Il metodo esegue la query per verificare se le credenziali inserite sono corrette */
    public function admin($username, $password)
    {
        return @mysqli_fetch_assoc($this->admin->execute("select * from Utente where Username = '$username' and Pwd = '$password'"));
    }
}
?>
