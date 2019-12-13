 
<?php
/*
 *  Classe per la gestione dei product
 */

require_once('database_connection.php');

class Get_products{

    private $product='';

    public function __construct(){
        $this->product = new database_connection();
    }

    public function get_paste(){
        return @mysqli_fetch_all($this->product->execute("select * from Prodotto where TipoProdotto LIKE 'Pasta' order by Nome"),MYSQLI_ASSOC);
    }

    public function get_torte(){
        return @mysqli_fetch_all($this->product->execute("select * from Prodotto where TipoProdotto LIKE 'Torta' order by Nome"),MYSQLI_ASSOC);
    }

    public function search_paste($to_search){
        return @mysqli_fetch_all($this->product->execute("select * from Prodotto where TipoProdotto LIKE 'Pasta' and Nome LIKE '%$to_search%' order by Nome"),MYSQLI_ASSOC);
    }

    public function search_torte($to_search){
        return @mysqli_fetch_all($this->product->execute("select * from Prodotto where TipoProdotto LIKE 'Torta' and Nome LIKE '%$to_search%' order by Nome"),MYSQLI_ASSOC);
    }

    public function search_by_code($id){
        return @mysqli_fetch_assoc($this->product->execute("select * from Prodotto where Codice = $id"));
    }

    public function delete_product($id){
        return $this->product->execute("delete from Prodotto where Codice = $id");
    }

    public function add_product($type,$title,$description,$image){
        return $this->product->execute("insert into Prodotto (Nome,TipoProdotto,Descrizione,Immagine) values ('$title','$type','$description','$image');");
    }

    public function add_product_noimage($type,$title,$description){
        return $this->product->execute("insert into Prodotto (Nome,TipoProdotto,Descrizione) values ('$title','$type','$description');");
    }

    public function edit_product($id,$type,$title,$description,$image){
        return $this->product->execute("update Prodotto set TipoProdotto = '$type' , Nome = '$title' , Descrizione = '$description' , Immagine= '$image' where Codice = $id");
    }

    public function edit_product_noimage($id,$type,$title,$description){
        return $this->product->execute("update Prodotto set TipoProdotto = '$type' , Nome = '$title' , Descrizione = '$description' where Codice = $id");
    }

}
?>
