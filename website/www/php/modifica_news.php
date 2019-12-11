<?php
require_once 'backend/admin.php';
Sessions::init_session();
if(!Admin::verify() || !isset($_POST['editNews'])){
    header('Location: fallback.php');
}
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

require_once 'backend/get_products.php';
$news = (new Get_news())->get_news();

?>
<div class="body_column content">
    <h2>Da questa pagina puoi modificare la news laterale</h2>
    <form id="edit_form" class="general_form" method="post" action="<?php echo($_POST['prevpage']);?>">
        <fieldset>
            <legend>Modifica News</legend>
            <div class="input_line">
                <label for="title">Titolo News: </label>
                <input class="general_input" type="text" name="title" id="title" aria-required="true" value="<?php echo($news['Titolo']);?>"/>
            </div>
            <div class="input_textarea">
            <label for="description">Descrizione News: </label>
            <textarea class="general_input general_textarea" rows="12" cols="70" name="description" id="description"> 
                <?php echo($news['Contenuto']);?>
            </textarea> 
            </div>
            <input id="edit_form_submit" class="general_button" type="submit" value="Modifica" name="submitEditNews"/>
        </fieldset>
    </form>
</div>
<?php
echo(Print_content::closeDiv());
echo(Print_content::footer());
echo(Print_content::closeBody());
echo(Print_content::closeHTML());
?>