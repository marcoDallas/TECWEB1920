 <?php
/*
 *  Classe per la gestione degli account admin
 */

require_once('database_connection.php');

class Get_admin{

    private $admin='';

    public function __construct(){
        $this->admin = new database_connection();
    }

    public function admin($username,$password){
        //return mysqli_fetch_all($this->admin->execute("select Email,Pwd from Utente where Email LIKE '$username' and Pwd LIKE '$password';"),MYSQLI_ASSOC);
        return mysqli_fetch_all($this->admin->execute("select * from Utente"),MYSQLI_ASSOC);
    }

}

?>
