<?php
require_once 'backend/admin.php';
Sessions::init_session();
if(!Admin::verify() || !isset($_POST['editNews'])){
    header('Location: fallback.php');
}
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

require_once 'backend/get_products.php';
$news = (new Get_news())->get_news();

?>
<form method="post" action="<?php echo($_POST['prevpage']);?>">
    <fieldset>
        <legend>Modifica News</legend>
        <label for="title">Titolo News</label>
        <input type="text" name="title" id="title" aria-required="true" value="<?php echo($news['Titolo']);?>"/>
        <label for="description">Descrizione News</label>
        <textarea cols="20" name="description" id="description"> 
            <?php echo($news['Contenuto']);?>
        </textarea> 
        <input type="submit" value="Modifica" name="submitEditNews"/>
    </fieldset>
</form>
<?php
echo(Print_content::closeDiv());
echo(Print_content::footer());
echo(Print_content::closeBody());
echo(Print_content::closeHTML());
?>