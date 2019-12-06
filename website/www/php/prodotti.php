<?php
require_once 'backend/print_content.php';
echo(Print_content::top('xhtml+aria'));
echo(Print_content::openHTML());
echo(Print_content::head('Prodotti'));
echo(Print_content::openBody());
if(!strcmp($_GET['type'],'Paste'))
    echo(Print_content::header('Una grande varietà di paste, una prelibatezza dietro l\'altra','prodotti.php')."\r");
else if(!strcmp($_GET['type'],'Torte'))
    echo(Print_content::header('Una vasta gamma di torte, a voi basta solo scegliere','prodotti.php')."\r");
else header('Location: html/fallback.html');
echo(Print_content::breadcrumb('<strong>'.$_GET['type'].'</strong>')."\r");
echo(Print_content::openGeneralContainer());
echo(Print_content::menu('prodotti.php?type='.$_GET['type']));
echo(Print_content::news("prodotti.php"));
//echo(Print_content::login_form());
echo(Print_content::closeDiv());
echo(Print_content::closeDiv());
echo(Print_content::footer());
echo(Print_content::closeBody());
echo(Print_content::closeHTML());
?>