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
$edit=TRUE;
if(isset($_POST['add']))
    $edit=FALSE;
require_once 'backend/print_content.php';
echo(Print_content::top('xhtml+aria'));
echo(Print_content::openHTML());
Print_content::head();
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
<div class="body_column content">
    <h2>Da questa pagina puoi aggiungere/modificare un prodotto</h2>
    <form id="edit_form" class="general_form" method="post" action="<?php echo($_POST['prevpage']);?>">
        <fieldset>
            <legend><?php if($edit) echo("Modifica ".$product['Nome']); else echo("Aggiungi Prodotto");?></legend>
            <div class="input_line">
                <label for="title">Nome Prodotto</label>
                <input class="general_input" type="text" name="title" id="title" aria-required="true" value="<?php if($edit) echo($product['Nome']);?>"/>
            </div>
            <div class="input_textarea">
                <label for="description">Descrizione Prodotto</label>
                <textarea class="general_input general_textarea" rows="12" cols="70" name="description" id="description"> 
                    <?php if($edit) echo($product['Descrizione']);?>
                </textarea> 
            </div>
            <?php if($edit) echo('<input type="hidden" name="id" value="'.$product['Codice'].'"/>'); ?>
            <input id="edit_form_submit" class="general_button" type="submit" value="Modifica" name="writeEdits" />
        </fieldset>
    </form>
</div>
<?php
echo(Print_content::closeDiv());
echo(Print_content::footer());
echo(Print_content::closeBody());
echo(Print_content::closeHTML());
?>