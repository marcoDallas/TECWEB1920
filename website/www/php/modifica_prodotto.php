<?php
require_once 'backend/admin.php';
Sessions::init_session();
if(!Admin::verify() || ( (!isset($_POST['edit']) || !isset($_POST['product']) || !isset($_POST['prevpage'])) && ( !isset($_POST['add'] ) ))){
    header('Location: fallback.php');
}
if(Admin::verify()){
    require_once 'backend/edit_news.php';
    Edit_news::edit();
}
if(isset($_POST['add']))
    $edit=FALSE;
require_once 'backend/print_content.php';
echo(Print_content::top('xhtml+aria'));
echo(Print_content::openHTML());
echo(Print_content::head('Home'));
echo(Print_content::openBody());
echo(Print_content::header('La miglior pasticceria di Padova','home.php')."\r");
echo(Print_content::breadcrumb('<strong xml:lang="en">Home</strong>')."\r");
echo(Print_content::openGeneralContainer());
echo(Print_content::menu("home.php"));
echo(Print_content::news("home.php"));
echo(Print_content::closeDiv());

if($edit){
    require_once 'backend/get_products.php';
    $product = (new Get_products())->search_by_code($_POST['product']);
}
?>
<form method="post" action="<?php echo($_POST['prevpage']);?>">
    <fieldset>
        <legend><?php if($edit) echo("Modifica ".$product['Nome']); else echo("Aggiungi Prodotto");?></legend>
        <label for="title">Nome Prodotto</label>
        <input type="text" name="title" id="title" aria-required="true" value="<?php if($edit) echo($product['Nome']);?>"/>
        <p>Tipo Prodotto</p>
        <label for="pasta">Pasta</label>
        <input type="radio" name="type" value="Pasta" id="pasta" aria-required="true" <?php if($edit) if(!strcmp($product['TipoProdotto'],'Pasta')) echo('checked="checked"');?>/>
        <label for="torta">Torta</label>
        <input type="radio" name="type" value="Torta" id="torta" aria-required="true" <?php if($edit) if(!strcmp($product['TipoProdotto'],'Torta')) echo('checked="checked"');?>/>
        <label for="description">Descrizione Prodotto</label>
        <textarea cols="20" name="description" id="description"> 
            <?php if($edit) echo($product['Descrizione']);?>
        </textarea> 
        <?php if($edit) echo('<input type="hidden" name="id" value="'.$product['Codice'].'"/>'); ?>
        <input type="submit" value="Modifica" name="writeEdits" />
    </fieldset>
</form>
<?php
echo(Print_content::closeDiv());
echo(Print_content::footer());
echo(Print_content::closeBody());
echo(Print_content::closeHTML());
?>