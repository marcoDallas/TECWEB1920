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
        return mysqli_fetch_assoc($this->admin->execute("select * from Utente where Email = '$username' and Pwd = '$password'"));
    }

}

?>
