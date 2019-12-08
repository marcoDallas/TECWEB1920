<?php
if(!isset($_GET['type']) || (strcmp($_GET['type'],'Paste') && strcmp($_GET['type'],'Torte')))
    header('Location: html/fallback.html');  
require_once 'backend/admin.php';
Admin::init_admin();
require_once 'backend/print_content.php';
require_once 'backend/print_products.php';
echo(Print_content::top('xhtml+aria'));
echo(Print_content::openHTML());
echo(Print_content::head('Prodotti'));
echo(Print_content::openBody());
if(!strcmp($_GET['type'],'Paste'))
    echo(Print_content::header('Una grande varietà di paste, una prelibatezza dietro l\'altra','prodotti.php')."\r");
else if(!strcmp($_GET['type'],'Torte'))
    echo(Print_content::header('Una vasta gamma di torte, a voi basta solo scegliere','prodotti.php')."\r");
echo(Print_content::breadcrumb('<strong>'.$_GET['type'].'</strong>')."\r");
echo(Print_content::openGeneralContainer());
echo(Print_content::menu('prodotti.php?type='.$_GET['type']));
echo(Print_content::news("prodotti.php"));
echo(Print_content::closeDiv());
$content = new Print_products();
if(!strcmp($_GET['type'],'Paste')){
    if(isset($_GET['search']))
        $content->print_searcheable_paste($_GET['search']);
    else
        $content->print_paste();

}else if(!strcmp($_GET['type'],'Torte')){
    if(isset($_GET['search']))
        $content->print_searcheable_torte($_GET['search']);
    else
        $content->print_torte();

}
echo(Print_content::closeDiv());
echo(Print_content::footer());
echo(Print_content::closeBody());
echo(Print_content::closeHTML());
?>